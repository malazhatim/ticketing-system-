<?php

// Feed Back
$type = $text = "";

if (isset($_GET['fb'])) {
  switch ($_GET['fb']) {
    case 1:
      $text = "تم اضافة المستخدم بنجاح";
      $type = "success";
      break;
    case 2:
      $text = "حدث خطأ اثناء عملية الاضافة";
      $type = "error";
      break;
    case 3:
      $text = "الايميل مستخدم مسبقاً";
      $type = "error";
      break;
    case 4:
      $text = "تم الحذف بنجاح";
      $type = "success";
      break;
    case 5:
      $text = "تم التعديل بنجاح";
      $type = "success";
      break;
    case 6:
      $text = "حدث خطأ أثناء عملية التعديل";
      $type = "error";
      break;
    case 7:
      $text = "تم اعادة تهيئة كلمة المرور بنجاح";
      $type = "success";
      break;
    case 8:
      $text = "حدث خطأ أثناء تهيئة كلمة المرور";
      $type = "error";
      break;
    case 9:
      $text = "المستخدم يمتلك تذاكرة مستلمة الرجاء تحويلها الى مستخدم اخر او الى الشركة العربية قبل حذفه";
      $type = "error";
      break;
    case 10:
      $text = "تم تحويل تذاكرة المستخدم بنجاح";
      $type = "success";
      break;
    case 11:
      $text = "حذث خطأ أثناء تحويل التذاكرة";
      $type = "error";
      break;
    case 12:
      $text = "تم تغيير حالة التذكرة بنجاح";
      $type = "success";
      break;
    case 31:
      $text = "تم الحذف بنجاح";
      $type = "success";
      break;
    case 32:
      $text = "تعذر حذف الجهاز - الجهاز مستخدم";
      $type = "error";
      break;
    case 33:
        $text = "تم اضافة الجهاز بنجاح";
        $type = "success";
        break;
    case 34:
        $text = "تم تعديل الجهاز بنجاح";
        $type = "success";
        break;
    default:
      $text = "طريقة وصول خاطئة للصفحة";
      $type = "error";
  }
}
?>

<!-- Noty -->
<link rel="stylesheet" href="./assets/css/noty.min.css">
<script src="./assets/js/noty.min.js"></script>
<!-- Configration -->
<script>
  new Noty({
    theme: 'bootstrap-v4',
    type: "<?php echo $type ?>",
    layout: 'topRight',
    text: "<?php echo $text ?>",
    timeout: 5000
  }).show();
</script>
