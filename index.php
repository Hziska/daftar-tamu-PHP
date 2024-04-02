<?php
require 'functions.php';

$sql = "SELECT * FROM tamu_sekolah";
$result = mysqli_query($conn,$sql);


$visitors = read("SELECT * FROM tamu_sekolah");

if(isset($_POST["keyword"])){
  $visitors = search($_POST["keyword"]);
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
    <style>
      form .cari{
    width: 200px;
} 
img{
  object-fit: cover;
}
    </style>
</head>
<body>
  <section class="tamu">
    <div class="container">
        <h1 class="text-center m-4">Daftar Tamu</h1>
   
        <div class="d-flex justify-content-between">
          <div class="p-2">
            <a href="tambah.php" class="badge bg-primary p-3 text-decoration-none fs-6">Tambah tamu</a>
          </div>

          <div class="d-flex align-items-center">
            <form method="post" class="d-flex gap-1">
              <input type="text" placeholder="Cari nama tamu" name="keyword" class="cari"  value="<?php echo empty($_POST["keyword"]) ? '' : $_POST["keyword"]; ?>">
              <button class="btn btn-danger">Cari</button>
            </form>
  
          </div>
        </div>
        <table class="table mt-3">
         <thead>
           <tr>
             <th scope="col">No</th>
             <th scope="col">Nama</th>
             <th scope="col">Alamat</th>
             <th scope="col">No. Telpon</th>
             <th scope="col">Jenis kelamin</th>
             <th scope="col">Foto</th>
             <th scope="col">action</th>
           </tr>
         </thead>
         
         <tbody>
  
          <?php
            $i= 1;
          foreach($visitors as $visitor):
           ?>
           <tr>
             <th><?= $i; ?></th>
             <td><?= $visitor["nama"]; ?></td>
             <td><?= $visitor["alamat"]; ?></td>
             <td><?= $visitor["telepon"]; ?></td>
             <td><?= $visitor["jenis_kelamin"]; ?></td>
             <td>
                <img src="img/<?= $visitor["img"]?>" alt="foto">
             </td>
             <td>
                <a href="ubah.php?id=<?= $visitor["id"]?>" class="badge bg-success py-1 px-3 text-decoration-none">Ubah</a>
                <a href="hapus.php?id=<?= $visitor["id"]?>" class="badge bg-danger py-1 px-3 text-decoration-none" onclick="return confirm('yakin mau hapus')">Hapus</a>
             </td>
           </tr>
           <?php
           $i++;
           endforeach;
           ?>
         </tbody>
       </table>
    </div>
  </section>
</body>
</html>