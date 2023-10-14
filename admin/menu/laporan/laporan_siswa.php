<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <h3>Laporan Data Siswa</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>NISN</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. Hp</th>
            </tr>
        </thead>
        <tbody>
        <?php
            //paging
            $batas = 10;
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
            </tr>
            <?php
                    }
                }
            ?>
        </tbody>
    </table>
    <a href="" class="btn btn-info" onclick="window.print();">Print</a>
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