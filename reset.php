<?php
require 'connection/connection.php';
    if(isset($_POST['ResetPassword'])){
        $Password = $_POST['UserPassword'];
        $ConfirmPassword = $_POST['ConfirmPassword'];
        $UserID = $_POST['UserID'];
        if($Password==$ConfirmPassword){
            $MDPassword = md5($Password);
            $reset_password = "UPDATE users SET UserPassword = '$MDPassword' WHERE UserID = $UserID";
            $reset_password_query = mysqli_query($conn,$reset_password);
            if($reset_password_query){
                header('location:users.php?fb=7');
            }
            else{
                header('location:users.php?fb=8');

            }
        }
    }
?>
