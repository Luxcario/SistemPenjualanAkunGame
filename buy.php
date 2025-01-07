<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['product_id'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("INSERT INTO transactions (product_id, customer_email, payment_status, created_at) VALUES (?, ?, 'pending', NOW())");
    $stmt->execute([$productId, $email]);

    header("Location: payment.php?transaction_id=" . $pdo->lastInsertId());
    exit;
}
?>
