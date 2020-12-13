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

  <!-- Navbar -->
      <nav class="navbar navbar-expand-lg  bg-dark">
        <div class="container">
        <a class="navbar-brand text-white" href="#">Hai, <strong><?php session_start(); echo $_SESSION['nama_depan']; ?></strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link mr-4" href="index.php">HOME</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="daftar.php">DAFTAR MAGANG</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="kegiatan.php">KEGIATAN</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="logout.php">LOGOUT</a>
            </li>
          </ul>
        </div>
       </div> 
      </nav>
  <!-- Akhir Navbar -->

  <!-- Menu -->
      <?php
      $tanggal="";
      $eror_tanggal="";
      $materi="";
      $eror_materi="";

      if ($_SERVER ["REQUEST_METHOD"] == "POST"){
        if (empty($_POST["tanggal"])) {
          $eror_tanggal = "Tanggal harus diisi";
        }else{
          $tanggal=cek_input($_POST["tanggal"]);
        }

        if (empty($_POST["materi"])) {
          $eror_materi = "Materi bimbingan harus diisi";
        }else{
          $materi=cek_input($_POST["materi"]);
        }
      }

      if (!empty($tanggal)&&!empty($materi)) {
        include "../koneksi.php";
        $id_magang = $_POST['id_magang'];
        $sql = "INSERT INTO `bimbingan` (`id_magang`, `tanggal`, `materi`, `status`) VALUES ('$id_magang', '$tanggal', '$materi', 1);";
        if (mysqli_query($conn, $sql)) {
          echo "<script> 
                  alert('Bimbingan berhasil ditambahkan!');
                  document.location.href = 'bimbingan.php';
                </script>";
        }else{
          echo "<script> 
                  alert('Bimbingan gagal ditambahkan');
                  document.location.href = 'bimbingan.php';
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
        <h2 style="text-align: center; font-weight: bold; margin-bottom: 7%;">FORM BIMBINGAN</h2>
        <div class="card-body">
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group row" style="padding-left: 10%; padding-bottom: 1%;">
              <div class="col-md-3" style="font-weight: bold; font-size: 20px;">Tanggal</div>
              <input type="hidden" name="id_magang" value="<?php echo $_GET['id_magang']; ?>">
              <input type="date" name="tanggal" class="form-control <?php echo($eror_tanggal !="" ? "is-invalid" : ""); ?>" style="border-radius: 4px; width: 60%;" value="<?php echo $tanggal; ?>">
              <span class="warning" style="font-weight: 10px; color: red; padding-left: 25%;"><?php echo $eror_tanggal;?></span>
            </div>
            <div class="form-group row" style="padding-left: 10%; padding-bottom: 1%;">
              <div class="col-md-3" style="font-weight: bold; font-size: 20px;">Materi Bimbingan</div>
              <input type="text" name="materi" class="form-control <?php echo($eror_materi !="" ? "is-invalid" : ""); ?>" style="border-radius: 4px; width: 60%;" value="<?php echo $materi; ?>">
              <span class="warning" style="font-weight: 10px; color: red; padding-left: 25%;"><?php echo $eror_materi;?></span>
            </div>
            <center><button type="submit" class="btn" style="background-color: #808080; margin-bottom: 2%">TAMBAH</button></center>
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