<?php
session_start();
if(isset($_SESSION['acu'])){
    $UserType = $_SESSION['acut'];
    switch($UserType){
        case 1:
            header('location:AdminPage.php');
            break;
        case 2:
            header('location:SupportPage.php');
            break;
        case 3:
            header('location:UserPage.php');
            break;
        default:
            header('location:login.php?er=2');
            break;
    }
}
else{
    header('location:login.php');
}
?>
