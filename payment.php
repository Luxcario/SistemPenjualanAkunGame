<?php
require 'config.php';

$transactionId = $_GET['transaction_id'];
$stmt = $pdo->prepare("SELECT transactions.*, products.name, products.price FROM transactions JOIN products ON transactions.product_id = products.id WHERE transactions.id = ?");
$stmt->execute([$transactionId]);
$transaction = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update status pembayaran
    $stmt = $pdo->prepare("UPDATE transactions SET payment_status = 'completed' WHERE id = ?");
    $stmt->execute([$transactionId]);

    // Kirim email (simulasi)
    mail($transaction['customer_email'], "Your Product", "Thank you for your purchase. Your product: " . $transaction['name']);
    echo "Payment completed and email sent!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
    <h1>Payment Confirmation</h1>
    <p>Product: <?= htmlspecialchars($transaction['name']) ?></p>
    <p>Price: <?= number_format($transaction['price'], 2) ?></p>
    <form method="post">
        <button type="submit">Complete Payment</button>
    </form>
</body>
</html>
