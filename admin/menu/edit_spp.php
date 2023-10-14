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
        $id = $_GET['id_spp'];
        $query = mysqli_query($koneksi, "SELECT * FROM tb_spp WHERE id_spp='$id'");
        $data = mysqli_fetch_array($query);
    ?>
    <div class="row">
        <h3>Edit Data SPP</h3>
        <div class="col-md-8">
            <form method="post">
                <div class="form-group">
                    <label>Tahun</label>
                    <input name="tahun" type="text" class="form-control" value="<?php echo $data['tahun']; ?>">
                </div>
                
                <div class="form-group">
                    <label>Nominal</label>
                    <input name="nominal" type="text" class="form-control" value="<?php echo $data['nominal']; ?>">
                </div>
                
                <div class="form-group">
                    <input name="fsimpan" type="submit" class="btn btn-sm btn-success" value="Simpan">
                    <a href="?menu=data_spp" class="btn btn-sm btn-danger">Kembali</a>
                </div>
            </form>
            <!-- Fungsi -->
            <?php
                if(isset($_POST['fsimpan'])){
                    $tahun = $_POST['tahun'];
                    $nominal = $_POST['nominal'];

                    $q = "UPDATE tb_spp SET tahun='$tahun', nominal='$nominal' WHERE id_spp='$id'";
                    mysqli_query($koneksi, $q);
                    ?>
                        <script type="text/javascript">
                            alert(' Berhasil Merubah Data SPP !');
                            document.location.href="?menu=data_spp";
                        </script>
                    <?php
                    
                }
            ?>
        </div>
    </div>
</body>
</html>