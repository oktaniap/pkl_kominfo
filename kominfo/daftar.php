<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <title>Pendaftaran Magang Kominfo</title>
  </head>
  <body>

  <!-- Jumbotron -->
      <div class="jumbotron jumbotron-fluid text-center">
        <div class="container">
        </div>
      </div>
  <!-- Akhir Jumbotron -->

  <!-- Navbar -->
      <nav class="navbar navbar-expand-lg  bg-dark">
        <div class="container">
        <a class="navbar-brand text-white" href="index.html"><strong>KOMINFO</strong> JATIM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link mr-4" href="index.html">HOME</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="#">ALUR</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="">PROFIL</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="login.html">LOGIN</a>
            </li>
          </ul>
        </div>
       </div> 
      </nav>
  <!-- Akhir Navbar -->

  <!-- Menu -->    
      <?php
      $nama_depan="";
      $eror_nama_depan="";
      $nama_belakang="";
      $eror_nama_belakang="";
      $username="";
      $eror_username="";
      $password="";
      $eror_password="";

      if ($_SERVER ["REQUEST_METHOD"] == "POST"){
        if (empty($_POST["nama_depan"])) {
          $eror_nama_depan = "Nama Depan tidak boleh kosong";
        }else{
          if (!preg_match("/^[a-zA-Z ]*$/", cek_input($_POST["nama_depan"]))){
            $eror_nama_depan = "Nama Depan hanya boleh huruf dan spasi!";
          }else{
            $nama_depan=cek_input($_POST["nama_depan"]);
          }
        }

        if (empty($_POST["nama_belakang"])) {
          $eror_nama_belakang = "Nama Belakang tidak boleh kosong";
        }else{
          if (!preg_match("/^[a-zA-Z ]*$/", cek_input($_POST["nama_belakang"]))){
            $eror_nama_belakang = "Nama Belakang hanya boleh huruf dan spasi!";
          }else{
            $nama_belakang=cek_input($_POST["nama_belakang"]);
          }
        }

        if (empty($_POST["username"])) {
          $eror_username = "Username tidak boleh kosong";
        }else{
          if (!preg_match("/^[a-zA-Z0-9]*$/", cek_input ($_POST["username"]))){
            $eror_username = "Username hanya boleh huruf dan angka!";
          }else{
            $username=cek_input($_POST["username"]);
          }
        }

        if (empty($_POST["password"])) {
          $eror_password = "Password tidak boleh kosong";
        }else{
          if (!preg_match("/^[a-zA-Z0-9]*$/", cek_input ($_POST["password"]))){
            $eror_password = "password hanya boleh huruf dan angka!";
          }else{
            $password=cek_input($_POST["password"]);
          }
        }
      }

      if (!empty($nama_depan)&&!empty($nama_belakang)&&!empty($password)&&!empty($username)) {
        include "koneksi.php";
        $akses='user';
        $sql = "INSERT INTO `pengguna`(`nama_depan`, `nama_belakang`, `username`, `password`, `akses`) VALUES ('$nama_depan', '$nama_belakang', '$username','$password', '$akses');";
        if (mysqli_query($conn, $sql)) {
          echo "<script> 
                  alert('Pendaftaran berhasil!');
                  document.location.href = 'login.html';
                </script>";
        }else{
          echo "<script> 
                  alert('Pendaftaran Gagal');
                  document.location.href = 'daftar.html';
                </script>";
        }
        mysqli_close($conn);
      }

      function cek_input($data){  
        $data = trim ($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
      ?>
      <div class="container" style="border: 10px solid  #DCDCDC; margin-top: 5%; border-radius: 10px;padding-top: 3%;">
        <h2 style="text-align: center; font-weight: bold; margin-bottom: 7%;">DAFTAR AKUN</h2>
        <div class="card-body">
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group row" style="padding-left: 10%; padding-bottom: 1%;">
              <div class="col-md-3" style="font-weight: bold; font-size: 20px;">Nama Depan</div>
              <input type="text" name="nama_depan" class="form-control <?php echo($eror_nama_depan !="" ? "is-invalid" : ""); ?>" style="border-radius: 4px; width: 60%;" value="<?php echo $nama_depan; ?>">
              <span class="warning" style="font-weight: 10px; color: red; padding-left: 25%;"><?php echo $eror_nama_depan;?></span>
            </div>
            <div class="form-group row" style="padding-left: 10%; padding-bottom: 1%;">
              <div class="col-md-3" style="font-weight: bold; font-size: 20px;">Nama Belakang</div>
              <input type="text" name="nama_belakang" class="form-control <?php echo($eror_nama_belakang !="" ? "is-invalid" : ""); ?>" style="border-radius: 4px; width: 60%;" value="<?php echo $nama_belakang; ?>">
              <span class="warning" style="font-weight: 10px; color: red; padding-left: 25%;"><?php echo $eror_nama_belakang;?></span>
            </div>
            <div class="form-group row" style="padding-left: 10%; padding-bottom: 1%;">
              <div class="col-md-3" style="font-weight: bold; font-size: 20px;">Username</div>
              <input type="text" name="username" class="form-control <?php echo($eror_username !="" ? "is-invalid" : ""); ?>" style="border-radius: 4px; width: 60%;" value="<?php echo $username; ?>">
              <span class="warning" style="font-weight: 10px; color: red; padding-left: 25%;"><?php echo $eror_username;?></span>
            </div>
            <div class="form-group row" style="padding-left: 10%; padding-bottom: 1%;">
              <div class="col-md-3" style="font-weight: bold; font-size: 20px;">Password</div>
              <input type="password" name="password" class="form-control <?php echo($eror_password !="" ? "is-invalid" : ""); ?>" style="border-radius: 4px; width: 60%;" value="<?php echo $password; ?>">
              <span class="warning" style="font-weight: 10px; color: red; padding-left: 25%;"><?php echo $eror_password;?></span>
            </div>
            <center><button type="submit" class="btn" style="background-color: #808080; margin-bottom: 2%">DAFTAR</button></center>
          </form>
        </div>
      </div>
  <!-- Akhir Menu -->

  <!-- Awal Footer -->
      <hr class="footer">
      <div class="container">
        <div class="row footer-body">
          <div class="col-md-6">
          <div class="copyright">
            <strong>Copyright</strong> <i class="far fa-copyright"></i>2020 -  UPNVJT / KOMINFO</p>
          </div>
          </div>
        </div>
      </div>
  <!-- Akhir Footer -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
  </body>
</html>