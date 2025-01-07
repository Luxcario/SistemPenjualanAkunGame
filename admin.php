<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require 'config.php';

// Logika CRUD Admin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $stmt = $pdo->prepare("INSERT INTO products (name, price, description) VALUES (?, ?, ?)");
        $stmt->execute([$_POST['name'], $_POST['price'], $_POST['description']]);
    } elseif (isset($_POST['edit'])) {
        $stmt = $pdo->prepare("UPDATE products SET name = ?, price = ?, description = ? WHERE id = ?");
        $stmt->execute([$_POST['name'], $_POST['price'], $_POST['description'], $_POST['id']]);
    } elseif (isset($_POST['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$_POST['id']]);
    }
}

// Ambil data produk
$query = $pdo->query("SELECT * FROM products");
$products = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Sistem Penjualan Akun Game</title>
</head>
<body>
    <h1>Admin Panel</h1>
    <a href="logout.php">Logout</a>
    <hr>
    <h2>Tambah Produk</h2>
    <form method="post">
        <input type="text" name="name" placeholder="Nama Produk" required>
        <input type="number" name="price" placeholder="Harga Produk" required>
        <textarea name="description" placeholder="Deskripsi Produk" required></textarea>
        <button type="submit" name="add">Tambah</button>
    </form>
    <hr>
    <h2>Daftar Produk</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <form method="post">
                        <td><?= $product['id'] ?></td>
                        <td><input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>"></td>
                        <td><input type="number" name="price" value="<?= $product['price'] ?>"></td>
                        <td><textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea></td>
                        <td>
                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                            <button type="submit" name="edit">Ubah</button>
                            <button type="submit" name="delete">Hapus</button>
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
