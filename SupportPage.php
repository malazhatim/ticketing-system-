<?php

session_start();
if (!isset($_SESSION['acu'])) {
    header('location:index.php');
} else {
    if (isset($_SESSION['acut'])) {
        if ($_SESSION['acut'] != 2) {
            header('location:AccessDenied.html');
        }
    }
}

// Page Title ------
$title = "الدعم";
?>
<!-- Page Header -->
<?php include 'includes/header.php' ?>

<head>
    <title>الصفحة الرئيسية</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <script>
        function changeTicketStatus(TicketID,TicketNewAction){
            window.location = 'changeTicketStatus.php?tid='+TicketID+'&na='+TicketNewAction;
        }
    </script>
</head>

<body class="bg-light">
    <div class='container pt-4'>
        <?php
        require "connection/connection.php";
        $get_tickets = "SELECT * FROM tickets INNER JOIN devices ON devices.DeviceID = tickets.TicketDevice INNER JOIN users ON users.UserID = tickets.TicketUserID ORDER BY FIELD(TicketStatus,'2','1','5','4','6','3','7'),TicketTime";
        //getting all system's tickets
        $get_tickets_query = mysqli_query($conn, $get_tickets);
        if ($get_tickets_query) {
            if (mysqli_num_rows($get_tickets_query) > 0) {
                echo "<div class='table-responsive bg-white shadow-sm'><table class='table table-bordered mb-0'>";
                echo "<thead><th>#</th><th>رقم التذكرة</th><th>تاريخ فتح التذكرة</th><th>اسم صاحب التذكرة</th><th>الجهاز</th><th>تفاصيل</th><th>حالة</th><th>Action</th><th>تحويل</th><th>إغلاق</th></thead>";
                echo "<tbody>";
                $counter = 0;
                while ($row = mysqli_fetch_array($get_tickets_query)) {
                    $counter++;
                    $Status = "";
                    $ButtonStyle = "disabled";
                    $ExtraClass = "MyClass";
                    $ButtonLabel = "استلام";
                    $TrStyle = "";
                    $Closed = "";
                    $Transfer = "";
                    $Process = "";
                    $ProcessLabel = "استلام";
                    $CloseLabel = "إغلاق";
                    $TicketNewAction = 0;
                    $CloseNext = 7;
                    switch ($row['TicketStatus']) {
                    case 1:
                        $Status = "جديدة";
                        $TrStyle = "alert-info py-0";
                        $TicketNewAction = 2;
                        break;
                    case 2:
                        $Status = "تم الاستلام بواسطة القسم الفني";
                        $TrStyle = "alert-secondary py-0";
                        $ProcessLabel = "تم الحل";
                        $TicketNewAction = 3;
                        break;
                    case 3:
                        $Status = "تم الحل بواسطة القسم الفني";
                        $TrStyle = "alert-success text-dark py-0";
                        $Process = "disabled";
                        $Transfer = "disabled";
                        $ProcessLabel = "تم الحل";
                        break;

                    case 4:
                        $Status = "محولة الى الشركة العربية";
                        $Transfer = "disabled";
                        $Process = "disabled";
                        $TrStyle = "alert-danger py-0";
                        break;

                    case 5:
                        $Status = "تم الاستلام بواسطة الشركة العربية";
                        $Transfer = "disabled";
                        $Process = "disabled";
                        $TrStyle = "alert-warning py-0";
                        break;

                    case 6:
                        $Status = "تم الحل بواسطة الشركة العربية";
                        $TrStyle = "alert-success py-0";
                        $Process = "disabled";
                        $Transfer = "disabled";
                        break;

                    case 7:
                        $Status = "مغلقة";
                        $Transfer = "disabled";
                        $Process = "disabled";
                        $CloseLabel = 'فتح';
                        $TrStyle = "alert-dark py-0";
                        $CloseNext = '2';
                }
                echo "<tr>
                                <td>" . $counter . "</td>
                                <td>" . $row['TicketNumber'] . "</td>
                                <td>" . $row['TicketTime'] . "</td>
                                <td>" . $row['UserName'] . "</td>
                                <td>" . $row['DeviceName'] . "</td>
                                <td><a type='button' target='_blank' href='ticket.php?tid=".$row['TicketID']."' class='btn btn-sm btn-warning'>مشاهدة</a></td>
                                <td><div class='alert ".$TrStyle."'>".$Status."</div></td>
                                <td><input type='button' onclick='changeTicketStatus(".$row['TicketID'].",$TicketNewAction)' value='$ProcessLabel' $Process class='btn btn-sm btn-primary '></td>
                                <td><input type='button' onclick='changeTicketStatus(".$row['TicketID'].",4)' value='تحويل'$Transfer class='btn btn-sm btn-success '></td>
                                <td><input type='button' onclick='changeTicketStatus(".$row['TicketID'].",$CloseNext)' value='$CloseLabel' $Closed class='btn btn-sm btn-danger'></td></tr>
                                ";
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
