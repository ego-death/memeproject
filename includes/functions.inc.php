<?php

function emptyInput($email, $username, $password, $passwordRepeat)
{
    if (empty($email) || empty($username) || empty($password) || empty($passwordRepeat)) {
        return true;
    } else {
        return false;
    }
}

function invalidEmail($email)
{
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Validate e-mail
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    } else {
        return true;
    }
}

function pwdNotMatch($password, $passwordRepeat)
{
    return $password !== $passwordRepeat;
}

function usernameExists($conn, $username, $email)
{
    $sql = 'SELECT * FROM users WHERE username=? OR email=?;';
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ../signup.php?error=stmtError');
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $resultArray = mysqli_fetch_all($result);
    if (count($resultArray) > 0) {
        return true;
    } else {
        return false;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn, $email, $username, $password) {
    $sql = 'INSERT INTO users (username, email, password) VALUES (?, ?, ?);';
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ../signup.php?error=signUpFail');
    }
    $hash = password_hash($password, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hash);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
}

function emptyInputLogin($uid, $password) {
    if(empty($uid) || empty($password)) {
        return true;
    } else {
        return false;
    }
}

function usernameNotExists($conn, $uid) {
    $sql = 'SELECT * FROM users WHERE email=? OR username=?;';
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ../login.php?error=stmtFail');
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $uid, $uid);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    $resultArray = mysqli_fetch_all($result);

    $bool = count($resultArray) == 0;
    mysqli_stmt_close($stmt);
    return $bool;
}

function passwordMatcher($conn, $uid, $pwd) {
    $data = [];
    $sql = 'SELECT * FROM users WHERE email=? OR username=?;';
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ../login.php?error=stmtFail');
    }
    mysqli_stmt_bind_param($stmt, "ss", $uid, $uid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $resultArray = mysqli_fetch_assoc($result);
    return !password_verify($pwd, $resultArray['password']);
    // while ($resultArray = mysqli_fetch_assoc($result)) {
    //     echo '<pre>';
    //     var_dump($resultArray);
    //     echo '</pre>';
    //     array_push($data, $resultArray);
    // }
    // echo $pwd;
    // echo '<pre>';
    // var_dump($data);
    // echo '</pre>';
    // return false;
}

function getInfo($conn, $uid) {
    $sql = 'SELECT * FROM users WHERE email=? OR username=?;';
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ../login.php?error=stmtFail');
    }
    mysqli_stmt_bind_param($stmt, "ss", $uid, $uid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $resultArray = mysqli_fetch_assoc($result);
    return $resultArray;
}
