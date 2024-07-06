<?php
function countDigits($MyNum)
{
    //counting the number of digits on the id to add zeros to make the ticket number
    $MyNum = (int)$MyNum;
    $count = 0;

    while ($MyNum != 0) {
        $MyNum = (int)($MyNum / 10);
        $count++;
    }
    return $count;
}
session_start();
$UserID = $_SESSION['acu'];
$TicketTitle = $_POST['TicketTitle'];
$TicketDeviceID = $_POST['DeviceType'];
$TicketDetails = $_POST['TicketDetails'];
require "connection/connection.php";
if (isset($_POST['SaveTicket'])) {
    $get_last_ticket_number = "SELECT MAX(TicketNumberValue) AS MyValue FROM tickets";
    $get_last_ticket_number_query = mysqli_query($conn, $get_last_ticket_number);
    if (mysqli_num_rows($get_last_ticket_number_query) > 0) {
        $my_row = mysqli_fetch_array($get_last_ticket_number_query);
        $NumberValue = $my_row['MyValue'];
    }
    else $NumberValue = 0;
    $NewNumberValue = $NumberValue + 1;
    $digits = countDigits($NewNumberValue);
    $Zeros = 9 - $digits;
    $NewTicketNumber = "";
    for ($i = 0; $i < $Zeros; $i++) {
        $NewTicketNumber = $NewTicketNumber . "0";
    }
    $NewTicketNumber = $NewTicketNumber . $NewNumberValue;
    $insert_ticket = "INSERT INTO tickets VALUES(NULL,'$NewTicketNumber',$NewNumberValue,'$TicketTitle',$TicketDeviceID,$UserID,'$TicketDetails',1,0,NOW())";
    $insert_ticket_query = mysqli_query($conn, $insert_ticket);
    if ($insert_ticket_query) {
        $TicketID = mysqli_insert_id($conn);
        $insert_ticket_action = "INSERT INTO ticket_actions VALUES(NULL,$TicketID,$UserID,NOW(),'فتح تذكرة',0,1)";
        $insert_ticket_action_query = mysqli_query($conn, $insert_ticket_action);
        if ($insert_ticket_action_query) {
            $feedback = 1;
        }
    } else {
        $feedback = 2;
    }
    $UserType = $_SESSION['acut'];
    switch ($UserType) {
        case 1:
            header("location:AdminPage.php?fb=$feedback");
            break;
        case 1:
            header("location:AdminPage.php?fb=$feedback");
            break;
        case 2:
            header("location:SupportPage.php?fb=$feedback");
            break;
        case 3:
            header("location:UserPage.php?fb=$feedback");
            break;
    }
}
