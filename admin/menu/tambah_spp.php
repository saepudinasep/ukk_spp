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
        <h3>Tambah SPP</h3>
        <div class="col-md-8">
            <form method="post">
                <div class="form-group">
                    <label>Tahun</label>
                    <input name="tahun" type="number" class="form-control" placeholder="Tahun SPP">
                </div>
                
                <div class="form-group">
                    <label>Nominal</label>
                    <input name="nominal" type="number" class="form-control" placeholder="Nominal SPP">
                </div>
                
                <div class="form-group">
                    <input name="fsimpan" type="submit" class="btn btn-sm btn-success" value="Simpan">
                    <a href="?menu=data_spp" class="btn btn-sm btn-danger">Kembali</a>
                </div>
            </form>
            <!-- Fungsi Simpan -->
            <?php
                if(isset($_POST['fsimpan'])){
                    $tahun = $_POST['tahun'];
                    $nominal = $_POST['nominal'];

                    $q = "INSERT INTO tb_spp(tahun, nominal) VALUES('$tahun', '$nominal')";
                    mysqli_query($koneksi, $q);
                    ?>
                        <script type="text/javascript">
                            alert(' Berhasil Menambah SPP !');
                            document.location.href="?menu=data_spp";
                        </script>
                    <?php
                    
                }
            ?>
        </div>
    </div>
</body>
</html>