<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
    <title>Document</title>
</head>
<body>
    <div class="list-group">
    <a href="?menu=laporan_view_siswa" class="list-group-item">
        Laporan Data Siswa
    </a>
    <a href="contoh.php"></a>
    <a href="#" class="list-group-item">Laporan Data Petugas</a>
    <a href="#" class="list-group-item">Laporan Data Kelas</a>
    <a href="#" class="list-group-item">Laporan Data SPP</a>
    </div>
    <div class="col-md-3">
        <div class="panel panel-info">
            <div class="panel-heading"><center>Laporan Data Siswa</center></div>
            <div class="panel-body">
                <center>
                    <h3>
                    67
                    </h3>
                    <a class="btn btn-sm btn-info" href="?menu=laporan_view_siswa&id_kelas=<?php echo $data['id_kelas']; ?>">Cetak</a>
                </center>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-info">
            <div class="panel-heading"><center>Laporan Data Petugas</center></div>
            <div class="panel-body">
                <center>
                    <h3>
                    67
                    </h3>
                    <a class="btn btn-sm btn-info" href="?menu=laporan_petugas">Cetak</a>
                </center>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-info">
            <div class="panel-heading"><center>Laporan Data Kelas</center></div>
            <div class="panel-body">
                <center>
                    <h3>
                    67
                    </h3>
                    <a class="btn btn-sm btn-info" href="?menu=laporan_kelas">Cetak</a>
                </center>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-info">
            <div class="panel-heading"><center>Laporan Data SPP</center></div>
            <div class="panel-body">
                <center>
                    <h3>
                    67
                    </h3>
                    <a class="btn btn-sm btn-info" href="?menu=laporan_spp">Cetak</a>
                </center>
            </div>
        </div>
    </div>
</body>
</html>