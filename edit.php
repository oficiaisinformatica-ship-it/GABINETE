<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
include 'koneksaun.php';

$id = $_GET['id'];

if (isset($_POST['update'])) {
    $naran = $_POST['naran_dok'];
    $data  = $_POST['data_dok'];
    $obs   = $_POST['observasaun'];

    if (!empty($_FILES['file_dok']['name'])) {
        $file_name = time() . '_' . $_FILES['file_dok']['name'];
        move_uploaded_file($_FILES['file_dok']['tmp_name'], 'uploads/' . $file_name);
        $conn->query("UPDATE tb_aneksos SET naran_dokumento='$naran', data_dokumento='$data', observasaun='$obs', file_path='$file_name' WHERE id=$id");
    } else {
        $conn->query("UPDATE tb_aneksos SET naran_dokumento='$naran', data_dokumento='$data', observasaun='$obs' WHERE id=$id");
    }
    echo "<script>alert('Dadus susesu atualiza!'); window.location='dashboard.php';</script>";
}

$row = $conn->query("SELECT * FROM tb_aneksos WHERE id=$id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="tet">
<head>
    <meta charset="UTF-8">
    <title>Edit Dokumentu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Desain Metan & Bold Professional (Hanesan Dashboard) */
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #050a14; padding: 20px; color: #ffffff; font-weight: bold; }
        .box { max-width: 450px; margin: auto; background: #050a14; padding: 25px; border-radius: 8px; border: 1px solid #1a2a4a; }
        h2 { color: #ffffff; text-align: center; font-size: 16px; margin-bottom: 20px; text-transform: uppercase; border-bottom: 1px solid #1a2a4a; padding-bottom: 10px; }
        
        label { font-size: 11px; color: #ffffff; display: block; margin-top: 10px; font-weight: bold; }
        input { width: 100%; padding: 8px; margin-top: 4px; border: 1px solid #1a2a4a; background: #0a1428; color: #ffffff; border-radius: 4px; box-sizing: border-box; font-size: 11px; font-weight: bold; }
        
        button { width: 100%; background: #0a1428; color: #ffffff; border: 1px solid #ffffff; padding: 10px; border-radius: 4px; margin-top: 20px; cursor: pointer; font-weight: bold; font-size: 12px; }
        button:hover { background: #1a2a4a; }
        
        .current-file { font-size: 10px; color: #f4c430; margin-top: 5px; font-weight: bold; }
        a { color: #ffffff; text-decoration: none; font-size: 11px; display: block; text-align: center; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="box">
        <h2>EDIT DOKUMENTU</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>NARAN DOKUMENTO</label>
            <input type="text" name="naran_dok" value="<?=$row['naran_dokumento']?>" required>
            
            <label>DATA DOKUMENTU</label>
            <input type="date" name="data_dok" value="<?=$row['data_dokumento']?>" required>
            
            <label>OBSERVASAUN</label>
            <input type="text" name="observasaun" value="<?=$row['observasaun']?>">
            
            <label>TROKA FILE (SE IHA)</label>
            <input type="file" name="file_dok">
            <div class="current-file">File dadaun: <?=$row['file_path']?></div>
            
            <button type="submit" name="update"><i class="fas fa-save"></i> ATUALIZA DADUS</button>
            <a href="dashboard.php"><i class="fas fa-arrow-left"></i> FILA BA DASHBOARD</a>
        </form>
    </div>
</body>
</html>