<?php
require 'config.php';

$query = $pdo->query("SELECT * FROM products");
$products = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penjualan Akun Game</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        h1 {
            margin: 0;
            font-size: 2.5em;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }

        .product-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            padding: 20px;
            transition: transform 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .product-info {
            padding: 15px;
        }

        .product-info h3 {
            margin: 0;
            font-size: 1.8em;
            color: #333;
        }

        .product-info p {
            font-size: 1em;
            color: #666;
        }

        .price {
            font-size: 1.2em;
            font-weight: bold;
            color: #e74c3c;
        }

        .product-card button {
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 1em;
            width: 100%;
            margin-top: 10px;
        }

        .product-card button:hover {
            background-color: #2ecc71;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input {
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        .form-group input[type="email"] {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Sistem Penjualan Akun Game</h1>
    </header>

    <div class="container">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <div class="product-info">
                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                    <p class="price">Harga: Rp<?= number_format($product['price'], 2) ?></p>
                    <p>Deskripsi: <?= htmlspecialchars($product['description']) ?></p>
                </div>

                <form action="buy.php" method="post">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" required>
                    </div>
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <button type="submit">Beli Sekarang</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
