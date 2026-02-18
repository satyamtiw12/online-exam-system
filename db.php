<!-- <?php

// ini_set('session.cookie_httponly', 1);
// ini_set('session.use_only_cookies', 1);

// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// try {
//     $conn = new mysqli("localhost", "root", "", "auth_system");
//     $conn->set_charset("utf8mb4");
// } catch (Exception $e) {
//     die("Database connection error");
// }


<?php

ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);

try {
    $conn = pg_connect("host=dpg-d6aln0ili9vc73e742fg-a port=5432 dbname=auth_system_7x8q user=auth_system_7x8q_user password=AQ3HOYf0E3WU2CETwQZrdtpHwQGONx9I");

    if (!$conn) {
        throw new Exception("Connection failed");
    }

} catch (Exception $e) {
    die("Database connection error");
}
?>
