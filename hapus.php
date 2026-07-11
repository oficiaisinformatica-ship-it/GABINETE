<?php
include 'koneksaun.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM tb_aneksos WHERE id = $id");
}
header("Location: dashboard.php");
?>