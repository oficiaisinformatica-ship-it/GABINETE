<?php
// Foti URL husi Render Environment Variables
$db_url = getenv('DATABASE_URL'); 

// Koneksaun ba Neon (PostgreSQL) uza pg_connect
$conn = pg_connect($db_url);

if (!$conn) {
    die("Koneksaun ba Neon database lakon.");
}
?>