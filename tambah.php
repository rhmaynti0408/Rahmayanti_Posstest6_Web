<?php
require "cobfig.php";

if(isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $nim = $_POST['nomor'];
    $caption = $_POST['caption'];
    $query = mysqli_query($db,"INSERT INTO pesanan (nama,nomor,caption) VALUES ('$nama','$nomor,'$caption')");
    if(!empty($_FILES['gambar']['name'])){

        $query = mysqli_query($db,"SELECT * FROM pesanan WHERE nomor='$nomor'");
        $result = mysqli_fetch_assoc($query);
        $id = $result['id'];
        $nama = $_POST['nama_gambar'];
        $gambar = $_FILES['gambar']['name'];
        $x = explode('.',$gambar);
        $ekstensi = strtolower(end($x));
        $gambar_baru = "$nama.$ekstensi";
        $tmp = $_FILES['gambar']['tmp_name'];
        if(move_uploaded_file($tmp,"img/$gambar_baru")){
          $query = mysqli_query($db,"INSERT INTO lampiran (id_pesanan,nama_file,file) VALUES ($id,'$nama','$gambar_baru');");
          if($query){
            header("Location:index.php");
          } else {
            echo "Tambah data error";
          }
        }
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<headre, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <h1>hallo, silahkan isi dulu</h1>
        <h2>silahkan masukkan data anda untuk memesan</h2>
</header>

    <div class="table-list">
        <h3>daftar pemesan kopi yanti</h3>
        <a href="form.php" class="tambah">Tambah data pemesan</a>
        <table>
            <tr class="thread">
                <th>nama</th>
                <th>nomor</th>
                <th>caption</th>
                <th colspan="2">Actions</th>
            </tr>
        </table>
    </div>
</body>
</html>