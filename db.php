
<?php
// Use correct port (3307) and empty password
$con = new mysqli('localhost', 'root', '', 'mybank', 3307);

if ($con->connect_error) {
    die("Database connection failed: " . $con->connect_error);
}
?>

