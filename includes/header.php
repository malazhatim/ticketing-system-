<!-- Header Included In All Views -->

<html dir="rtl" lang="ar">

<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php if (isset($title)) {
      echo $title;
    } else {
      echo "الدعم الفني";
    }  ?>
  </title>
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<!-- Check For Body Class  -->
<body class="min-vh-100 <?php if (isset($body_class)) { echo $body_class; } else { echo "bg-light";}  ?>">
  <!-- Toggle Navbar -->
  <?php if (isset($no_nav) && $no_nav == true) {
    //
  } else {
    include 'includes/nav.php';
  }  ?>
