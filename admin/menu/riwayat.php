<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
    <title>Document</title>
</head>
<body>
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <h3>Riwayat Pembayaran</h3>
            <?php
                $qjumlah = mysqli_query($koneksi, "SELECT tb_pembayaran.*, tb_siswa.*, tb_petugas.*
                                                    FROM tb_pembayaran
                                                    INNER JOIN tb_siswa ON tb_siswa.nisn=tb_pembayaran.nisn
                                                    INNER JOIN tb_petugas ON tb_petugas.id_petugas=tb_pembayaran.id_petugas
                                                    WHERE tb_pembayaran.tgl_bayar!=''");
                $jumlah = mysqli_num_rows($qjumlah);
            ?>
            <button class="btn btn-sm btn-default">Jumlah Data <span class="badge"><?php echo $jumlah; ?></span></button>
            <a href="?menu=riwayat" class="btn btn-sm btn-primary">Refresh</a>
        </div>
        <div class="col-xs-6 col-md-4">
            <form method="post">
                <div class="input-group">
                    <input name="inputan" type="text" class="form-control" placeholder="Cari Pembayaran">
                    <span class="input-group-btn">
                        <input name="cari" class="btn btn-default" value="Cari" type="submit">
                    </span>
                </div><!-- /input-group -->
            </form>
        </div>
    </div>
    <br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Bulan</th>
                <th>Tgl Bayar</th>
                <th>Jumlah</th>
                <th>Petugas</th>
            </tr>
        </thead>
        <tbody>
        <?php
            //paging
            $batas = 5;
            $hal = ceil($jumlah / $batas);
            $page = (isset($_GET['hal'])) ? $_GET['hal']:1;
            $posisi = ($page - 1) * $batas;
            //end paging
            $no = 1+$posisi;
            $inputan = $_POST['inputan'];
            if($_POST['cari']){
                if($inputan==""){
                    $q = mysqli_query($koneksi, "SELECT tb_pembayaran.*, tb_siswa.*, tb_petugas.*
                    FROM tb_pembayaran
                    INNER JOIN tb_siswa ON tb_siswa.nisn=tb_pembayaran.nisn
                    INNER JOIN tb_petugas ON tb_petugas.id_petugas=tb_pembayaran.id_petugas
                    WHERE tb_pembayaran.tgl_bayar!='' ORDER BY tb_pembayaran.tgl_bayar DESC limit $posisi, $batas");
                }
                else if($inputan!==""){
                    $q = mysqli_query($koneksi, "SELECT tb_pembayaran.*, tb_siswa.*, tb_petugas.*
                    FROM tb_pembayaran
                    INNER JOIN tb_siswa ON tb_siswa.nisn=tb_pembayaran.nisn
                    INNER JOIN tb_petugas ON tb_petugas.id_petugas=tb_pembayaran.id_petugas
                    WHERE tb_pembayaran.tgl_bayar!='' ORDER BY tb_pembayaran.tgl_bayar DESC AND nama LIKE '%$inputan%' limit $posisi, $batas");
                }
            }
            else{
                $q = mysqli_query($koneksi, "SELECT tb_pembayaran.*, tb_siswa.*, tb_petugas.*
                FROM tb_pembayaran
                INNER JOIN tb_siswa ON tb_siswa.nisn=tb_pembayaran.nisn
                INNER JOIN tb_petugas ON tb_petugas.id_petugas=tb_pembayaran.id_petugas
                WHERE tb_pembayaran.tgl_bayar!='' ORDER BY tb_pembayaran.tgl_bayar DESC limit $posisi, $batas");
            }
                $cek = mysqli_num_rows($q);

                if($cek < 1){
                    ?>
                    <tr>
                        <td colspan="7">
                            <center>
                                Data tidak tersedia !
                                <a href="" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-refresh"></span></a>
                            </center>
                        </td>
                    </tr>
                    <?php
                }
                else{
                    
            while($data = mysqli_fetch_array($q)){
                // $id_kelas = $data['id_kelas'];
                $qkelas = mysqli_query($koneksi, "SELECT * FROM tb_kelas WHERE id_kelas='$data[id_kelas]'");
                $kelas = mysqli_fetch_array($qkelas);
            
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nisn']; ?></td>
                <td><?php echo $data['nama']; ?></td>
                <td><?php echo $kelas['nama_kelas']." ".$kelas['kompetensi_keahlian']; ?></td>
                <td><?php echo $data['bulan']; ?></td>
                <td><?php echo $data['tgl_bayar']; ?></td>
                <td>Rp. <?php echo number_format($data['jumlah_bayar'], 2); ?></td>
                <td><?php echo $data['nama_petugas']; ?></td>
            </tr>
            <?php
                    }
                }
            ?>
        </tbody>
    </table>
    <nav>
        <ul class="pagination">
            <?php
                for ($i=1; $i <= $hal ; $i++) { 
                    ?>
                    <li <?php if ($page==$i) {
                        echo "class='active'";
                    } ?>><a href="?menu=riwayat&hal=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php
                }
            ?>
        </ul>
    </nav>
</body>
</html>