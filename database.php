<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "aparat";

$db = mysqli_connect($hostname, $username, $password, $database_name);

if (!$db) {
    echo "Database connection failed";
    die("error!");
}
?>