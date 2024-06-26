<?php

session_start();
if (!isset($_SESSION['acu'])) {
    header('location:index.php');
} else {
    if (isset($_SESSION['acut'])) {
        if ($_SESSION['acut'] != 3) {
            header('location:AccessDenied.php');
        }
    }
}

?>
<!-- Page Header -->
<?php include 'includes/header.php' ?>

<div class='container pt-4'>
    
    <a href='new_ticket.php' class='btn btn-primary mb-4'>تذكرة جديدة</a>
    
    <?php
        require "connection/connection.php";
        $get_tickets = "SELECT * FROM tickets INNER JOIN devices ON devices.DeviceID = tickets.TicketDevice INNER JOIN users ON users.UserID = tickets.TicketUserID WHERE UserID = " . $_SESSION['acu'] . " ORDER BY FIELD(TicketStatus,'2','1','5','4','6','3','7'),TicketTime";
        $get_tickets_query = mysqli_query($conn, $get_tickets);
        if ($get_tickets_query) {
            if (mysqli_num_rows($get_tickets_query) > 0) {
                echo "<div class='table-responsive bg-white shadow-sm'><table class='table table-bordered shadow-sm mb-0'>";
                echo "<thead><th>#</th><th>رقم التذكرة</th><th>تاريخ فتح التذكرة</th><th>اسم صاحب التذكرة</th><th>الجهاز</th><th>تفاصيل</th><th>حالة</th></thead>";
                echo "<tbody>";
                $counter = 0;
                while ($row = mysqli_fetch_array($get_tickets_query)) {
                    $counter++;
                    $Status = "";
                    $ButtonStyle = "disabled";
                    $ExtraClass = "MyClass";
                    $ButtonLabel = "استلام";
                    $TrStyle = "";
                    switch ($row['TicketStatus']) {
                        case 1:
                            $Status = "جديدة";
                            $TrStyle = "alert-info";
                            break;

                    case 3:
                        $Status = "تم الحل بواسطة القسم الفني";
                        $TrStyle = "alert-success";
                        break;

                    case 4:
                        $Status = "محولة الى الشركة العربية";
                        $TrStyle = "alert-danger";
                        break;

                    case 5:
                        $Status = "تم الاستلام بواسطة الشركة العربية";
                        $TrStyle = "alert-warning";
                        break;

                    case 6:
                        $Status = "تم الحل بواسطة الشركة العربية";
                        $TrStyle = "alert-success";
                        break;

                    case 7:
                        $Status = "مغلقة";
                }
                echo "<tr class=''>
                                <td>" . $counter . "</td>
                                <td>" . $row['TicketNumber'] . "</td>
                                <td>" . $row['TicketTime'] . "</td>
                                <td>" . $row['UserName'] . "</td>
                                <td>" . $row['DeviceName'] . "</td>
                                <td><a type='button' target='_blank' href='ticket.php?tid=".$row['TicketID']."' class='btn btn-sm btn-warning'>مشاهدة</a></td>
                                <td><div class='alert py-0 mb-0 " . $TrStyle . "'>" . $Status . "</div></td></tr> ";
            }
            echo "</table></div>";
        } else {
            echo "<div class='row'><div class='col-md-12'><label class='alert-primary'> لا توجد تذاكر</label></div></div>";
        }
    }
    ?>
</div>

<!-- Page Footer -->
<?php include 'includes/footer.php' ?>
