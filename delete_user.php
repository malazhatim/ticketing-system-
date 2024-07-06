<?php

require "connection/connection.php";
if(isset($_GET['uid'])){
    $UserID = $_GET['uid'];
    $check_user_tickets = "SELECT * FROM tickets WHERE TicketHandleBy=$UserID AND TicketStatus = 2";
    $check_user_tickets_query = mysqli_query($conn,$check_user_tickets);
    //check if the user doesn't have any active ticket before deleting, if he has the user will not be deleted an a message will be sent to the user
    if(mysqli_num_rows($check_user_tickets_query)==0){
        $delete_user = "UPDATE users SET Deleted = 1 WHERE UserID =$UserID";
        $delete_user_query = mysqli_query($conn,$delete_user);
        if($delete_user_query){
            header('location:users.php?fb=4');
        }
        
    }
    else{
        header('location:users.php?fb=9');
    }
}

?>
