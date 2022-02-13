<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

// Function Query = Untuk mengambil data dari database
function query($query)
{
   global $conn;
   // Mengambil data dari tabel mahasiswa / Auery data mahasiswa
   $result  = mysqli_query($conn, $query);
   $rows = [];
   while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
   }
   return $rows;
}


function tambah($data)
{
   global $conn;
   // Mengambil data dari $_POST di masukkan ke dalam variabel
   $nrp = htmlspecialchars($data["nrp"]);
   $nama = htmlspecialchars($data["nama"]);
   $jurusan = htmlspecialchars($data["jurusan"]);
   $email = htmlspecialchars($data["email"]);

   // Upload gambar
   $gambar = upload();
   if (!$gambar) {
      return false;
   }

   $query = "INSERT INTO mahasiswa VALUES
            (
               '', '$nama', '$nrp', '$jurusan', '$email', '$gambar'
            )";

   //  query insert data
   mysqli_query($conn, $query);

   return mysqli_affected_rows($conn);
}

function upload()
{
   $namaFile = $_FILES['gambar']['name'];
   $ukuranFile = $_FILES['gambar']['size'];
   $error  = $_FILES['gambar']['error'];
   $tmpName = $_FILES['gambar']['tmp_name'];

   // Cek apakah tidak ada gambar yang diupload
   if ($error === 4) {
      echo "
      <script>
         alert('Pilih gambar Terlebih Dahulu');
         document.location.href = 'index.php';
      </script>";
      return false;
   }

   // Cek apakah yang di upload adalah gambar
   $ekstensiGambarfalid = ['jpg', 'jpeg', 'png'];
   $ekstensiGambar = explode('.', $namaFile);
   $ekstensiGambar = strtolower(end($ekstensiGambar));

   if (!in_array($ekstensiGambar, $ekstensiGambarfalid)) {
      echo "
   <script>
      alert('Yang diupload bukan gambar');
      document.location.href = 'index.php';
   </script>";
      return false;
   };

   // Cek ukuran gambar
   if ($ukuranFile > 1000000) {
      echo "
   <script>
      alert('Ukuran gambar terlalu besar');
      document.location.href = 'index.php';
   </script>";
      return False;
   }

   // Opload gambar jika lolos pengecekan
   // // Generate nama gambar bar
   $namaFileBaru = uniqid();
   $namaFileBaru .= '.';
   $namaFileBaru .= $ekstensiGambar;


   move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
   return $namaFileBaru;
}




function hapus($id)
{
   global $conn;
   mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
   return mysqli_affected_rows($conn);
}

function ubah($data)
{
   global $conn;
   // Mengambil data dari $_POST di masukkan ke dalam variabel
   $id = $data['id'];
   $nrp = htmlspecialchars($data["nrp"]);
   $nama = htmlspecialchars($data["nama"]);
   $jurusan = htmlspecialchars($data["jurusan"]);
   $email = htmlspecialchars($data["email"]);
   $gambarLama = htmlspecialchars($data["gambarLama"]);

   // Cek apakah user pilih gambar baru atau tidak
   if ($_FILES['gambar']['error'] === 4) {
      $gambar = $gambarLama;
   } else {
      $gambar = upload();
   }

   $query = "UPDATE mahasiswa SET
            nrp = '$nrp',
            nama = '$nama',
            jurusan = '$jurusan',
            email = '$email',
            gambar = '$gambar'
            WHERE id = $id ";

   //  query insert data
   mysqli_query($conn, $query);

   return mysqli_affected_rows($conn);
}

function cari($keyword)
{
   $query = "SELECT * FROM mahasiswa WHERE 
   nama LIKE '%$keyword%' OR
   nrp LIKE '%$keyword%' OR
   email LIKE '%$keyword%' OR
   jurusan LIKE '%$keyword%' 
   ";

   return query($query);
}

function registrasi($data)
{
   global $conn;
   $username = strtolower(stripslashes($data["username"]));
   $password = mysqli_real_escape_string($conn, $data["password"]);
   $password2 = mysqli_real_escape_string($conn, $data["password2"]);

   // Cek username sudah ada atau belum 
   $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
   if (mysqli_fetch_assoc($result)) {
      echo "
      <script>
         alert('username sudah terdaftar !');
      </script>";
      return False;
   }

   // Cek konfirmasi Password
   if ($password !== $password2) {
      echo "
      <script>
         alert('konfirmasi password tidak sesuai !');
      </script>";
      return false;
   }
   // Enkripsi password
   $password = password_hash($password, PASSWORD_DEFAULT);

   // Tambahkan user baru ke database
   mysqli_query($conn, "INSERT INTO user VALUES('','$username', '$password')");

   return mysqli_affected_rows($conn);
}
