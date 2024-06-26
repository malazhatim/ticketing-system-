<?php

session_start();
if (!isset($_SESSION['acu'])) {
    header('location:index.php');
}
if (!isset($_GET['tid'])) {
    header('location:index.php');
}
require_once "connection/connection.php";
$LabelStyle = "";
function MyStatus($StatusID)
{
    switch ($StatusID) {
        case 0:
            return "لا يوجد";
            break;

        case 1:
            return "جديدة";
            break;

        case 2:
            return "تم الاستلام بواسطة القسم الفني";
            break;

        case 3:
            return "تم الحل بواسطة القسم الفني";
            break;

        case 4:
            return "محولة الى الشركة العربية";
            break;

        case 5:
            return "تم الاستلام بواسطة الشركة العربية";
            break;

        case 6:
            return "تم الحل بواسطة الشركة العربية";
            break;

        case 7:
            return "مغلقة";
    }
}
$TicketID = $_GET['tid'];
$get_ticket = "SELECT *,husers.UserName AS handler,husers.UserPhone AS handlerPhone,husers.UserEmail AS handlerEmail,uusers.UserName AS TicketBy, uusers.UserPhone AS phone, uusers.UserEmail AS email FROM tickets INNER JOIN devices ON devices.DeviceID = tickets.TicketDevice INNER JOIN (SELECT * FROM users)uusers ON uusers.UserID = tickets.TicketUserID LEFT OUTER JOIN (SELECT * FROM users)husers ON husers.UserID = tickets.TicketHandleBy WHERE TicketID = $TicketID";
$get_ticket_query = mysqli_query($conn, $get_ticket);
$MyTicket = "";
$Status = "";
$LabelStyle = "";
if ($get_ticket_query) {
    if (mysqli_num_rows($get_ticket_query)) {
        $MyTicket = mysqli_fetch_array($get_ticket_query);
        $Status = MyStatus($MyTicket['TicketStatus']);
        switch ($MyTicket['TicketStatus']) {
            case 1:
                $LabelStyle = "alert-info";
                break;
            case 2:
                $LabelStyle = "alert-warning";
                break;

            case 3:
                $LabelStyle = "alert-success";
                break;

            case 4:
                $LabelStyle = "alert-primary";
                break;

            case 5:
                $LabelStyle = "alert-warning";
                break;

            case 6:
                $LabelStyle = "alert-success";
                break;
            case 7:
                $LabelStyle = "alert-danger";
        }
    } else {
        header('location:index.php');
    }
} else {
    header('location:index.php');
}
// Page Title ------
$title = "تذكرة";
?>
<!-- Page Header -->
<?php include 'includes/header.php' ?>

