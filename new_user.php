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
$UserName = "";
$UserEmail = "";
$UserPhoneNumber = "";
$UserType = 0;
$UserSuspended = 0;
$support_selected = "";
$user_selected = "";
$ButtonName = "SaveUser";
require_once "connection/connection.php";
if (isset( $_GET['uid'])) {
    $UserID = $_GET['uid'];
    $get_user = "SELECT * FROM users WHERE UserID = $UserID";
    $get_user_query = mysqli_query($conn,$get_user);
    if ($get_user_query) {
        if (mysqli_num_rows($get_user_query)) {
            $MyUser = mysqli_fetch_array($get_user_query);
            $UserName = $MyUser['UserName'];
            $UserEmail = $MyUser['UserEmail'];
            $UserPhoneNumber = $MyUser['UserPhone'];
            $UserType = $MyUser['UserType'];
            switch($UserType){
                case 2:
                    $support_selected = "selected";
                    break;
                case 3:
                    $user_selected = "selected";
            }
            $UserSuspended = $MyUser['UserSusspend'];
            $ButtonName = "UpdateUser";
        }
    }
}
// Page Title ------
$title = "مستخدم جديد";
?>
<!-- Page Header -->
<?php include 'includes/header.php' ?>


<div class='container pt-5'>
    <form action='save_user.php' method='POST' class="card shadow-sm p-4 border-0">
        <div class="card-header bg-white mb-4">
            <h1 class="h4">مستخدم جديد</h1>
        </div>
        <div class='row'>
            <div class='col-md-6'>
                <label class="form-label">اسم المستخدم</label>
                <input type='text' class='form-control' id='UserName' name='UserName' value='<?php echo $UserName; ?>'>
            </div>
            <div class='col-md-6 mt-3 mt-md-0'>
                <label class="form-label">نوع المستخدم</label>
                <select id='UserType' name='UserType' class='form-control'>
                    <option value=''> اختر النوع</option>
                    <option <?php echo $support_selected; ?> value='2'>Support</option>
                    <option <?php echo $user_selected; ?> value='3'>End User</option>
                </select>
            </div>
            <div class='col-md-6 mt-3'>
                <label class="form-label">بريد المستخدم الالكتروني</label>
                <input type='text' name='UserEmail' class='form-control' value='<?php echo $UserEmail; ?>'>
            </div>

            <div class='col-md-6 mt-3'>
                <label class="form-label">رقم هاتف المستخدم</label>
                <input type='text' name='UserPhone' class='form-control' value='<?php echo $UserPhoneNumber; ?>'>
            </div>
            <?php
            if(!isset($_GET['uid'])){?>
            <div class='col-md-6 mt-3'>
                <label class="form-label">كلمة المرورو</label>
                <input type='password' name='UserPassword' class='form-control' value=''>
            </div>
            <div class='col-md-6 mt-3'>
                <label class="form-label">تأكيد كلمة المرور</label>
                <input type='password' name='ConfirmPassword' class='form-control' value=''>
            </div>
            <?php }
                else{
                    echo "<input type='hidden' name='UserID' value='$UserID'>";
                }
            ?>
            <div class='col-12 mt-3 ms-3 form-check'>
                <input type='checkbox' class="form-check-input" name='suspend' id="suspend">
                <label class="form-check-label" for="suspend">موقوف</label>
            </div>

            <div class="d-flex gap-4 mt-4">
                <input type='submit' name='<?php echo $ButtonName; ?>' id='SaveUser' class='btn px-4 btn-primary' value='حفظ'>
                <a href='users.php' class='btn px-4 btn-danger'>الغاء</a>
            </div>
        </div>
    </form>
</div>

<!-- Page Footer -->
<?php include 'includes/footer.php' ?>
