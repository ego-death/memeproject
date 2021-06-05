<?php

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ../signup.php');
} else {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordRepeat'];
    include 'db.inc.php';
    include 'functions.inc.php';


    if(emptyInput($email, $username, $password, $passwordRepeat)) {
        header('Location: ../signup.php?error=emptyInput');
        exit();
    }
    if(invalidEmail($email)) {
        header('Location: ../signup.php?error=invalidEmail');
        exit();
    }
    if(pwdNotMatch($password, $passwordRepeat)) {
        header('Location: ../signup.php?error=notMatch');
        exit();
    }
    if(usernameExists($conn, $username, $email)) {
        header('Location: ../signup.php?error=unameExists');
        exit();
    }
    createUser($conn, $email, $username, $password);
    header('Location: ../index.php');
    exit();
}
?>

