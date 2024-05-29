<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "Karim_2000";
$dbName = "SOS";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}
