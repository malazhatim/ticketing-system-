<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-4">
  <div class="container">
    <a class="navbar-brand" href="index.php">الدعم الفني </a>
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
      <ul class="navbar-nav me-auto mt-2 mt-lg-0 w-100">
        <?php  if($_SESSION['acut'] == 1) { ?>
        <li class="nav-item">
          <a href='users.php' class='nav-link'>المستخدمين</a>
        </li>
        <?php } ?>
        <?php  if(($_SESSION['acut'] == 1) || ($_SESSION['acut'] == 2)) { ?>
        <li class="nav-item">
          <a href='devices.php' class='nav-link'>الأجهزة</a>
        </li>
        <?php } ?>
        <li class="nav-item ms-md-auto">
          <a href='logout.php' class='btn btn-danger'>تسجيل خروج</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
