<?php

session_start();
if (!isset($_SESSION['acu'])) {
    header('location:index.php');
} else {
    if (isset($_SESSION['acut'])) {
        if ($_SESSION['acut'] != 1) {
            header('location:AccessDenied.php');
        }
    }
}

// Page Title ------
$title = "المستخدمين";
?>


<?php include 'includes/header.php' ?>

    <div class='container'>
        <a href='index.php' class='btn btn-primary mb-4 px-4'>عودة</a>
        <div class='card bg-white border-0 shadow-sm'>
            <div class="card-header bg-white d-flex justify-content-between">
                <h4>المستخدمين</h4>
                <a class='btn btn-primary' href='new_user.php'>اضافة مستخدم</a>
            </div>
            <div class="card-body">
                <?php
                require "connection/connection.php";
                $get_tickets = "SELECT * FROM users WHERE Deleted = 0";
                $get_tickets_query = mysqli_query($conn, $get_tickets);
                if ($get_tickets_query) {
                    if (mysqli_num_rows($get_tickets_query) > 0) {
                        echo "<div class='table-responsive'><table class='table table-bordered'>";
                        echo "<thead><th>#</th><th>اسم المستخدم</th><th>بريد المستخدم</th><th>نوع المستخدم</th><th>Actions</th></thead>";
                        echo "<tbody>";
                        $counter = 0;
                        while ($row = mysqli_fetch_array($get_tickets_query)) {
                            $counter++;
                            $UserType = "";
                            $button = "";
                            switch ($row['UserType']) {
                                case 1:
                                    $UserType = "الشركة العربية للكمبيوتر";
                                    $button = 'disabled';
                                    break;
                                case 2:
                                    $UserType = "القسم الفني";
                                    break;
                                case 3:
                                    $UserType = "مستخدم";
                                    break;
                            }
                            echo "<tr>
                                <td>" . $counter . "</td>
                                <td>" . $row['UserName'] . "</td>
                                <td>" . $row['UserEmail'] . "</td>
                                <td>$UserType</td>
                                <td><button $button onclick='edit_user(" . $row['UserID'] . ",)' class='btn btn-success'>تعديل</button>
                                <a type='button' href='password_reset.php?uid=" . $row['UserID'] . "' class='btn btn-warning'>Reset Password</a>
                                <button $button onclick='switch_tickets(" . $row['UserID'] . ",)' class='btn btn-info'>تحويل التذاكر</button>
                                <button class='btn btn-danger' $button onclick='delete_user(" . $row['UserID'] . ",\"" . $row['UserName'] . "\")'>حذف</button></td></tr>
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
            function delete_user(UserID, UserName) {
                let deleteUser = confirm('هل أنت متأكد من حذف المستخدم ' + UserName + ' ؟ ');
                if (deleteUser) {
                    window.location = 'delete_user.php?uid=' + UserID;
                }
            }

            function edit_user(UserID){
                window.location = 'new_user.php?uid='+ UserID;
            }
            
            function switch_tickets(UserID){
                window.location = 'switch_tickets.php?uid='+ UserID;

            }
        </script>

<?php include 'includes/footer.php' ?>
