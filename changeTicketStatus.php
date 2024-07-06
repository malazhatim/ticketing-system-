<?php
if(isset($_GET['tid'])){
    if(isset($_GET['na'])){//checking if page is accessed with a ticket
        
        require_once "connection/connection.php";
        $TicketID = $_GET['tid'];
        $TicketStatus = $_GET['na'];
        $get_old_status = "SELECT TicketStatus FROM tickets WHERE TicketID = $TicketID";
        //get the current ticket status to write on the ticket action comment
        $get_old_status_query = mysqli_query($conn,$get_old_status);
        $MyOldStatus = mysqli_fetch_array($get_old_status_query);
        $TicketOldStatus = $MyOldStatus['TicketStatus'];
        session_start();
        $UserID = $_SESSION['acu'];//get the current user who is logged in
        $change_status = "UPDATE tickets SET TicketStatus = $TicketStatus,TicketHandleBy = $UserID WHERE TicketID = $TicketID";
        $change_status_query = mysqli_query($conn,$change_status);
        if($change_status_query){
            $add_action = "INSERT INTO ticket_actions VALUES(NULL,$TicketID,$UserID,NOW(),'تغيير حالة',$TicketOldStatus,$TicketStatus)";
            $add_action_query = mysqli_query($conn,$add_action);
            if($add_action_query){
                $UserType = $_SESSION['acut'];
                switch($UserType){
                    case 1:
                        header('location:AdminPage.php?fb=12');
                        break;
                    case 2:
                        header('location:SupportPage.php?fb=12');
                        break;
                    case 3:
                        header('location:UserPage.php?fb=12');
                        break;
                }
            }
        }
    }
}
?>
