<?php

// Cek Session
session_start();
if (!isset($_SESSION['login'])) {
   header("Location: login.php");
   exit;
}

require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC");

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