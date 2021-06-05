<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "proj";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if(!$conn) {
    die("Connection failed");
}

?>