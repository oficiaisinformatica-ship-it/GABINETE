<?php
session_start();      // Loke session ne'ebé hela
session_destroy();    // Hamos session hotu
header("Location: login.php"); // Fila fali ba pagina login
exit;
?>