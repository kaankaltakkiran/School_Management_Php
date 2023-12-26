<!-- Kullanıcı üye bilgilerini veri tabanına kaydetme -->
<?php
if (isset($_POST['submit'])) {
    //!Hata mesajlarını göstermek için boş bir dizi
    $errors = array();
    //!Başırılı mesajlarını göstermek için boş bir dizi
    $successes = array();

    require_once 'db.php';
    $name = $_POST['form_name'];
    $email = $_POST['form_email'];
    $gender = $_POST['form_gender'];
    $password = $_POST['form_password'];
/*  Şifrele hashleme */
    $password = password_hash($password, PASSWORD_DEFAULT);

    /*  resim yükleme */
    $img_name = $_FILES['form_image']['name'];
    $img_size = $_FILES['form_image']['size'];
    $tmp_name = $_FILES['form_image']['tmp_name'];
    $error = $_FILES['form_image']['error'];

    //?Kullanıcı var mı yok mu kontrol etme
    $sql = "SELECT * FROM admins WHERE email = :form_email";
    $SORGU = $DB->prepare($sql);
    $SORGU->bindParam(':form_email', $email);
    $SORGU->execute();
    $isUser = $SORGU->fetch(PDO::FETCH_ASSOC);
    /*  echo '<pre>';
    print_r($isUser);
    die(); */
    //!Eğer kullanıc üye olmuşsa  hata ver
    if ($isUser) {
        $errors[] = "This email is already registered";

        //!Eğer kullanıcı yoksa kaydet
    } else if ($error === 0) {
        //!imgsize bak sonra
        if ($img_size > 5242880) {
            $errors[] = "Sorry, your file is too large.";
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            //! Resim türü kontrolü
            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'Admin Img/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                // Insert into Database
                $sql = "INSERT INTO admins (username,email,userpassword,gender,userimg) VALUES (:form_name,:form_email,'$password',:form_gender,'$new_img_name')";
                $SORGU = $DB->prepare($sql);
                $SORGU->bindParam(':form_name', $name);
                $SORGU->bindParam(':form_email', $email);
                $SORGU->bindParam(':form_gender', $gender);

                $SORGU->execute();
                $successes[] = "Admin Registered Successfully";
            } else {
                $errors[] = "You can't upload files of this type";
            }
        }
    } else {
        /*     $errors[] = "unknown error occurred!"; */
        $errors[] = "Image Not Selected";
    }

}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  </head>
  <body>
  <?php require 'navbar.php';?>
    <div class="container">
  <div class="row justify-content-center mt-3">
  <div class="col-6">
  <!--   İşlemden sonra login sayfasına yönlendirme -->
<form method="POST"enctype="multipart/form-data">
<h1 class="text-center text-danger">Admin Register</h1>
<?php
//! Hata mesajlarını göster
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo '
    <div class="container">
<div class="auto-close alert mt-3 text-center alert-danger alert-dismissible fade show" role="alert">
' . $error . '
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>
';
    }
}if (!empty($successes)) {
    foreach ($successes as $successe) {
        echo '
  <div class="container">
<div class="auto-close alert mt-3 text-center alert-success alert-dismissible fade show" role="alert">
' . $successe . '
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>
';
    }
}
?>
<div class="form-floating mb-3">
  <input type="text" name="form_name" class="form-control"required>
  <label>Name</label>
</div>
  <div class="form-floating mb-3">
  <input type="email" name="form_email" class="form-control"required>
  <label>Email</label>
</div>
<div class="input-group mb-3  input-group-lg">
  <input type="password"  name="form_password" class="form-control" id="password" placeholder="Password"required>
  <span class="input-group-text bg-transparent"><i id="togglePassword" class="bi bi-eye-slash"></i></span>
</div>
<div class="row">
  <div class="col-6">
  <input type='file' name='form_image'>
  </div>
  <div class="col-6">
 <!--  form-check-inline yan yana gözüküyor radio butonlar -->
  <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="form_gender" value="M" required >
  <label class="form-check-label" >
  Male
  </label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="form_gender" value="F" required>
  <label class="form-check-label" >
  Female
  </label>
</div>
  </div>
</div>
<div class="row justify-content-center  mt-3">
  <div class="d-grid col-3 ">


                  <button type="submit" name="submit" class="btn btn-primary mt-1">Register</button>
                  </div>
                  </div>
     </form>
     </div>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./public/js/hideShow.js"></script>
    <script src="./public/js/autoCloseAlert.js"></script>
  </body>
</html>
