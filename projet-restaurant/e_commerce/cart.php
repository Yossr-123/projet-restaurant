<!-- Bootstrap 5 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="assets\css\style.css">
<?php include('includes/db.php'); ?>


<?php
session_start();
include('includes/db.php');
include('includes/header.php');
include('includes/navbar.php');

$cart = $_SESSION['cart'] ?? [];
$total = 0;

if (!empty($cart)) {
    $placeholders = implode(',', array_fill(0, count($cart), '?'));
    $stmt = $conn->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute(array_keys($cart));
    $products = $stmt->fetchAll();
}
?>

<div class="container mt-5">
    <h2>Votre panier</h2>
    <?php if (!empty($cart) && !empty($products)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): 
                    $qty = $cart[$product['id']];
                    $subtotal = $qty * $product['price'];
                    $total += $subtotal;
                ?>
                <tr>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= $qty ?></td>
                    <td><?= number_format($subtotal, 2) ?> €</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h4>Total : <?= number_format($total, 2) ?> €</h4>
    <?php else: ?>
        <p>Votre panier est vide.</p>
    <?php endif; ?>
</div>

<?php include('includes/footer.php'); ?>




<?php
session_start();
require 'db.php'; // pour connecter à la base

$cart = $_SESSION['cart'] ?? [];

$products = [];
$total = 0;

if (!empty($cart)) {
    $placeholders = implode(',', array_fill(0, count($cart), '?'));
    $stmt = $conn->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute(array_keys($cart));
    $products = $stmt->fetchAll();

    foreach ($products as $product) {
        $total += $product['price'] * $cart[$product['id']];
    }
}
?>

<div class="container mt-5">
    <h1>Panier</h1>
    <?php if (empty($products)): ?>
        <p>Votre panier est vide.</p>
    <?php else: ?>
        <ul class="list-group">
            <?php foreach ($products as $product): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($product['name']) ?>
                    <span><?= $cart[$product['id']] ?> x <?= $product['price'] ?> TND</span>
                </li>
            <?php endforeach; ?>
        </ul>
        <h3 class="mt-3">Total : <?= $total ?> TND</h3>
    <?php endif; ?>
</div>

