<?php
require "connection/connection.php";
if(isset($_GET['did'])){
    $DeviceID = $_GET['did'];
    $check_device_tickets = "SELECT * FROM tickets WHERE TicketDevice=$DeviceID";
    $check_device_tickets_query = mysqli_query($conn,$check_device_tickets);
    echo $check_device_tickets;
    if(mysqli_num_rows($check_device_tickets_query)==0){
        $delete_device = "DELETE FROM devices WHERE DeviceID =$DeviceID";
        $delete_device_query = mysqli_query($conn,$delete_device);
        if($delete_device_query){
            header('location:devices.php?fb=31');
        }
    }
    else{
        header('location:devices.php?fb=32');
    }
}

?>
