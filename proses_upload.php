<?php
require 'vendor/autoload.php';
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

// Konfigurasaun foti husi Render Env Vars
Configuration::instance(getenv('CLOUDINARY_URL'));

if (isset($_POST['upload'])) {
    // 1. Upload ba Cloudinary
    $result = (new UploadApi())->upload($_FILES['file_dok']['tmp_name']);
    $file_url = $result['secure_url']; // Ne'e link ne'ebé ita rai iha database

    // 2. Insert ba Neon (PostgreSQL)
    $naran = $_POST['naran_dok'];
    $data  = $_POST['data_dok'];
    $obs   = $_POST['observasaun'];
    
    $query = "INSERT INTO tb_aneksos (naran_dokumento, data_dokumento, observasaun, file_path) 
              VALUES ('$naran', '$data', '$obs', '$file_url')";
              
    pg_query($conn, $query);

    echo "<script>alert('Susesu!'); window.location='dashboard.php';</script>";
}
?>