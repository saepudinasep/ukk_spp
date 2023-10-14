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
        <h3>Tambah Kelas</h3>
        <div class="col-md-8">
            <form method="post">
                <div class="form-group">
                    <label>Kelas</label>
                    <input name="kelas" type="number" class="form-control" placeholder="Nama Kelas">
                </div>
                
                <div class="form-group">
                    <label>Kompetensi Keahlian</label>
                    <input name="keahlian" type="text" class="form-control" placeholder="Kompetensi Keahlian">
                </div>
                
                <div class="form-group">
                    <input name="fsimpan" type="submit" class="btn btn-sm btn-success" value="Simpan">
                    <a href="?menu=data_kelas" class="btn btn-sm btn-danger">Kembali</a>
                </div>
            </form>
            <!-- Fungsi Simpan -->
            <?php
                if(isset($_POST['fsimpan'])){
                    $kelas = $_POST['kelas'];
                    $keahlian = $_POST['keahlian'];

                    $q = "INSERT INTO tb_kelas(nama_kelas, kompetensi_keahlian) VALUES('$kelas', '$keahlian')";
                    mysqli_query($koneksi, $q);
                    ?>
                        <script type="text/javascript">
                            alert(' Berhasil Menambah Kelas !');
                            document.location.href="?menu=data_kelas";
                        </script>
                    <?php
                    
                }
            ?>
        </div>
    </div>
</body>
</html>