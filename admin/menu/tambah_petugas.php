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
        <h3>Tambah Pegawai</h3>
        <div class="col-md-8">
            <form method="post">
                <div class="form-group">
                    <label>Nama</label>
                    <input name="nama" type="text" class="form-control" placeholder="Nama Petugas">
                </div>
                
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" placeholder="Alamat Petugas"></textarea>
                </div>
                
                <div class="form-group">
                    <label>Telepon</label>
                    <input name="telp" type="text" class="form-control" placeholder="Nomor Telepon">
                </div>
                
                <div class="form-group">
                    <label>User Untuk Petugas</label>
                    <input name="user" type="text" class="form-control" placeholder="Username">
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input name="pass" type="password" class="form-control" placeholder="Password">
                </div>

                <div class="form-group">
                    <input name="fsimpan" type="submit" class="btn btn-sm btn-success" value="Simpan">
                    <a href="?menu=data_petugas" class="btn btn-sm btn-danger">Kembali</a>
                </div>
            </form>
            <!-- Fungsi Simpan -->
            <?php
                if(isset($_POST['fsimpan'])){
                    $nama = $_POST['nama'];
                    $alamat = $_POST['alamat'];
                    $telp = $_POST['telp'];
                    $user = $_POST['user'];
                    $pass = $_POST['pass'];
                    $akses = "petugas";

                    $q = "INSERT INTO tb_petugas(nama_petugas, alamat, telepon, username, password, level)
                     VALUES('$nama', '$alamat', '$telp', '$user', md5('$pass'), '$akses')";
                    mysqli_query($koneksi, $q);
                    ?>
                        <script type="text/javascript">
                            alert(' Berhasil Menambah Petugas !');
                            document.location.href="?menu=data_petugas";
                        </script>
                    <?php
                    
                }
            ?>
        </div>
    </div>
</body>
</html>