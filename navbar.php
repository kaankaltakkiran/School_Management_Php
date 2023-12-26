<?php
session_start();
?>
<nav class="navbar navbar-expand-lg bg-primary " data-bs-theme="dark">
  <div class="container-fluid ">
    <a class="navbar-brand " href="index.php">School Management System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav ">
      <?php if ($_SESSION['isLogin'] == 1) {?>
        <li class="nav-item">
          <a class="nav-link  <?=($activePage == 'index') ? 'active' : '';?>" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img
            src="./IMG_20231009_194219.jpg"
            class="rounded-circle"
            height="25"

            alt="Black and White Portrait of a Man"
            loading="lazy"
          />
          </a>
          <ul class="dropdown-menu  dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <?php }?>
        <?php if ($_SESSION['isLogin'] == 0) {?>
          <li class="nav-item">
          <a class="nav-link  <?=($activePage == 'register') ? 'active' : '';?>" href="register.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  <?=($activePage == 'login') ? 'active' : '';?>" href="login.php">Login</a>
        </li>
          <?php }?>
      </ul>
    </div>
  </div>
</nav>
