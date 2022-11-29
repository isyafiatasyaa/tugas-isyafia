<?php 

//koneksidatabase
require 'functions.php';

$hasil = query ("SELECT * FROM tbl_siswa");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
    <title>Data Siswa</title>
</head>
<body>
    <h1>Daftar Data Siswa</h1>
    <br><br>
    <a href="tambah.php">Tambah Data Siswa</a>
    <br><br>
    <table border="1">
        <tr>
            <td>Id:</td>
            <td>Nama:</td>
            <td>Nisn:</td>
            <td>Jurusan:</td>
            <td>Email</td>
            <td>Gambar:</td>
            <td>Aksi:</td>
        </tr>
        <?php $i = 1;?>
        <?php foreach ($hasil as $cetak) : ?>
        <tr>
           <td><?= $i; ?></td>
           <td><?= $cetak ['nama']; ?></td>
           <td><?= $cetak ['nisn']; ?></td>
           <td><?= $cetak ['jurusan']; ?></td>
           <td><?= $cetak ['email']; ?></td>
           <td><img src="property/img/<?= $cetak ['gambar']; ?>" width="100" height="100"></td>
           <td>
            <a href="ubah.php?id=<?= $cetak ['id']?>">Ubah</a>
            <a href="hapus.php?id=<?= $cetak ['id']?>"
            onclick="return confirm ('yakin ?')">Hapus</a>
           </td
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>
</html> 