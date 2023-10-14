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
                $qjumlah = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE id_kelas='$id'");
                $jumlah = mysqli_num_rows($qjumlah);

                $qkelas = mysqli_query($koneksi, "SELECT * FROM tb_kelas WHERE id_kelas='$id'");
                $dkelas = mysqli_fetch_array($qkelas);
            ?>
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <h3>Data Kelas <?php echo $dkelas['nama_kelas'], " ", $dkelas['kompetensi_keahlian']; ?></h3>
            <a class="btn btn-sm btn-success" href="?menu=tambah_siswa&id_kelas=<?php echo $dkelas['id_kelas']; ?>">Tambah Data</a>
            <button class="btn btn-sm btn-default">Jumlah Data <span class="badge"><?php echo $jumlah; ?></span></button>
            <a href="?menu=view_siswa&id_kelas=<?php echo $id; ?>" class="btn btn-sm btn-primary">Refresh</a>
        </div>
        <div class="col-xs-6 col-md-4">
            <form method="post">
                <div class="input-group">
                    <input name="inputan" type="text" class="form-control" placeholder="Cari Siswa">
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
                <th>NISN</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. Hp</th>
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
                    $q = mysqli_query($koneksi, "SELECT * FROM  tb_siswa WHERE id_kelas='$id' limit $posisi, $batas");
                }
                else if($inputan!==""){
                    $q = mysqli_query($koneksi, "SELECT * FROM  tb_siswa WHERE id_kelas='$id' AND nama LIKE '%$inputan%' limit $posisi, $batas");
                }
            }
            else{
                $q = mysqli_query($koneksi, "SELECT * FROM  tb_siswa WHERE id_kelas='$id' limit $posisi, $batas");
            }
                $cek = mysqli_num_rows($q);

                if($cek < 1){
                    ?>
                    <tr>
                        <td colspan="7">
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
                <td><?php echo $data['nisn']; ?></td>
                <td><?php echo $data['nis']; ?></td>
                <td><?php echo $data['nama']; ?></td>
                <td><?php echo $data['alamat']; ?></td>
                <td><?php echo $data['no_hp']; ?></td>
                <td>
                    <a onclick="return confirm('Anda akan menghapusnya ?')" title="Hapus" href="?menu=hapus_siswa&nisn=<?php echo $data['nisn']; ?>"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                    |
                    <a title="Edit" href="?menu=edit_siswa&nisn=<?php echo $data['nisn']; ?>"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
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
                    } ?>><a href="?menu=view_siswa&id_kelas=<?php echo $id; ?>&hal=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php
                }
            ?>
        </ul>
    </nav>
</body>
</html>