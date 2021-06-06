<?php

require 'functions.php';

$mahasiswa = query("SELECT * FROM mahasiswa");

//11.2
if(isset($_POST['cari'])){
    $mahasiswa = Cari($_POST['keyword']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
</head>

<body>
    <h3>Daftar Mahasiswa</h3>

    <a href="tambah.php">Tambah Data Mahasiswa</a>
    <br><br>
    <!-- 11.2 -->
    <form action="" method="POST"> <!-- data tidak terlihat di url <> GET -->
        <input type="text" name="keyword" placeholder="masukkan keyword pencarian" autocomplete="off" size="30">
        <button type="submit" name="cari">Cari</button>
    </form>
    <br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>

        <!-- 11.2 -->
        <?php if (empty($mahasiswa)) : ?>
            <tr>
                <td colspan="4">
                    <p>Data Mahasiswa tidak ditemukan</p>
                </td>
            </tr>
        <?php endif ?>

        <?php $i = 1;
        foreach ($mahasiswa as $m) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><img src="img/<?= $m['Gambar']; ?>" width="60px"></td>
                <td><?= $m['Nama']; ?></td>
                <td>
                    <a href="detail.php?Id=<?= $m['Id']; ?>">Lihat Detail</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>