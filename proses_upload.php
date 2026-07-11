<?php
require 'vendor/autoload.php';
include 'koneksaun.php'; // Asegura katak $db mak uza nu'udar koneksaun PDO

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

// Konfigurasaun foti husi Render Env Vars
Configuration::instance(getenv('CLOUDINARY_URL'));

if (isset($_POST['upload'])) {
    // 1. Upload ba Cloudinary
    $result = (new UploadApi())->upload($_FILES['file_dok']['tmp_name']);
    $file_url = $result['secure_url']; 

    // 2. Insert ba Neon (PostgreSQL) ho PDO
    $naran = $_POST['naran_dok'];
    $data  = $_POST['data_dok'];
    $obs   = $_POST['observasaun'];
    
    // Uza prepare statement atu evita SQL Injection
    $sql = "INSERT INTO tb_aneksos (naran_dokumento, data_dokumento, observasaun, file_path) 
            VALUES (:naran, :data, :obs, :path)";
            
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':naran' => $naran,
        ':data'  => $data,
        ':obs'   => $obs,
        ':path'  => $file_url
    ]);

    echo "<script>alert('Susesu!'); window.location='dashboard.php';</script>";
}
?>