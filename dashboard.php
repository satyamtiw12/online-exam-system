<?php
include("db.php");
session_start();

// ✅ Check proper session
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Online Examination System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family: Arial,sans-serif;background:#f4f6f9;}

/* Header */
.header{background:#2c3e50;color:white;padding:12px 20px;display:flex;justify-content:space-between;align-items:center;}
.logout-btn{background:#e74a3b;border:none;padding:6px 12px;color:white;border-radius:5px;cursor:pointer;}

/* Center Layout */
.main-wrapper{min-height:90vh;display:flex;justify-content:center;align-items:center;padding:15px;}

/* Exam Card */
.exam-container{width:100%;max-width:600px;background:white;padding:20px;border-radius:10px;box-shadow:0 5px 15px rgba(0,0,0,0.1);}
h2{text-align:center;margin-bottom:15px;}
.timer{text-align:right;font-weight:bold;color:red;margin-bottom:15px;}
button{padding:10px 25px;margin-top:15px;background:#4e73df;color:white;border:none;border-radius:5px;cursor:pointer;}
.button-wrapper{text-align:center;margin-top:15px;}
</style>

<script>
let totalTime = 60; // 1 minute
let examSubmitted = false;
let timerInterval;

function startTimer() {
    timerInterval = setInterval(function() {
        let minutes = Math.floor(totalTime / 60);
        let seconds = totalTime % 60;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        document.getElementById("timer").innerText = "Time Left: " + minutes + ":" + seconds;
        totalTime--;
        if(totalTime < 0 && !examSubmitted){clearInterval(timerInterval);submitExam();}
    },1000);
}

function submitExam() {
    if(examSubmitted) return;
    examSubmitted = true;
    clearInterval(timerInterval);
    let score = 0;
    if(document.querySelector('input[name="q1"]:checked')?.value === "b") score++;
    if(document.querySelector('input[name="q2"]:checked')?.value === "a") score++;
    if(document.querySelector('input[name="q3"]:checked')?.value === "c") score++;
    alert("Time Over or Submitted!\nYour Score: "+score+"/3");
    document.querySelector("button[type='submit']").disabled = true;
}

window.onload = startTimer;
</script>
</head>

<body>
<div class="header">
    <h3><span class="welcome-text">
            Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>
        </span></h3>
    <div class="header-right">
        <!-- <span class="welcome-text">
            Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>
        </span> -->
        <a href="logout.php"><button class="logout-btn">Logout</button></a>
    </div>
</div>

<div class="main-wrapper">
<div class="exam-container">
<h2>📝 Online Exam</h2>
<div class="timer" id="timer"></div>

<form id="examForm" onsubmit="event.preventDefault(); submitExam();">

<p><b>1. What does HTML stand for?</b></p>
<input type="radio" name="q1" value="a"> Hyper Trainer Marking Language<br>
<input type="radio" name="q1" value="b"> Hyper Text Markup Language<br>
<input type="radio" name="q1" value="c"> Hyper Text Marketing Language<br>

<p><b>2. PHP is a ______ language?</b></p>
<input type="radio" name="q2" value="a"> Server Side<br>
<input type="radio" name="q2" value="b"> Client Side<br>
<input type="radio" name="q2" value="c"> Database<br>

<p><b>3. Which is a JavaScript framework?</b></p>
<input type="radio" name="q3" value="a"> Laravel<br>
<input type="radio" name="q3" value="b"> Django<br>
<input type="radio" name="q3" value="c"> React<br>

<div class="button-wrapper">
    <button type="submit">Submit Exam</button>
</div>

</form>
</div>
</div>

</body>
</html>