<div class='container py-4'>
    <a href='index.php' class='btn btn-primary px-4 mb-4'>عودة</a>
    <div class="shadow-sm p-4 bg-white">
        <div class='row mb-4'>
            <div class='col-md-4 mb-2'>
                <strong class="me-2">رقم التذكرة :</strong>
                <span class='text-muted'><?php echo $MyTicket['TicketNumber'] ?></span>
            </div>
            <div class='col-md-4 mb-2'>
                <strong class="me-2">الجهاز :</strong>
                <span class='text-muted'><?php echo $MyTicket['DeviceName'] ?></span>
            </div>
            <div class='col-md-4 mb-2'>
                <strong class="me-2">عنوان التذكرة :</strong>
                <span class='text-muted'><?php echo $MyTicket['TicketTitle'] ?></span>
            </div>
            <div class='col-md-4 mb-2'>
                <strong class="me-2">المستخدم :</strong>
                <span class='text-muted'><?php echo $MyTicket['TicketBy'] ?></span>
            </div>
            <div class='col-md-4 mb-2'>
                <strong class="me-2">رقم هاتف المستخدم :</strong>
                <span class='text-muted'><?php echo $MyTicket['phone'] ?></span>
            </div>
            <div class='col-md-4 mb-2'>
                <strong class="me-2">بريد المستخدم :</strong>
                <span class='text-muted'><?php echo $MyTicket['email'] ?></span>
            </div>
            <div class='col'>
                <strong class="mb-2 d-block">تفاصيل التذكرة</strong>
                <p class="border p-4 w-100"><?php echo $MyTicket['TicketDetails'] ?> </p>
            </div>
        </div>
        <div class='d-flex gap-3 flex-wrap w-100'>
            <div class='mb-3 flex-grow-1'>
                <strong class="me-2">الحالة :</strong>
                <span class='px-3 <?php echo $LabelStyle; ?>'><?php echo $Status; ?></span>
            </div>
            <div class='mb-3 flex-grow-1'>
                <strong class="me-2">زمن التذكرة :</strong>
                <span class='text-muted '><?php echo $MyTicket['TicketTime'] ?></span>
            </div>
            <div class='mb-3 flex-grow-1'>
                <strong class="me-2">المستلم :</strong>
                <span class='text-muted '><?php echo $MyTicket['handler'] ?></span>
            </div>
            <div class='mb-3 flex-grow-1'>
                <strong class="me-2">رقم المستلم :</strong>
                <span class='text-muted '><?php echo $MyTicket['handlerPhone'] ?></span>
            </div>
            <div class='mb-3 flex-grow-1'>
                <strong class="me-2">بريد المستلم :</strong>
                <span class='text-muted '><?php echo $MyTicket['handlerEmail'] ?></span>
            </div>
        </div><br />
        <div class='row'>
            <div class='col-md-12'>
                <strong class="mb-2 d-block">تاريخ احداث التذكرة</strong>
            </div>
        </div>
        <div class="table-responsive">
            <table class='table table-bordered'>
                <thead>
                    <th>#</th>
                    <th>تاريخ</th>
                    <th>نوع الحدث</th>
                    <th>عن طريق</th>
                    <th>الحالة قبل</th>
                    <th>تعليق</th>
                    <th>الحالة بعد</th>
                </thead>
                <tbody>
                    <?php
                    $get_ticket_actions = "SELECT * FROM ticket_actions INNER JOIN users ON users.UserID = ticket_actions.TicketActionBy WHERE TicketID = $TicketID ORDER BY TicketActionTime DESC";
                    $get_ticket_actions_query = mysqli_query($conn, $get_ticket_actions);
                    $counter = 0;
                    if ($get_ticket_actions_query) {
                        while ($row = mysqli_fetch_array($get_ticket_actions_query)) {
                            $ActionType = "";
                            $PreviousStatus = MyStatus($row['TicketActionPerviousStatus']);
                            $NewStatus = MyStatus($row['TicketActionNewStatus']);
                            if ($row['TicketActionPerviousStatus'] == $row['TicketActionNewStatus']) {
                                $ActionType = "تعليق";
                            } else {
                                $ActionType = "تغيير حالة";
                            }
                            $counter++;
                            echo "
                                    <tr><td>" . $counter . "</td>
                                    <td>" . $row['TicketActionTime'] . "</td>
                                    <td>" . $ActionType . "</td>
                                    <td>" . $row['UserName'] . "</td>
                                    <td>$PreviousStatus</td>
                                    <td>" . $row['TicketActionComment'] . "</td>
                                    <td>$NewStatus</td>
                                    </tr>
                                ";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <form action="save_comment.php" method='POST' class="d-flex gap-3">
            <input type='text' name='comment' placeholder='اضافة تعليق جديد' class='form-control'>
            <input type="hidden" name="ticket" value='<?php echo $_GET['tid']; ?>'>
            <input type='submit' name='addComment' class='btn btn-primary' value='إضافة'>
        </form>
    </div>
</div>
<div class="my-4"></div>

<!-- Page Footer -->
<?php include 'includes/footer.php' ?>
