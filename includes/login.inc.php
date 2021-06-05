<?php 

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ../login.php');
}

include_once "db.inc.php";
include "functions.inc.php";

$uid = $_POST['email'];
$password = $_POST['password'];

if(emptyInputLogin($uid, $password)) {
    header('Location: ../login.php?error=emptyInput');
    exit();
}

if(usernameNotExists($conn, $uid)) {
    header('Location: ../login.php?error=noExist');
    exit();
}

if(passwordMatcher($conn, $uid, $password)) {
    header('Location: ../login.php?error=wrongPwd');
    exit();
}

$user = getInfo($conn, $uid);
session_start();
$_SESSION['userid'] = $user['id'];
$_SESSION['username'] = $user['username'];
header('Location: ../index.php?msg=success');
exit();
?>
