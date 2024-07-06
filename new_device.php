<?php

//check if user is logged in or not 
session_start();
if (!isset($_SESSION['acu'])) {
    header('location:index.php');
} else {
    if (isset($_SESSION['acut'])) {
        if (($_SESSION['acut'] != 1)&&($_SESSION['acut'] != 2)) {
            header('location:AccessDenied.html');
        }
    }
}
$title = "جهاز جديد";
$DeviceName = "";
$ButtonName = "SaveDevice";
require_once "connection/connection.php";
if (isset( $_GET['did'])) {
    $DeviceID = $_GET['did'];
    $get_device = "SELECT *FROM devices WHERE DeviceID = $DeviceID";
    $get_device_query = mysqli_query($conn,$get_device);
    if ($get_device_query) {
        if (mysqli_num_rows($get_device_query)) {
            $MyDevice = mysqli_fetch_array($get_device_query);
            $DeviceName = $MyDevice['DeviceName'];
            $ButtonName = "UpdateDevice";
            $title = "تعديل جهاز";
        }
    }
}
// Page Title ------
?>
<!-- Page Header -->
<?php include 'includes/header.php' ?>


<div class='container pt-5'>
    <form action='save_device.php' method='POST' class="card shadow-sm p-4 border-0">
        <div class="card-header bg-white mb-4">
            <h1 class="h4">جهاز جديد</h1>
        </div>
        <div class='row'>
            <div class='col-md-6'>
                <label class="form-label">الجهاز</label>
                <input type='text' class='form-control' id='DeviceName' name='DeviceName' value='<?php echo $DeviceName; ?>'>
            </div>

            <?php 
                if(isset($_GET['did'])){
                    echo "<input type='hidden' name='DeviceID' value='$DeviceID'>";
                }
            ?>
            <div class="d-flex gap-4 mt-4">
                <input type='submit' name='<?php echo $ButtonName; ?>' id='SaveDevice' class='btn px-4 btn-primary' value='حفظ'>
                <a href='devices.php' class='btn px-4 btn-danger'>الغاء</a>
            </div>
        </div>
    </form>
</div>

<!-- Page Footer -->
<?php include 'includes/footer.php' ?>
