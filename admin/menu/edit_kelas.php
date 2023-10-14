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
        $data = mysqli_fetch_array($query);
    ?>
    <div class="row">
        <h3>Edit Data SPP</h3>
        <div class="col-md-8">
            <form method="post">
                <div class="form-group">
                    <label>Kelas</label>
                    <input name="kelas" type="number" class="form-control" value="<?php echo $data['nama_kelas']; ?>">
                </div>
                
                <div class="form-group">
                    <label>Kompetensi Keahlian</label>
                    <input name="keahlian" type="text" class="form-control" value="<?php echo $data['kompetensi_keahlian']; ?>">
                </div>
                
                <div class="form-group">
                    <input name="fsimpan" type="submit" class="btn btn-sm btn-success" value="Simpan">
                    <a href="?menu=data_kelas" class="btn btn-sm btn-danger">Kembali</a>
                </div>
            </form>
            <!-- Fungsi -->
            <?php
                if(isset($_POST['fsimpan'])){
                    $kelas = $_POST['kelas'];
                    $keahlian = $_POST['keahlian'];

                    $q = "UPDATE tb_kelas SET nama_kelas='$kelas', kompetensi_keahlian='$keahlian' WHERE id_kelas='$id'";
                    mysqli_query($koneksi, $q);
                    ?>
                        <script type="text/javascript">
                            alert(' Berhasil Merubah Data Kelas !');
                            document.location.href="?menu=data_kelas";
                        </script>
                    <?php
                    
                }
            ?>
        </div>
    </div>
</body>
</html>