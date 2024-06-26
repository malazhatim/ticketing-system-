<?php

session_start();
if (!isset($_SESSION['acu'])) {
    header('location:index.php');
} else {
    if (isset($_SESSION['acut'])) {
        if (($_SESSION['acut'] != 1)&&($_SESSION['acut'] != 2)) {
            header('location:AccessDenied.php');
        }
    }
}


// Page Title ------
$title = "الأجهزة";
?>


<?php include 'includes/header.php' ?>

    <div class='container'>
        <a href='index.php' class='btn btn-primary mb-4 px-4'>عودة</a>
        <div class='card bg-white border-0 shadow-sm'>
            <div class="card-header bg-white d-flex justify-content-between">
                <h4>الأجهزة</h4>
                <a class='btn btn-primary' href='new_device.php'>اضافة نوع جهاز</a>
            </div>
            <div class="card-body">
                <?php
                require "connection/connection.php";
                $get_tickets = "SELECT * FROM devices";
                $get_tickets_query = mysqli_query($conn, $get_tickets);
                if ($get_tickets_query) {
                    if (mysqli_num_rows($get_tickets_query) > 0) {
                        echo "<div class='table-responsive'><table class='table table-bordered'>";
                        echo "<thead><th>#</th><th>الجهاز</th><th></th></thead>";
                        echo "<tbody>";
                        $counter = 0;
                        while ($row = mysqli_fetch_array($get_tickets_query)) {
                            $counter++;
                            echo "<tr>
                                <td>" . $counter . "</td>
                                <td>" . $row['DeviceName'] . "</td>
                                <td><button  onclick='edit_device(" . $row['DeviceID'] . ",)' class='btn btn-success'>تعديل</button>
                                <button class='btn btn-danger'  onclick='delete_device(" . $row['DeviceID'] . ",\"" . $row['DeviceName'] . "\")'>حذف</button></td></tr>
                                ";
                        }
                        echo "</table></div>";
                    }
                }
                ?>
            </div>
        </div>

        <!-- Delete Confirmation -->
        <script>
            function delete_device(DeviceID, DeviceName) {
                let deleteDevice = confirm('هل أنت متأكد من حذف الجهاز ' + DeviceName + ' ؟ ');
                if (deleteDevice) {
                    window.location = 'delete_device.php?did=' + DeviceID;
                }
            }

            function edit_device(DeviceID){
                window.location = 'new_device.php?did='+ DeviceID;
            }
            
        </script>

<?php include 'includes/footer.php' ?>
