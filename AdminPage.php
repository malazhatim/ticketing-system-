<?php

session_start();
if (!isset($_SESSION['acu'])) {
    header('location:index.php');
} else {
    if (isset($_SESSION['acut'])) {
        if ($_SESSION['acut'] != 1) {
            header('location:AccessDenied.html');
        }
    }
}

?>
<html dir="rtl" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title> الصفحة الرئسية</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <script>
        function changeTicketStatus(TicketID,TicketCurrentStatus){
            let TicketNextStatus = TicketCurrentStatus+1;
            window.location = 'changeTicketStatus.php?tid='+TicketID+'&na='+TicketNextStatus;
        }    
    </script>
</head>

<body class="bg-light min-vh-100">
    <?php include "includes/nav.php" ?>
    <div class='container d-flex justify-content-center align-items-center py-5'>
        <?php
        require "connection/connection.php";
        $get_tickets = "SELECT * FROM tickets INNER JOIN devices ON devices.DeviceID = tickets.TicketDevice INNER JOIN users ON users.UserID = tickets.TicketUserID ORDER BY FIELD(TicketStatus,'5','4','2','1','6','3','7'),TicketTime";
        $get_tickets_query = mysqli_query($conn, $get_tickets);
        if ($get_tickets_query) {
            if (mysqli_num_rows($get_tickets_query) > 0) { ?>
                <div class="table-responsive bg-white w-100 shadow-sm">
                    <table class='table table-hover text-center align-middle mb-0'>
                        <thead class="">
                            <th>#</th>
                            <th>رقم التذكرة</th>
                            <th>تاريخ فتح التذكرة</th>
                            <th>اسم صاحب التذكرة</th>
                            <th>الجهاز</th>
                            <th>مشاهدة</th>
                            <th>تفاصيل</th>
                            <th>حالة</th>
                            <th></th>
                        </thead>
                        <tbody class="bg-white">
                            <?php
                            $counter = 0;
                            while ($row = mysqli_fetch_array($get_tickets_query)) {
                                $counter++;
                                $Status = "";
                                $ButtonStyle = "disabled";
                                $ExtraClass = "MyClass";
                                $ButtonLabel = "استلام";
                                $TrStyle = "bg-danger";
                                switch ($row['TicketStatus']) {
                                    case 1:
                                        $Status = "جديدة";
                                        $TrStyle = "alert-info";
                                        break;

                                    case 2:
                                        $Status = "تم الاستلام بواسطة القسم الفني";
                                        $TrStyle = "alert-warning text-dark";
                                        break;

                                    case 3:
                                        $Status = "تم الحل بواسطة القسم الفني";
                                        $TrStyle = "alert-success text-dark";
                                        break;

                                    case 4:
                                        $Status = "محولة الى الشركة العربية";
                                        $ExtraClass = "";
                                        $ButtonStyle = "";
                                        $TrStyle = "alert-primary";
                                        break;

                                    case 5:
                                        $Status = "تم الاستلام بواسطة الشركة العربية";
                                        $ExtraClass = "btn-success";
                                        $ButtonLabel = "تم الحل";
                                        $ButtonStyle = "btn-success";
                                        $TrStyle = "alert-warning text-dark";
                                        break;

                                    case 6:
                                        $Status = "تم الحل بواسطة الشركة العربية";
                                        $TrStyle = "alert-success text-dark";
                                        break;

                                    case 7:
                                        $Status = "مغلقة";
                                } ?>
                                <tr class=''>
                                    <td><?php echo $counter  ?></td>
                                    <td><?php echo $row['TicketNumber']  ?></td>
                                    <td><?php echo $row['TicketTime']  ?></td>
                                    <td><?php echo $row['UserName']  ?></td>
                                    <td><?php echo $row['DeviceName']  ?></td>
                                    <td><a type='button' target='_blank' href='ticket.php?tid=<?php echo $row['TicketID'];?>' class='btn btn-warning'>مشاهدة</a></td>
                                    <td class="">
                                        <span class="alert py-0 <?php echo $TrStyle ?>"><?php echo $Status ?></span>
                                    </td>
                                    <td><input type='button' onclick='changeTicketStatus(<?php echo $row['TicketID'].",".$row['TicketStatus'];?>)' value='<?php echo $ButtonLabel ?>' <?php echo $ButtonStyle ?> class='btn btn-primary <?php echo $ExtraClass ?>'></td>
                                </tr>
                            <?php } ?>
                    </table>
                </div>
            <?php } else { ?>
                <div class='alert alert-warning'> لا توجد تذاكر</div>
        <?php }
        } ?>

    </div>


    <!-- Dots -->
    <?php include 'includes/dots.php' ?>
    <!-- Dots -->

    <script src="./assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>
