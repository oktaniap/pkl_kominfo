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
      <nav class="navbar navbar-expand-lg  bg-dark" style="margin-top: 2%;">
        <div class="container">
        <a class="navbar-brand text-white" href="#" style="font-size: 27px;"><?php session_start(); echo $_SESSION['nama_belakang']; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link mr-4" href="index.php">HOME</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="bimbingan.php">BIMBINGAN</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="magang.php">MAGANG</a>
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
      <div style="padding-top: 5%; font-size: 50px;">
        <center>
          <button class="btn" style="background-color: #A9A9A9; font-weight: bold;" onclick="window.location.href='bimbingan.php'">
            Bimbingan
          </button>
          |
          <button class="btn" style="background-color: #A9A9A9; font-weight: bold; width: 13%;" onclick="window.location.href='penilaian.php'">
            Penilaian
          </button>
        </center>
      </div>
      <div class="container" style="width: 60%;border: 10px solid #DCDCDC; margin-top: 2%; border-radius: 10px;font-size: 17px; padding-top: 2%; padding-left: 2%; padding-bottom: 1%;">
        <table>
          <?php
          include "../koneksi.php";
          $bidang = $_SESSION['username'];
          $sql="SELECT id_magang FROM magang WHERE bidang='$bidang' AND status=2";
          $query=mysqli_query($conn,$sql);
          $cek=mysqli_num_rows($query);
          if ($cek==0) {
            echo "";
          }else{
            $no=1;
            while ($row=mysqli_fetch_array($query)) {
              $id_magang=$row['id_magang'];
              $sql1="SELECT * FROM bimbingan WHERE id_magang='$id_magang' AND status=1";
              $query1=mysqli_query($conn,$sql1);
              $cek1=mysqli_num_rows($query1);
              if ($cek1==0) {
                echo "";
              }
              else{
                ?>
                  <table>
                    <tr>
                      <td>No</td>
                      <td>Institusi</td>
                      <td>Tanggal</td>
                      <td>Materi</td>
                      <td>Persetujuan</td>
                    </tr>
                  </table>
                  <?php
                while ($row1=mysqli_fetch_array($query1)) {
                  echo "<tr><td>".$no++."</td><td>";
                  $sql2="SELECT institusi FROM magang WHERE bidang='$bidang' AND status=2 AND id_magang='$id_magang'";
                  $query2=mysqli_query($conn,$sql2);
                  while ($row2=mysqli_fetch_array($query2)) {
                    echo $row2['institusi']."</td><td>";
                  }
                  echo date('d F Y', strtotime($row1['tanggal']))."</td><td>";
                  echo $row1['materi']."</td>";
                  ?>
                  <td><button class="btn btn-primary" style="font-weight: bold;" onclick="window.location.href='view_bimbingan.php?id_bimbingan=<?php echo $row1['id_bimbingan'];?>'">More</button></td></tr>
                  <?php
                }
              }
            }
          }
          ?>
        </table>
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