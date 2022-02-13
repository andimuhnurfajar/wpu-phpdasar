<?php 

// Koneksi ke database di sinpan ke valiabel conn
// $conn = mysqli_connect("localhost", "root", "", "phpdasar");

// // Mengambil data dari tabel mahasiswa / Query data mahasiswa di simpan ke variabel result
// $result = mysqli_query($conn, "SELECT * FROM mahasiswa");

// Ambil data (Fetch) dari object result
// 1. mysqli_fetch_row() // Mengembalikan array numerik
// 2. mysqli_fetch_assoc() // Mengembalikan array assosiative
// 3. mysqli_fetch_array() // Mengbalikan array keduanya numerik dan assosoative
// 4. mysqli_fetch_object() // Mengembalikan object

// $mhs = mysqli_fetch_row($result);
// var_dump($mhs[3]);
// $mhs = mysqli_fetch_assoc($result);
// var_dump($mhs["jurusan"]);
// $mhs = mysqli_fetch_array($result);
// var_dump($mhs["jurusan"]);
// $mhs = mysqli_fetch_object($result);
// var_dump($mhs->nama);


// if (!$result) {
//    echo mysqli_error($conn);
// }

// var_dump($result);


// atribut enctype untuk mengelola file yang akan di tangkap ole variabel superglobal $_FILES