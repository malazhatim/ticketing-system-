<?php
//this page transfer tickets fromm support user to another
//check if user is logged in or not 
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
require_once "connection/connection.php";
$UserID = "";
if (isset( $_GET['uid'])) {
    $UserID = $_GET['uid'];
}
else{
    header('location:AccessDenied.html');
}
// Page Title ------
$title = "تحويل تذاكر";
?>
<!-- Page Header -->
<?php include 'includes/header.php' ?>


<div class='container pt-5'>
    <form action='switch.php' method='POST' class="card shadow-sm p-4 border-0">
        <div class="row">
            <div class='col-md-6 mt-3'>
                <label class="form-label">تحويل كل التذاكر المستلمة الى</label>
                <select name="ToUser" id="ToUser" class="form-control">
                    <option value="">اختر المستخدم الجديد</option>
                    <?php
                        $users = "SELECT * FROM users WHERE UserType=2 AND Deleted=0";                        
                        $users_query = mysqli_query($conn,$users);
                        while($row=mysqli_fetch_array($users_query)){
                            echo "<option value='".$row['UserID']."'>".$row['UserName']."</option>";
                        }
                    ?>
                </select>
            </div>
            <input type='hidden' name='UserID' value='<?php echo $UserID; ?>'>
        </div>
        <div class="d-flex gap-4 mt-4">
            <input type='submit' name='SwitchUser' id='Reset' class='btn px-4 btn-primary' value='تحويل'>
            <a href='users.php' class='btn px-4 btn-danger'>الغاء</a>
        </div>
    </form>
</div>

<!-- Page Footer -->
<?php include 'includes/footer.php' ?>
