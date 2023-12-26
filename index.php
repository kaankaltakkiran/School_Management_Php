<?php
@session_start();
require 'loginControl.php';
$activePage = 'index';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
  <?php require 'navbar.php';?>
  <div class="container">
      <div class="row">
      <h1 class="text-danger text-center mt-3">School Management System V1</h1>
      <?php if ($_SESSION['rol'] == 1) {?>
        <h2 class="text-success text-center mt-3">!!!This İs Admin Page!!!</h2>
        <?php }?>

        <h3 class="text-warning text-center mt-3">Welcome</h3>
        <h4 class="text-info text-center mt-3">Name: <?php echo $_SESSION['adsoyad'] ?></h4>
      </div>
      <?php if ($_SESSION['rol'] == 1) {?>
      <div class="row">
        <div class="col-md-4">
        <div class="card m-3" style="width: 18rem;">
  <img src="./Public/img/admin.jpg" class="card-img-top" alt="Admin Image" loading="lazy">
  <div class="card-body">
    <h5 class="card-title text-danger">Admin</h5>
    <p class="card-text">Admin adds admin to the system by clicking the add admin button.</p>
    <a href="adminRegister.php" class="btn btn-danger">Add Admin</a>
  </div>
</div>
        </div>
        <div class="col-md-4">
        <div class="card m-3" style="width: 18rem;">
  <img src="./Public/img/teacher.jpg" class="card-img-top" alt="Teacher Image"loading="lazy">
  <div class="card-body">
    <h5 class="card-title text-success">Teacher</h5>
    <p class="card-text">Admin adds a teacher to the system by clicking the add admin button.</p>
    <a href="#" class="btn btn-success">Add Teacher</a>
  </div>
</div>
        </div>
        <div class="col-md-4">
        <div class="card m-3" style="width: 18rem;">
  <img src="./Public/img/student.jpg" class="card-img-top" alt="Student Image"loading="lazy">
  <div class="card-body">
    <h5 class="card-title text-primary">Student</h5>
    <p class="card-text">Admin adds student to the system by clicking the add admin button.</p>
    <a href="#" class="btn btn-primary">Add Student</a>
  </div>
</div>
        </div>
      </div>
  </div>
  <?php }?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
