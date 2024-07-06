<?php
session_start();


function redirect_page()
{
    //this function check the current session to check which type of the users is logged to redirect
    if (isset($_SESSION['acut'])) {
        $UserType = $_SESSION['acut'];
        switch ($UserType) {
            case 1:
                header('location:AdminPage.php');
                break;
            case 2:
                header('location:SupportPage.php');
                break;
            case 3:
                header('location:UserPage.php');
                break;
            default:
                $result = 2;
                break;
        }
    }
}
if (isset($_POST['login'])) {
    $result = 0;
    require_once 'connection/connection.php';
    $email = $_POST['username'];
    $password = $_POST['password'];
    $check_login = "SELECT * FROM users WHERE UserEmail = '$email' AND UserPassword = '" . md5($password) . "'";
    //checking if user with entered email and password exist or not
    $check_login_query = mysqli_query($conn, $check_login);
    $UserID = $_SESSION['acu'];
    $UserType = $_SESSION['acut'];
    if ($check_login_query) {
        if (mysqli_num_rows($check_login_query) > 0) {
            $MyRow = mysqli_fetch_array($check_login_query);
            $result = 0;
           if ($MyRow['UserSusspend']==1) {
            //check if user is suspended from login
               $result = 2;
            }
            if($MyRow['Deleted']==1) {
                //check if user is deleted from the system
                $result = 3;
            }
        } else {
            $result = 1;
        }
        switch($result){
            case 0:
                $_SESSION['acu'] = $MyRow['UserID'];
                $_SESSION['acut'] = $MyRow['UserType'];
                redirect_page();
                break;
            case 1:
                header('location:login.php?lfb=1');
                break;
            case 2:
                header('location:login.php?lfb=2');
                break;
            case 3:
                header('location:login.php?lfb=3');
                break;
        }
    }
}
$ErrorMessage = "";
$ErrorLabel = "alert-danger";

// Page Title ------
$title = "دخول";
// Body Class
$body_class = "bg-gradient bg-primary";
// Toggle Navbar
$no_nav = true;
if(isset($_GET['lfb'])){
    $LoginFeedBack = $_GET['lfb'];
    switch($LoginFeedBack){
        //check which feed back message type is sent to the page to display the message
        case 1: $ErrorMessage = "خطأ في اسم المستخدم أو كلمة المرور";
        break;
        case 2: $ErrorMessage = "المستخدم موقوف الرجاء مراجعة مدير النظام";
        break;
        case 3: $ErrorMessage = "المستخدم محذوف الرجاء مراجعة مدير النظام";
        break;
        default: $ErrorMessage = "طريقة وصول خاطئة للصفحة";

    }
}
?>

<!-- Page Header -->
<?php include 'includes/header.php' ?>

<div class='container d-flex align-items-center justify-content-center h-100'>
    <div class='card px-4 py-5 col-12 col-md-10 col-lg-6 border-0 shadow-sm'>
        <div class="overlay"></div>
        <h1 class="h3">تسجيل الدخول</h1>
        <small class="text-muted mb-4">مرحبا بك في نظام الدعم الفني</small>

        <p class='<?php echo $ErrorLabel; ?> text-center'><?php echo $ErrorMessage; ?></p>
        <form action='' method='POST'>
            <div class="mb-3">
                <label class="form-label text-muted">البريد الالكتروني</label>

                <div class="input-group">
                    <span class="input-group-text bg-primary border-primary text-white" id="basic-addon1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                        </svg>
                    </span>
                    <input type='text' name='username' id='username' class='form-control'>
                </div>
            </div>

            <div class='mb-3'>
                <label class="form-label text-muted">كلمة المرور</label>
                <div class="input-group">
                    <span class="input-group-text bg-primary border-primary text-white" id="basic-addon1">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                            <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                            <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                        </svg>
                    </span>
                    <input type='password' name='password' id='password' class='form-control'>
                </div>
            </div>

            <div class='mb-3'>
                <button type='submit' name='login' id='login' class='btn btn-primary w-100'>تسجيل الدخول</button>
            </div>

        </form>
    </div>
</div>

<!-- Page Footer -->
<?php include 'includes/footer.php' ?>
