<?php
if(isset($_POST['addComment'])){
    require "connection/connection.php";
    session_start();
    $UserID = $_SESSION['acu'];
    $Comment = $_POST['comment'];
    $TicketID = $_POST['ticket'];
    $TicketStatusGet = "SELECT TicketStatus FROM tickets WHERE TicketID = $TicketID";
    $TicketStatusGetQuery = mysqli_query($conn,$TicketStatusGet);
    $TicketStatusRow = mysqli_fetch_array($TicketStatusGetQuery);
    $TicketStatus = $TicketStatusRow['TicketStatus'];
    $addComment = "INSERT INTO ticket_actions VALUES(NULL,$TicketID,$UserID,NOW(),'$Comment',$TicketStatus,$TicketStatus)";
    $addCommentQuery = mysqli_query($conn,$addComment);
    if($addCommentQuery){
        header('location:ticket.php?tid='.$TicketID);
    }
}
?>
