<?php

session_start();
require 'connection/connection.php';

$UserName = $_POST['UserName'];
$UserEmail = $_POST['UserEmail'];
$UserPhone = $_POST['UserPhone'];
$UserType = $_POST['UserType'];
$UserSusspend = 0;
if(isset($_POST['suspend']))
$UserSusspend = 1;

if(isset($_POST['SaveUser'])){
    $Password = $_POST['UserPassword'];
    $ConfirmPassword = $_POST['ConfirmPassword'];
    if($Password==$ConfirmPassword){
        $CheckUserEmail = "SELECT * FROM users WHERE UserName = '$UserName'";
        $CheckUserEmailQuery = mysqli_query($conn,$CheckUserEmail);
        if($CheckUserEmailQuery){
            if(mysqli_num_rows($CheckUserEmailQuery)==0){
                $UserPassword = md5($Password);
                $InsertNewUser = "INSERT INTO users VALUES(NULL,'$UserEmail','$UserName','$UserPassword','$UserPhone',$UserType,$UserSusspend,0)";
                $InsertNewUserQuery = mysqli_query($conn,$InsertNewUser);
                if($InsertNewUserQuery){
                    header('location:users.php?fb=1');
                }
                else{
                    header('location:users.php?fb=2');
                }
            }
            else{
                header('location:new_user.php?fb=3');
            }
        }
        else{
            header('location:users.php?fb=2');
        }
    }
}
if(isset($_POST['UpdateUser'])){
    $UserID = $_POST['UserID'];
    $check_user_email = "SELECT * FROM users WHERE UserEmail = '$UserEmail' AND UserID != $UserID";
    $check_user_email_query = mysqli_query($conn,$check_user_email);
    if($check_user_email_query){
        if(mysqli_num_rows($check_user_email_query)==0){
            $update_user = "UPDATE users SET UserEmail = '$UserEmail',UserName = '$UserName',UserPhone='$UserPhone',UserType=$UserType,UserSusspend=$UserSusspend WHERE UserID=$UserID";
            $update_user_query = mysqli_query($conn,$update_user);
            if($update_user_query){
                header('location:users.php?fb=5');
            }
            else{
                header('location:users.php?fb=6');
            }
        }
        else{
            header("location:new_user.php?fb=3&uid=$UserID");
        }
    }
}

?>
