<?php
session_start();
include("../includes/config.php");
include("../includes/header.php");

$email = trim($_POST['email']);
$password = trim($_POST['password']);
//validation 
if (!preg_match("/^\w+@\w+\.\w+/", $email)) {
    $_SESSION['message'] = 'email invalid format';
    header("Location: register.php");
    exit();
} else if (!(strlen($password) >= 6)) {
    $_SESSION['message'] = 'password should be at least 6 characters';
    header("Location: register.php");
    die();
} else {
    $confirmPass = trim($_POST['confirmPass']);
    if ($password !== $confirmPass) {
        $_SESSION['message'] = 'passwords do not match';
        header("Location: register.php");
        exit();
    }
}
try {
    $password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (email, password, status, created_at) VALUES(?,?,'active', now())";
    $stmt1 = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt1, 'ss', $email, $password);
    mysqli_stmt_execute($stmt1);
    header("Location: login.php");
} catch (mysqli_sql_exception $e) {
    echo $e->getMessage();
}



// 



// $result = mysqli_query($conn, $sql);
// if ($result) {
//     $_SESSION['userId'] = mysqli_insert_id($conn);
//     header("Location: profile.php");
// }