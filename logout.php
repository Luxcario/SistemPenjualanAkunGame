<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hapus semua data session
session_destroy();

// Arahkan kembali ke halaman login
header("Location: login.php");
exit;
?>
