<?php
    $login_username = $_POST['login_username'];
    $login_password = $_POST['login_password'];

    //DB connection
    $conn new mysqli('localhost', 'root', '', 'test');
    if($conn->connect_error)
    {
        die('Connection Failed : '.$conn->connect_error)
    }
    else
        $stmt = $conn->prepare("insert into login(login_username, login_password)")
?>