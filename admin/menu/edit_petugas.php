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
        $id = $_GET['id_petugas'];
        $query = mysqli_query($koneksi, "SELECT * FROM tb_petugas WHERE id_petugas='$id'");
        $data = mysqli_fetch_array($query);
    ?>
    <div class="row">
        <h3>Edit Data Petugas</h3>
        <div class="col-md-8">
            <form method="post">
                <div class="form-group">
                    <label>Nama</label>
                    <input name="nama" type="text" class="form-control" value="<?php echo $data['nama_petugas']; ?>">
                </div>
                
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" placeholder="Alamat Petugas"><?php echo $data['alamat']; ?></textarea>
                </div>
                
                <div class="form-group">
                    <label>Telepon</label>
                    <input name="telp" type="text" class="form-control" value="<?php echo $data['telepon']; ?>">
                </div>
                
                <div class="form-group">
                    <input name="fsimpan" type="submit" class="btn btn-sm btn-success" value="Simpan">
                    <a href="?menu=data_petugas" class="btn btn-sm btn-danger">Kembali</a>
                </div>
            </form>
            <!-- Fungsi -->
            <?php
                if(isset($_POST['fsimpan'])){
                    $nama = $_POST['nama'];
                    $alamat = $_POST['alamat'];
                    $telp = $_POST['telp'];

                    $q = "UPDATE tb_petugas SET nama_petugas='$nama', alamat='$alamat', telepon='$telp' WHERE id_petugas='$id'";
                    mysqli_query($koneksi, $q);
                    ?>
                        <script type="text/javascript">
                            alert(' Berhasil Merubah Data Petugas !');
                            document.location.href="?menu=data_petugas";
                        </script>
                    <?php
                    
                }
            ?>
        </div>
    </div>
</body>
</html>