<?php 

$koneksi = mysqli_connect('localhost','root','','sekolahkita_db');

function query($query)
{
    global $koneksi;
    $hasil = mysqli_query($koneksi, $query); //nilai objek
    $kotakbesar = [];
    while ($kotakkacil = mysqli_fetch_assoc($hasil)){ //array assosiatif
        $kotakbesar [] = $kotakkacil;
    }
    return $kotakbesar;
}

function tambah ($post) {
    global $koneksi;

    $nama = $post["nama"];
    $nisn = $post["nisn"];
    $jurusan = $post["jurusan"];
    $email = $post["email"];
    // $gambar = $post["gambar"];

    $gambar = upload();
    if (!$gambar) {
        return false;
    }
    
    $sql = "INSERT INTO tbl_siswa VALUES (
        '','$nama','$nisn','$jurusan','$email','$gambar'
    )";
    
    $hasil = mysqli_query ($koneksi, $sql);

    return mysqli_affected_rows($koneksi);
}

function upload () {
    $namafile = $_FILES ["gambar"] ["name"];
    $ukuranfile = $_FILES ["gambar"] ["size"];
    $error = $_FILES ["gambar"] ["error"];
    $tmpname = $_FILES ["gambar"] ["tmp_name"];

    if  ( $error === 4 ) {
        echo "
        <script>
        alert ('pilih gambar dahulu');
        </script>";

        return false;
    }

    $ekstensiValid = ['jpg','jpeg','png'];
    $ekstensigambar = explode ('.', $namafile);
    $ekstensigambar = strtolower ( end($ekstensigambar));

    if ( !in_array($ekstensigambar, $ekstensiValid)) {
        echo "
        <script>
        alert ('file yang diupload bukan gambar');
        </script>";

        return false;
}
if ( $ukuranfile > 2000000 ) {
    echo "
    <script>
    alert ('maaf, ukuran gambar terlalu besar') ;
    </script>";
    return false;
}
$namafilebaru = uniqid();
$namafilebaru .= '.';
$namafilebaru .= $ekstensigambar;

move_uploaded_file ($tmpname, 'property/img/' . $namafilebaru);

return $namafilebaru;
}

function ubah ($post) {
    global $koneksi;

   
    $id = htmlspecialchars($post["id"]);
    $nama = htmlspecialchars($post["nama"]);
    $nisn = htmlspecialchars($post["nisn"]);
    $jurusan = htmlspecialchars($post["jurusan"]);
    $email = htmlspecialchars($post["email"]);
    // $gambarlama = htmlspecialchars($post["gambarlama"]);

    if ($_FILES ["gambar"]["error"] === 4){
    // $gambar = $gambarlama;
    }else{
    $gambar = upload();

    $sql = "UPDATE tbl_siswa SET
    nama = '$nama',
    nisn = '$nisn',
    jurusan = '$jurusan',
    email = '$email',
    gambar = '$gambar'

    WHERE id = '$id'";

    $hasil = mysqli_query ($koneksi, $sql);

    return mysqli_affected_rows($koneksi);
    }

    
}


?>