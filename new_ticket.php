<?php

session_start();
if (!isset($_SESSION['acu'])) {
    header('location:index.php');
}
$TicketNumber = "#";
$TicketDeviceID = 0;
$TicketTitle = "";
$TicketDetails = "";
$ButtonName = "SaveTicket";
require_once "connection/connection.php";
if (isset($_GET['tid'])) {
    $TicketID = $_GET['tid'];
    $get_ticket = "SELECT *FROM tickets WHERE TicketID = $TicketID";
    $get_ticket_query = mysqli_query($conn, $get_ticket);
    if ($get_ticket_query) {
        if (mysqli_num_rows($get_ticket_query)) {
            $MyTicket = mysqli_fetch_array($get_ticket_query);
            $TicketNumber = $MyTicket['TicketNumber'];
            $TicketDeviceID = $MyTicket['TicketDevice'];
            $TicketTitle = $MyTicket['TicketTitle'];
            $TicketDetails = $MyTicket['TicketDetails'];
            $ButtonName = "UpdateTicket";
        }
    }
}
// Page Title ------
$title = "تذكرة جديدة";
?>
<!-- Page Header -->
<?php include 'includes/header.php' ?>

<div class='container pt-5'>
    <form action='save_ticket.php' method='POST' class="card shadow-sm p-4 border-0">
        <div class="card-header bg-white mb-4">
            <h1 class="h4">تذكرة جديدة</h1>
        </div>
        <div class='row'>
            <div class='col-md-6 mt-3 mt-md-0'>
                <label class="form-label">رقم التذكرة</label>
                <input type='text' disabled class='form-control' value='<?php echo $TicketNumber; ?>'>
            </div>
            <div class='col-md-6 mt-3 mt-md-0'>
                <label class="form-label">الجهاز</label>
                <select id='DevicType' name='DeviceType' class='form-control'>
                    <option value=''> اختر نوع الجهاز </option>
                    <?php
                    $get_device = "SELECT * FROM devices";
                    $get_device_query = mysqli_query($conn, $get_device);
                    while ($row = mysqli_fetch_array($get_device_query)) {
                        $selected = '';
                        if ($row['DeviceID'] == $TicketDeviceID) $selected = "selected";
                        echo "<option $selected value='" . $row['DeviceID'] . "'>" . $row['DeviceName'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class='col-12 mt-3'>
                <label class="form-label">عنوان التذكرة</label>
                <input type='text' name='TicketTitle' class='form-control' value='<?php echo $TicketTitle; ?>'>
            </div>

            <div class='col-md-12 mt-3'>
                <label class="form-label">تفاصيل المشكلة</label>
                <textarea name='TicketDetails' rows="5" class='form-control'><?php echo $TicketDetails ?></textarea>
            </div>

            <div class="d-flex gap-4 mt-4">
                <input type='submit' name='<?php echo $ButtonName; ?>' id='SaveTicket' class='btn px-4 btn-primary' value='حفظ'>
                <a href='index.php' class='btn px-4 btn-danger'>الغاء</a>
            </div>
        </div>
    </form>
</div>

<!-- Page Footer -->
<?php include 'includes/footer.php' ?>
