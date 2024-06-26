<?php
require 'connection/connection.php';
if(isset($_POST['SwitchUser'])){
    $ToUser = $_POST['ToUser'];
    $UserID = $_POST['UserID'];
    $switch_user = "UPDATE tickets SET TicketHandleBy = $ToUser WHERE TicketHandleBy = $UserID";
    $switch_user_query = mysqli_query($conn,$switch_user);
    if($switch_user_query){
        $feedback = 10;
    }
    else{
        $feedback = 11;
    }
    header("location:users.php?fb=$feedback");
}
?>
