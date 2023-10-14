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
        $id = $_GET['nisn'];
        $query = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE nisn='$id'");
        $data = mysqli_fetch_array($query);
    ?>
    <div class="row">
        <h3>Edit Data Pegawai</h3>
        <div class="col-md-8">
            <form method="post">
                <div class="form-group">
                    <label>NISN</label>
                    <input name="nisn" type="text" class="form-control" value="<?php echo $data['nisn']; ?>" readonly>
                </div>
                
                <div class="form-group">
                    <label>NIS</label>
                    <input name="nis" type="text" class="form-control" value="<?php echo $data['nis']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Nama</label>
                    <input name="nama" type="text" class="form-control" value="<?php echo $data['nama']; ?>">
                </div>
                
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" placeholder="Alamat Siswa"><?php echo $data['alamat']; ?></textarea>
                </div>
                
                <div class="form-group">
                    <label>Telepon</label>
                    <input name="telp" type="text" class="form-control" value="<?php echo $data['no_hp']; ?>">
                </div>
                
                <div class="form-group">
                    <input name="fsimpan" type="submit" class="btn btn-sm btn-success" value="Simpan">
                    <a href="?menu=view_siswa&id_kelas=<?php echo $data['id_kelas']; ?>" class="btn btn-sm btn-danger">Kembali</a>
                </div>
            </form>
            <!-- Fungsi -->
            <?php
                if(isset($_POST['fsimpan'])){
                    $nisn = $_POST['nisn'];
                    $nis = $_POST['nis'];
                    $nama = $_POST['nama'];
                    $alamat = $_POST['alamat'];
                    $telp = $_POST['telp'];

                    $q = "UPDATE tb_siswa SET nis='$nis', nama='$nama', alamat='$alamat', no_hp='$telp' WHERE nisn='$nisn'";
                    mysqli_query($koneksi, $q);
                    ?>
                        <script type="text/javascript">
                            alert(' Berhasil Merubah Data Siswa !');
                            document.location.href="?menu=view_siswa&id_kelas=<?php echo $data['id_kelas']; ?>";
                        </script>
                    <?php
                    
                }
            ?>
        </div>
    </div>
</body>
</html>