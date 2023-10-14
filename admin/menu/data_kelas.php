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
            <h3>Data Kelas</h3>
            <?php
                $qjumlah = mysqli_query($koneksi, "SELECT * FROM tb_kelas");
                $jumlah = mysqli_num_rows($qjumlah);
            ?>
            <a class="btn btn-sm btn-success" href="?menu=tambah_kelas">Tambah Data</a>
            <button class="btn btn-sm btn-default">Jumlah Data <span class="badge"><?php echo $jumlah; ?></span></button>
            <a href="?menu=data_pegawai" class="btn btn-sm btn-primary">Refresh</a>
        </div>
        <div class="col-xs-6 col-md-4">
            <form method="post">
                <div class="input-group">
                    <input name="inputan" type="text" class="form-control" placeholder="Cari Pegawai">
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
                <th>Kelas</th>
                <th>Kompetensi Keahlian</th>
                <th>Opsi</th>
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
                    $q = mysqli_query($koneksi, "SELECT * FROM tb_kelas limit $posisi, $batas");
                }
                else if($inputan!==""){
                    $q = mysqli_query($koneksi, "SELECT * FROM tb_kelas WHERE nama_kelas LIKE '%$inputan%' limit $posisi, $batas");
                }
            }
            else{
                $q = mysqli_query($koneksi, "SELECT * FROM tb_kelas limit $posisi, $batas");
            }
                $cek = mysqli_num_rows($q);

                if($cek < 1){
                    ?>
                    <tr>
                        <td colspan="4">
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
                
            
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nama_kelas']; ?></td>
                <td><?php echo $data['kompetensi_keahlian']; ?></td>
                <td>
                    <a onclick="return confirm('Anda yakin akan menghapusnya ?')" title="Hapus" href="?menu=hapus_kelas&id_kelas=<?php echo $data['id_kelas']; ?>"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                    |
                    <a title="Edit" href="?menu=edit_kelas&id_kelas=<?php echo $data['id_kelas']; ?>"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                </td>
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
                    } ?>><a href="?menu=data_kelas&hal=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php
                }
            ?>
        </ul>
    </nav>
</body>
</html>