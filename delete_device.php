<?php
require "connection/connection.php";
if(isset($_GET['did'])){
    $DeviceID = $_GET['did'];
    $check_device_tickets = "SELECT * FROM tickets WHERE TicketDevice=$DeviceID";
    $check_device_tickets_query = mysqli_query($conn,$check_device_tickets);
    //check if device is not used at any ticket before deleting it if it used the device will not be deleted and a message will be back to the user
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
