<?php
require 'functions.php';

$id = $_GET["id"];
$visitor = read("SELECT * FROM tamu_sekolah WHERE id=$id")[0];

if(isset($_POST["submit"])){
  
if(update($_POST) > 0){
  echo "
    <script>
      alert('data sudah diupdate')
      document.location.href='index.php'
    </script>
  ";
}else{
  echo "
  <script>
    alert('data gagal diupdate')
  </script>
";
}
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Membuat daftar tamu</title>
    <!-- botstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <section class="tamu">
    <div class="container">
        <h1 class="text-center m-4">Tambah Tamu</h1>
   
          <form method="post" class="d-block" enctype="multipart/form-data">
            <!-- penanda -->
            <input name="id" type="hidden"value="<?= $visitor["id"]?>" >
            <input name="foto_lama" type="hidden" value="<?= $visitor["img"]?>" >

            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="<?= $visitor["nama"]?>">

            <label for="alamat">alamat</label>
            <input type="text" id="alamat" name="alamat" value="<?= $visitor["alamat"]?>">

            <label for="telepon">No. Telepon</label>
            <input type="text" id="telepon" name="telepon" value="<?= $visitor["telepon"]?>">

            <label for="kelamin">jenis kelamin</label>
            <br>
           <select name="kelamin" id="kelamin">
           <option selected class="d-none"><?= $visitor["jenis_kelamin"]?></option>
            <option value="laki-laki">laki-laki</option>
            <option value="perempuan">perempuan</option>
           </select>
           <br>

            <label for="foto">foto</label>
            <input type="file" id="foto" name="foto"">


            <button class="btn btn-primary mt-4" type="submit" name="submit">ubah</button>
          </form>

    </div>
  </section>
</body>
</html>