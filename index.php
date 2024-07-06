<?php

/*this page check if user is logged or not 
if user is logged then the system will check the user type to transfer him to the correct page
if not the page will redirect the user to login page
*/
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
