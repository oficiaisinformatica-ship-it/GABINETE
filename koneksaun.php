<?php
// Uza DATABASE_URL husi Render (Neon/Postgres)
$db_url = getenv('DATABASE_URL');

try {
    // Parser URL ne'e ba formatu ne'ebé PDO gosta
    $db = new PDO($db_url);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>