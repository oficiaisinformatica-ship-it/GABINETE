<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
include 'koneksaun.php';

$filter_sql = "";
if (isset($_GET['filter_date']) && !empty($_GET['filter_date'])) {
    $date = $_GET['filter_date'];
    $filter_sql = " WHERE data_dokumento LIKE '$date%'";
}
?>
<!DOCTYPE html>
<html lang="tet">
<head>
    <meta charset="UTF-8">
    <title>SISTEMA ANEKSOS DOKUMENTO</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Desain Metan & Bold Professional */
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #050a14; padding: 15px; color: #ffffff; font-weight: bold; }
        .container { max-width: 950px; margin: auto; border: 1px solid #1a2a4a; padding: 20px; border-radius: 8px; background: #050a14; }
        
        /* Header kiik & Rapidu */
        .header-section { text-align: center; border-bottom: 1px solid #1a2a4a; padding-bottom: 15px; margin-bottom: 15px; }
        .inst-name { color: #ffffff; font-size: 14px; text-transform: uppercase; }
        .gab-name, .team-it { color: #ffffff; font-size: 11px; margin: 0; }
        .title-box { text-align: center; color: #ffffff; font-size: 13px; margin-bottom: 15px; border-bottom: 1px solid #1a2a4a; padding-bottom: 5px; }
        
        /* Action Bar */
        .action-bar { display: flex; justify-content: space-between; padding: 10px; background: #0a1428; border: 1px solid #1a2a4a; border-radius: 4px; }
        .btn-icon { background: none; border: none; color: #ffffff; font-size: 14px; cursor: pointer; font-weight: bold; }
        .input-filter { background: #050a14; border: 1px solid #1a2a4a; color: #ffffff; padding: 3px; font-size: 11px; font-weight: bold; }

        /* Tabela kiik & moos */
        table { width: 100%; border-collapse: collapse; border: 1px solid #1a2a4a; }
        th { background: #0a1428; color: #ffffff; padding: 8px; border: 1px solid #1a2a4a; font-size: 11px; text-align: center; }
        td { padding: 8px; border: 1px solid #1a2a4a; text-align: center; color: #ffffff; font-size: 11px; font-weight: bold; }
        
        /* Simbolu hotu Mutin Bold */
        i { color: #ffffff; font-weight: 900; font-size: 13px; }
        a { color: #ffffff; text-decoration: none; }
        
        .form-box { background: #0a1428; padding: 10px; border: 1px solid #1a2a4a; margin-bottom: 15px; display: none; }
        .form-grid { display: grid; grid-template-columns: repeat(4, 1fr) auto; gap: 5px; }
        input { background: #050a14; border: 1px solid #1a2a4a; color: #ffffff; padding: 5px; font-size: 11px; }
    </style>
</head>
<body>
<div class="container">
    <div class="header-section">
        <img src="gmprm.png" alt="Logo" style="width:40px;">
        <div class="inst-name">MINISTÉRIO DO PETRÓLEO E RECURSOS MINERAIS</div>
        <div class="gab-name">Gabinete do Ministro</div>
        <div class="team-it">TEAM IT GMPRM</div>
    </div>

    <div class="title-box">SISTEMA ANEKSOS DOKUMENTO</div>

    <div class="action-bar">
        <div class="action-left">
            <!-- Icon Aumenta Dadus ho Senteira (Fix) -->
            <button class="btn-icon" onclick="toggleForm()" title="Aumenta Dadus"><i class="fas fa-plus-square"></i></button>
            <form method="GET" style="display:inline;">
                <input type="month" name="filter_date" class="input-filter" value="<?= $_GET['filter_date'] ?? '' ?>">
                <button type="submit" class="btn-icon"><i class="fas fa-filter"></i></button>
                <?php if(isset($_GET['filter_date'])): ?>
                    <a href="dashboard.php" class="btn-icon"><i class="fas fa-sync-alt"></i></a>
                <?php endif; ?>
            </form>
        </div>
        <a href="logout.php" class="btn-icon"><i class="fas fa-sign-out-alt"></i></a>
    </div>

    <form id="formUpload" action="proses_upload.php" method="POST" enctype="multipart/form-data" class="form-box">
        <div class="form-grid">
            <input type="text" name="naran_dok" placeholder="Naran" required>
            <input type="date" name="data_dok" required>
            <input type="text" name="observasaun" placeholder="Obs">
            <input type="file" name="file_dok" required>
            <button type="submit" name="upload" style="background:#0a1428; color:#ffffff; border:1px solid #ffffff; font-size:11px; cursor:pointer;"><i class="fas fa-save"></i> SAVE</button>
        </div>
    </form>

    <table>
        <tr><th>NARAN DOKUMENTO</th><th>DATA</th><th>OBSERVASAUN</th><th>FILE</th><th>AKSAUN</th></tr>
        <?php
        $query = "SELECT * FROM tb_aneksos $filter_sql ORDER BY data_dokumento DESC";
        $result = $conn->query($query);
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['naran_dokumento']}</td>
                    <td>".date("d-m-Y", strtotime($row['data_dokumento']))."</td>
                    <td>{$row['observasaun']}</td>
                    <td><a href='uploads/{$row['file_path']}' target='_blank'><i class='fas fa-download'></i></a></td>
                    <td>
                        <a href='edit.php?id={$row['id']}'><i class='fas fa-edit'></i></a>
                        <a href='hapus.php?id={$row['id']}' onclick=\"return confirm('Hamos?')\"><i class='fas fa-trash-alt'></i></a>
                    </td>
                  </tr>";
        }
        ?>
    </table>
</div>
<script>
    function toggleForm() {
        var x = document.getElementById("formUpload");
        x.style.display = (x.style.display === "none" || x.style.display === "") ? "block" : "none";
    }
</script>
</body>
</html>