<?php
include "../inc/koneksi.php";
session_start();
if ($_SESSION['userweb'] == "") {
  header('location:../index.php');
}
if ($_SESSION['status'] == "petugas") {
  header('location:../petugas/index.php');
}
$qprofil = mysqli_query($koneksi, "SELECT * FROM tb_petugas WHERE id_petugas='$_SESSION[userweb]'");
$profil = mysqli_fetch_array($qprofil);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">

  <title>Pembayaran SPP - ADMIN</title>

  <!-- Bootstrap core CSS -->
  <link href="../dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../css/admin.css" rel="stylesheet">

  <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
  <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  <script src="../assets/js/ie-emulation-modes-warning.js"></script>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">ADMIN - Pembayaran SPP (<?php echo $profil['nama_petugas']; ?>)</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index.php">Dashboard</a></li>
          <li><a href="?menu=profile">Profile</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3 col-md-2 sidebar">
        <?php
        @$menu = $_GET['menu'];
        ?>
        <ul class="nav nav-sidebar">
          <li <?php if ($menu == "") {
                echo "class='active'";
              } ?>><a href="index.php"> Dashboard <span class="sr-only">(current)</span></a></li>
          <li <?php if ($menu == "data_siswa" || $menu == "tambah_siswa" || $menu == "edit_siswa" || $menu == "hapus_siswa" || $menu == "view_siswa") {
                echo "class='active'";
              } ?>><a href="?menu=data_siswa">Data Siswa</a></li>
          <li <?php if ($menu == "data_petugas" || $menu == "tambah_petugas" || $menu == "edit_petugas" || $menu == "hapus_petugas") {
                echo "class='active'";
              } ?>><a href="?menu=data_petugas">Data Petugas</a></li>
          <li <?php if ($menu == "data_kelas" || $menu == "tambah_kelas" || $menu == "edit_kelas" || $menu == "hapus_kelas") {
                echo "class='active'";
              } ?>><a href="?menu=data_kelas">Data Kelas</a></li>
          <li <?php if ($menu == "data_spp" || $menu == "tambah_spp" || $menu == "edit_spp" || $menu == "hapus_spp") {
                echo "class='active'";
              } ?>><a href="?menu=data_spp">Data SPP</a></li>
          <li <?php if ($menu == "transaksi") {
                echo "class='active'";
              } ?>><a href="?menu=transaksi">Transaksi</a></li>
          <li <?php if ($menu == "riwayat") {
                echo "class='active'";
              } ?>><a href="?menu=riwayat">Riwayat Pembayaran</a></li>
          <li <?php if ($menu == "laporan") {
                echo "class='active'";
              } ?>><a href="?menu=laporan">Generate Laporan</a></li>


        </ul>
        <ul class="nav nav-sidebar">
          <li class="active"><a onclick="return confirm('Anda akan keluar ?')" href="../inc/keluar.php">
              <span class="glyphicon glyphicon-log-out"></span>
              Keluar <span class="sr-only">(current)</span></a></li>
        </ul>
      </div>
      <!-- ini content -->
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <?php
        error_reporting(0);
        switch ($_GET['menu']) {
          case 'data_spp':
            include "menu/data_spp.php";
            break;

          case 'hapus_spp':
            $id = $_GET['id_spp'];
            mysqli_query($koneksi, "DELETE FROM tb_spp WHERE id_spp='$id'");
            include "menu/data_spp.php";
            break;

          case 'tambah_spp':
            include "menu/tambah_spp.php";
            break;

          case 'edit_spp':
            include "menu/edit_spp.php";
            break;

          case 'data_kelas':
            include "menu/data_kelas.php";
            break;

          case 'hapus_kelas':
            $id = $_GET['id_kelas'];
            mysqli_query($koneksi, "DELETE FROM tb_kelas WHERE id_kelas='$id'");
            include "menu/data_kelas.php";
            break;

          case 'tambah_kelas':
            include "menu/tambah_kelas.php";
            break;

          case 'edit_kelas':
            include "menu/edit_kelas.php";
            break;

          case 'data_petugas':
            include "menu/data_petugas.php";
            break;

          case 'tambah_petugas':
            include "menu/tambah_petugas.php";
            break;

          case 'hapus_petugas':
            $id = $_GET['id_petugas'];
            mysqli_query($koneksi, "DELETE FROM tb_petugas WHERE id_petugas='$id'");
            include "menu/data_petugas.php";
            break;

          case 'edit_petugas':
            include "menu/edit_petugas.php";
            break;

          case 'data_siswa':
            include "menu/data_siswa.php";
            break;

          case 'view_siswa':
            include "menu/view_siswa.php";
            break;

          case 'tambah_siswa':
            include "menu/tambah_siswa.php";
            break;

          case 'hapus_siswa':
            $id = $_GET['nisn'];
            mysqli_query($koneksi, "DELETE FROM tb_siswa WHERE nisn='$id'");
            include "menu/data_siswa.php";
            break;

          case 'edit_siswa':
            include "menu/edit_siswa.php";
            break;

          case 'profile':
            include "menu/profile.php";
            break;

          case 'edit_profile':
            include "menu/edit_profile.php";
            break;

          case 'transaksi':
            include "menu/transaksi.php";
            break;

          case 'bayar':
            $nisn = $_GET['nisn'];
            $bulan = $_GET['bulan'];
            $today = date("Y-m-d");
            mysqli_query($koneksi, "UPDATE tb_pembayaran SET id_petugas='$profil[id_petugas]', tgl_bayar='$today', ket='LUNAS' WHERE nisn='$nisn' AND bulan='$bulan'");
            include "menu/transaksi.php";
            break;

          case 'riwayat':
            include "menu/riwayat.php";
            break;

          case 'laporan':
            include "menu/laporan.php";
            break;

          case 'laporan_view_siswa':
            include "menu/laporan/laporan_view_siswa.php";
            break;

          case 'laporan_siswa':
            include "menu/laporan/laporan_siswa.php";
            break;

          default:
            include "menu/dashboard.php";
            break;
        }
        ?>
      </div>
    </div>
  </div>



  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="../dist/js/bootstrap.min.js"></script>
  <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
  <script src="../assets/js/vendor/holder.min.js"></script>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>

</html>