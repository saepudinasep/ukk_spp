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
        $id = $_GET['id_kelas'];
        $query = mysqli_query($koneksi, "SELECT * FROM tb_kelas WHERE id_kelas='$id'");
        $kelas = mysqli_fetch_array($query);
    ?>
    <div class="row">
        <h3>Tambah Siswa Kelas <?php echo $kelas['nama_kelas'], " ", $kelas['kompetensi_keahlian']; ?></h3>
        <div class="col-md-8">
            <form method="post">
                <div class="form-group">
                    <label>NISN</label>
                    <input name="nisn" type="number" class="form-control" placeholder="NISN Siswa">
                </div>
                
                <div class="form-group">
                    <label>NIS</label>
                    <input name="nis" type="number" class="form-control" placeholder="NIS Siswa">
                </div>
                
                <div class="form-group">
                    <label>Nama</label>
                    <input name="nama" type="text" class="form-control" placeholder="Nama Siswa">
                </div>
                
                <div class="form-group">
                    <label>Kelas</label>
                    <select name="id_kelas" class="form-control" readonly>
                        <option value="<?php echo $id; ?>">
                        <?php echo $kelas['nama_kelas'], " ", $kelas['kompetensi_keahlian']; ?>
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label>No Telepon</label>
                    <input name="nohp" type="number" class="form-control" placeholder="No Telepon Siswa">
                </div>
                
                <div class="form-group">
                <label>Alamat</label>
                    <textarea name="alamat" class="form-control" placeholder="Alamat Siswa"></textarea>
                </div>
                
                <div class="form-group">
                    <label>Pilih SPP</label>
                    <select name="id_spp" class="form-control">
                        <?php
                            $qspp = mysqli_query($koneksi, "SELECT * FROM tb_spp");
                            while($dspp = mysqli_fetch_array($qspp)){
                        ?>
                        <option value="<?php echo $dspp['id_spp']; ?>">
                        <?php echo $dspp['tahun'], "/", $dspp['nominal']; ?>
                        </option>
                            <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <input name="fsimpan" type="submit" class="btn btn-sm btn-success" value="Simpan">
                    <a href="?menu=view_siswa&id_kelas=<?php echo $id; ?>" class="btn btn-sm btn-danger">Kembali</a>
                </div>
            </form>
            <!-- Fungsi Simpan -->
            <?php
                if(isset($_POST['fsimpan'])){
                    $nisn = $_POST['nisn'];
                    $nis = $_POST['nis'];
                    $nama = $_POST['nama'];
                    $id_kelas = $_POST['id_kelas'];
                    $nohp = $_POST['nohp'];
                    $alamat = $_POST['alamat'];
                    $id_spp = $_POST['id_spp'];
                    $ket = "BELUM BAYAR";
// nyambil nominal / jumlah bayar spp
                    $nspp = mysqli_query($koneksi, "SELECT * FROM tb_spp WHERE id_spp='$id_spp'");
                    $nominal = mysqli_fetch_array($nspp);
// insert siswa
                    $q = "INSERT INTO tb_siswa(nisn, nis, nama, id_kelas, alamat, no_hp, id_spp)
                     VALUES('$nisn', '$nis', '$nama', '$id_kelas', '$alamat', '$nohp', '$id_spp')";
                    mysqli_query($koneksi, $q);

                    $bulanIndo = array(
                        '01' => 'Januari',
                        '02' => 'Februari',
                        '03' => 'Maret',
                        '04' => 'April',
                        '05' => 'Mei',
                        '06' => 'Juni',
                        '07' => 'Juli',
                        '08' => 'Agustus',
                        '09' => 'September',
                        '10' => 'Oktober',
                        '11' => 'November',
                        '12' => 'Desember'
                    );
                    for ($i=0; $i < 12 ; $i++) { 
                        //membuat tanggal jatuh tempo dengan bulan Indo
                        $jatuhtempo = date("Y-m-d", strtotime("+$i month", strtotime(date('Y-m-d'))));

                        $bulan = $bulanIndo[date('m', strtotime($jatuhtempo))]." ".date('Y',strtotime($jatuhtempo));
                        //membuat tanggal jatuh tempo nya setiap tanggal 10
                        $date = mktime(0,0,0,date('m')+$i,date('10'),date('Y'));
                        $date = date('Y-m-d', $date);
// insert pembayaran
                        $qpembayaran = "INSERT INTO tb_pembayaran(nisn, bulan, jatuh_tempo, id_spp, jumlah_bayar, ket)
                        VALUES('$nisn', '$bulan', '$date', '$id_spp', '$nominal[nominal]', '$ket')";
                        mysqli_query($koneksi, $qpembayaran);
                    }
                    ?>
                        <script type="text/javascript">
                            alert(' Berhasil Menambah Siswa !');
                            document.location.href="?menu=view_siswa&id_kelas=<?php echo $id; ?>";
                        </script>
                    <?php
                    
                }
            ?>
        </div>
    </div>
</body>
</html>