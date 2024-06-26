<?php
require "connection/connection.php";
$DeviceName = $_POST['DeviceName'];
if(isset($_POST['SaveDevice'])){
    $DeviceInsert = "INSERT INTO devices VALUES(NULL,'$DeviceName')";
    $DeviceInsertQuery = mysqli_query($conn,$DeviceInsert);
    if($DeviceInsertQuery){
        header('location:devices.php?fb=33');
    }
}
if(isset($_POST['UpdateDevice'])){
    $DeviceID = $_POST['DeviceID'];
    $DeviceUpdate = "UPDATE devices SET DeviceName = '$DeviceName' WHERE DeviceID = $DeviceID";
    $DeviceUpdateQuery = mysqli_query($conn,$DeviceUpdate);
    if($DeviceUpdateQuery){
        header('location:devices.php?fb=34');
    }
}
?>
