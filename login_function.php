<?php
require 'db_connector.php';
session_start();

if (isset($_POST)) {
    $user_email=htmlspecialchars($_POST['email']);
    $user_password=htmlspecialchars($_POST['pass-1']);
    
    $data= [
        'user_email'=>$user_email,
    ];

    $sql="SELECT * FROM register_form WHERE user_email=:user_email";
    $statement=$conn->prepare($sql);
    $statement->execute($data);
    $usr=$statement->fetch(PDO::FETCH_ASSOC);

    $_SESSION['name']=$usr['user_name'];
    if ($usr) {
        if (password_verify($user_password,$usr['password'])) {
            header("Location:deposit.php"); exit;
        } else {
            $_SESSION['error'] = "Incorrect password. Please try again.";
            header("Location: login.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "No account found with this email.";
        header("Location: login.php");
        exit;
    }
} else {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: login.php");
    exit;
}