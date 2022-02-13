<?php

// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

// Mengambil data dari tabel mahasiswa / Auery data mahasiswa
$result = mysqli_query($conn, "SELECT * FROM mahasiswa");

// Ambil data (Fetch) dari object result
// while ($mhs = mysqli_fetch_assoc($result)) {
//    var_dump($mhs);
// }

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
   <h2>Daftar Mahasiswa</h2>

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
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
         <tr>
            <td><?= $no; ?></td>
            <td>
               <a href="">Edit</a> |
               <a href="">Delete</a>
            </td>
            <td><img src="img/<?= $row["gambar"] ?>" width="40"></td>
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