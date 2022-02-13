<?php

// Cek Session
session_start();
if (!isset($_SESSION['login'])) {
   header("Location: login.php");
   exit;
}

// Koneksi ke database
require 'functions.php';

// cek apakah tombol submit sudah di tekan atau belum
if (isset($_POST["submit"])) {

   // Cek apakah data berhasil di simpan atau tidak
   if (tambah($_POST) > 0) {
      echo "
      <script>
         alert('Data Berhasil Ditambahkan');
         document.location.href = 'index.php';
      </script>";
   } else {
      echo "
      <script>
         alert('Data Gagal Ditambahkan');
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
   <title>Tambah Data</title>
</head>

<body>
   <h1>Tambah Data Mahasiswa</h1>

   <form method="post" action="" enctype="multipart/form-data">
      <ul>
         <li>
            <label for="nrp">NRP :<label>
                  <input type="text" name="nrp" id="nrp" required>
         </li>
         <li><label for="nama">Nama :<label>
                  <input type="text" name="nama" id="nama" required>
         </li>
         <li>
            <label for="jurusan">Jurusan :<label>
                  <input type="text" name="jurusan" id="jurusan" required>
         </li>
         <li>
            <label for="email">Email :<label>
                  <input type="email" name="email" id="email" required>
         </li>
         <li>
            <label for="gambar">Gambar<label>
                  <input type="file" name="gambar" id="gambar">
         </li>
         <li>
            <button type="submit" name="submit">Tambah Data Mahasiswa</button>
         </li>
      </ul>

   </form>

   <a href="index.php">Kembali ke Daftar Mahasiswa</a>
</body>

</html>