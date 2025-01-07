<?php
// Gantilah dengan password yang diinginkan untuk user baru
$password = 'passwordBaru';

// Membuat hash password menggunakan BCRYPT
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Menampilkan hash password
echo "Password Hash: " . $hashedPassword;
?>
