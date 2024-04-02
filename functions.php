<?php
$servername = "localhost";
$username = "root";
$password = '';
$db_name = "belajarphp";

$conn = mysqli_connect($servername,$username,$password,$db_name);

if(!$conn){
    die('koneksi gagal terhubung');
}

// read data
function read($sql){
    global $conn;
    $result = mysqli_query($conn,$sql);

    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

// create data
function create($data){
    global $conn;
    // menangkap data form
    $nama = $data["nama"];
    $alamat = $data["alamat"];
    $telepon = $data["telepon"];
    $kelamin = $data["kelamin"];
    $foto = upload();
    if(!$foto){
        return false;
    }

    $sql = "INSERT INTO tamu_sekolah values ('','$nama','$alamat','$telepon','$kelamin','$foto')";
     mysqli_query($conn,$sql);
     return mysqli_affected_rows($conn);
}

function upload(){
    $nama_foto = $_FILES["foto"]["name"];
    $size = $_FILES["foto"]["size"];
    $error= $_FILES["foto"]["error"];
    $tmp_name = $_FILES["foto"]["tmp_name"];

    // membuat harus menambahkan foto dulu
    if($error === 4){
        echo "
        <script>
          alert('harus upload foto terlebih dahulu')
        </script>
      ";
      return false;
    }

    // atur size 
    if($size >  1097152  ){
        echo "
        <script>
          alert('ukuran gambar terlalu besar')
        </script>
      ";
      return false;
    }
    
    // ekstensi gambar harus sesuai
    $ekstensi_foto_valid = ['jpg','jpeg','png'];
    $ekstensi_foto = explode('.',$nama_foto);
    $ekstensi_foto = strtolower(end($ekstensi_foto));

    if(!in_array($ekstensi_foto,$ekstensi_foto_valid)){
        echo "
        <script>
          alert('ekstensi tidak valid')
        </script>
      ";
      return false;
    }

    // nama gambar baru
    $nama_foto_baru = uniqid();
    $nama_foto_baru .= '.'; 
    $nama_foto_baru .= $ekstensi_foto;
    
    // pindah file
    move_uploaded_file($tmp_name,'img/'.$nama_foto_baru);
    return $nama_foto_baru;
}


// update
function update ($data){
    global $conn;

    $id = $data["id"];
    $nama = $data["nama"];
    $alamat = $data["alamat"];
    $telepon = $data["telepon"];
    $kelamin = $data["kelamin"];
    $foto_lama = $data["foto_lama"];
    if($_FILES["foto"]["error"] === 4){
        $foto = $foto_lama;
    }else{
        $foto = upload();
    }
    
    $sql = "UPDATE tamu_sekolah SET
     nama='$nama',
     alamat = '$alamat',
     telepon = '$telepon',
     jenis_kelamin = '$kelamin',
     img = '$foto'
     WHERE id=$id";

    mysqli_query($conn,$sql);
   return mysqli_affected_rows($conn);
}

// hapus
function delete ($id){
    global $conn;

    $sql  = "DELETE FROM tamu_sekolah WHERE id=$id";

    mysqli_query($conn,$sql);
    return mysqli_affected_rows($conn);
}

// search
function search($keyword){
    global $conn;
    $sql = "SELECT * FROM tamu_sekolah WHERE 
    nama LIKE '%$keyword%'
    ";

    return read($sql);
}

?>