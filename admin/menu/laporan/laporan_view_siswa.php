<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
    <title>Document</title>
</head>
<body>
        <?php
            $qkelas = mysqli_query($koneksi, "SELECT * FROM tb_kelas");
            $cek = mysqli_num_rows($qkelas);
            if( $cek < 1 ){
                ?>
                <div class="col-xs-12 col-sm-6 col-md-8">Silahkan Masukan data Kelas dahulu</div>
                <?php
            }
            else {
                while ($data = mysqli_fetch_array($qkelas)) {
                
        ?>
        <div class="col-md-3">
            <div class="panel panel-info">
                <div class="panel-heading"><center><?php echo $data['nama_kelas'], " ", $data['kompetensi_keahlian']; ?></center></div>
                <div class="panel-body">
                    <center>
                        <h3>
                        <?php
                            $id_kelas = $data['id_kelas'];
                            $qsiswa = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE id_kelas='$id_kelas'");
                            $qjumlah = mysqli_num_rows($qsiswa);

                            echo $qjumlah;
                        ?><br>
                        Siswa
                        </h3>
                        <a class="btn btn-sm btn-info" href="?menu=laporan_siswa&id_kelas=<?php echo $data['id_kelas']; ?>">Cetak</a>
                    </center>
                </div>
            </div>
        </div>
        <?php }
            } ?>
</body>
</html>