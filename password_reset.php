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
require_once "connection/connection.php";
$UserID = "";
if (isset( $_GET['uid'])) {
    $UserID = $_GET['uid'];
}
else{
    header('location:AccessDenied.php');
}
// Page Title ------
$title = "مستخدم جديد";
?>
<!-- Page Header -->
<?php include 'includes/header.php' ?>


<div class='container pt-5'>
    <form action='reset.php' method='POST' class="card shadow-sm p-4 border-0">
        <div class="row">
            <div class='col-md-6 mt-3'>
                <label class="form-label">كلمة المرورو الجديدة</label>
                <input type='password' name='UserPassword' class='form-control' value=''>
            </div>
            <div class='col-md-6 mt-3'>
                <label class="form-label">تأكيد كلمة المرور</label>
                <input type='password' name='ConfirmPassword' class='form-control' value=''>
            </div>
            <input type='hidden' name='UserID' value='<?php echo $UserID; ?>'>
        </div>
        <div class="d-flex gap-4 mt-4">
            <input type='submit' name='ResetPassword' id='Reset' class='btn px-4 btn-primary' value='Reset'>
            <a href='users.php' class='btn px-4 btn-danger'>الغاء</a>
        </div>
    </form>
</div>

<!-- Page Footer -->
<?php include 'includes/footer.php' ?>
