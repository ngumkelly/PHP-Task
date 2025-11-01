<?php
$site_name = "Kelly's Portfolio";
$year = date("Y");

$db_host = "localhost";
$db_user = "root";
$db_pass = "RootPassword123!";
$db_name = "portfolio_blog";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
