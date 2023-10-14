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
        <h2>Transaksi Pembayaran SPP</h2>
        <div class="col-xs-3">
            <form method="post">
                <div class="input-group">
                    <input name="nisn" type="text" class="form-control" placeholder="Masukan NISN Siswa">
                    <span class="input-group-btn">
                        <input name="cari" class="btn btn-default" value="Cari" type="submit">
                    </span>
                </div><!-- /input-group -->
            </form>
        </div>
        <!-- membuat fungsi tampil siswa -->
        
        <?php
            $nisn = $_POST['nisn'];

            if ($_POST['cari']) {
                if ($nisn=="") {
                    ?>
                    <br><br><br>
                    <div class="row">
                        <div class="alert alert-danger">
                            <center>
                            NISN tidak cocok <br>
                    <a href="" class="btn btn-success">Refresh</a>
                            </center>
                        </div>
                    </div>
                        
                    <?php
                }elseif ($nisn!=="") {
                    $qsiswa = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE nisn='$nisn'");
                    $dsiswa = mysqli_fetch_array($qsiswa);
                    
                    $qkelas = mysqli_query($koneksi, "SELECT * FROM tb_kelas WHERE id_kelas='$dsiswa[id_kelas]'");
                    $dkelas = mysqli_fetch_array($qkelas);


                    $qtrans = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE nisn='$nisn'");
                    

                    if ($nisn==$dsiswa['nisn']) {
                        
                        ?>

<div class="col-xs-9">
            <div class="panel panel-info">
                <div class="panel-heading"><center><h4>Biodata Siswa</h4></center></div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>NISN</th>
                            <th>:</th>
                            <th><?php echo $dsiswa['nisn']; ?></th>
                        </tr>
                        <tr>
                            <th>NIS</th>
                            <th>:</th>
                            <th><?php echo $dsiswa['nis']; ?></th>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <th>:</th>
                            <th><?php echo $dsiswa['nama']; ?></th>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <th>:</th>
                            <th><?php echo $dkelas['nama_kelas']." ".$dkelas['kompetensi_keahlian']; ?></th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Bulan</th>
                <th>Jatuh Tempo</th>
                <th>Tgl Bayar</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $no = 1;
            while ($trans = mysqli_fetch_array($qtrans)) {
                
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $trans['bulan']; ?></td>
                <td><?php echo $trans['jatuh_tempo']; ?></td>
                <td><?php echo $trans['tgl_bayar']; ?></td>
                <td>Rp. <?php echo number_format($trans['jumlah_bayar'], 2); ?></td>
                <td><?php echo $trans['ket']; ?></td>
                <td>
                    <?php
                        if ($trans['tgl_bayar']=="") {
                            ?>
                            <a href="?menu=bayar&nisn=<?php echo $trans['nisn']; ?>&bulan=<?php echo $trans['bulan']; ?>" class="btn btn-success">Bayar</a>
                            
                            <?php
                        }
                        else {
                            ?>
                            <a href="" class="btn btn-info">Print</a>
                            <?php
                        }
                    ?>
                </td>
                
            </tr>
            <?php } ?>
        </tbody>
    </table>
                        
                        <?php
                    }else {
                        ?>
                        <br><br><br>
                        <div class="row">
                            <div class="alert alert-danger">
                                <center>
                                NISN tidak cocok
                                </center>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
        ?>

</body>
</html>