<?php

// Cek Session
session_start();
if (!isset($_SESSION['login'])) {
   header("Location: login.php");
   exit;
}

require 'functions.php';

//  Pagination 
$jumlahDataPerhalaman = 3;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
$halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;


$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerhalaman");

// Jika tombol cari ditekan
if (isset($_POST["cari"])) {
   $mahasiswa = cari($_POST["keyword"]);
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Halaman Admin</title>
</head>

<body>
   <a href="logout.php">Logout</a>

   <h1>Daftar Mahasiswa</h1>

   <a href="tambah.php">Tambah Data Mahasiswa</a>
   <br><br>

   <form method="post" action="">
      <input type="text" name="keyword" size="40" autofocus placeholder="Masukkan keyword pencarian" autocomplete="off">
      <button type="submit" name="cari">Cari</button>
   </form>
   <br>

   <!-- Navigasi -->
   <?php if ($halamanAktif > 1) : ?>
      <a href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
   <?php endif; ?>

   <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
      <?php if ($i == $halamanAktif) : ?>
         <a href="?halaman=<?php echo $i; ?>" style="font-weight: bold; color:limegreen"><?= $i; ?></a>
      <?php else : ?>
         <a href="?halaman=<?php echo $i; ?>"><?= $i; ?></a>
      <?php endif; ?>
   <?php endfor; ?>

   <?php if ($halamanAktif < $jumlahHalaman) : ?>
      <a href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
   <?php endif; ?>

   <br>
   <table border="1" cellpadding="10" cellspacing="0">
      <tr>
         <th>No</th>
         <th>Aksi</th>
         <th>Gambar</th>
         <th>NRP</th>
         <th>Nama</th>
         <th>Jurusan</th>
         <th>Email</th>
      </tr>
      <?php $no = 1; ?>
      <?php foreach ($mahasiswa as $row) { ?>
         <tr>
            <td><?= $no; ?></td>
            <td>
               <a href="ubah.php?id=<?= $row["id"] ?>">Edit</a> |
               <a href=" hapus.php?id=<?= $row["id"] ?>" onclick="return confirm('Yakin data ingin dihapus?')">Delete</a>
            </td>
            <td><img src=" img/<?= $row["gambar"] ?>" width="40">
            </td>
            <td><?= $row["nrp"]; ?></td>
            <td><?= $row["nama"]; ?></td>
            <td><?= $row["jurusan"]; ?></td>
            <td><?= $row["email"]; ?></td>
         </tr>
         <?php $no++ ?>
      <?php } ?>

   </table>
</body>

</html>