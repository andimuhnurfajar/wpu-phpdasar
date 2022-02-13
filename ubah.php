<?php

// Cek Session
session_start();
if (!isset($_SESSION['login'])) {
   header("Location: login.php");
   exit;
}

// Koneksi ke database
require 'functions.php';

// Mengambil data di URL
$id = $_GET["id"];

// Query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];
// var_dump($mhs);

// cek apakah tombol submit sudah di tekan atau belum
if (isset($_POST["submit"])) {

   // Cek apakah data berhasil ubah atau tidak
   if (ubah($_POST) > 0) {
      echo "
      <script>
         alert('Data Berhasil Diubah');
         document.location.href = 'index.php';
      </script>";
   } else {
      echo "
      <script>
         alert('Data Gagal Diubah');
         document.location.href = 'index.php';
      </script>";
   }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Data</title>
</head>

<body>
   <h1>Edit Data Mahasiswa</h1>

   <form method="post" action="" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
      <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
      <ul>
         <li>
            <label for="nrp">NRP :<label>
                  <input type="text" name="nrp" id="nrp" required value="<?= $mhs["nrp"]; ?>">
         </li>
         <li><label for="nama">Nama :<label>
                  <input type="text" name="nama" id="nama" required value="<?= $mhs["nama"]; ?>">
         </li>
         <li>
            <label for="jurusan">Jurusan :<label>
                  <input type="text" name="jurusan" id="jurusan" required value="<?= $mhs["jurusan"]; ?>">
         </li>
         <li>
            <label for="email">Email :<label>
                  <input type="email" name="email" id="email" required value="<?= $mhs["email"]; ?>">
         </li>
         <li>
            <label for="gambar">Gambar<label>
                  <img src="img/<?= $mhs['gambar']; ?>" width="40" alt="">
                  <input type="file" name="gambar" id="gambar">
         </li>
         <li>
            <button type="submit" name="submit">Update Data Mahasiswa</button>
         </li>
      </ul>

   </form>

   <a href="index.php">Kembali ke Daftar Mahasiswa</a>
</body>

</html>