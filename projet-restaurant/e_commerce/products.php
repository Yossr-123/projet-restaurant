<!-- Bootstrap 5 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="assets\css\style.css">
<?php include('includes/db.php'); ?>


<style>
.card-img-top {
    width: 100%;
    height: 250px;
    object-fit: cover;
}
</style>


<?php
include('includes/db.php');
include('includes/header.php');
include('includes/navbar.php');

$stmt = $conn->query("SELECT * FROM products");
$products = $stmt->fetchAll();
?>

<div class="container mt-5">
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card mb-4 shadow-sm w-100">
                    <img src="assets/img/<?= htmlspecialchars($product['image']) ?>" 
                         class="card-img-top product-img" 
                         alt="<?= htmlspecialchars($product['name']) ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
                        <p class="fw-bold"><?= htmlspecialchars($product['price']) ?> TND</p>
                        <a href="add_to_cart.php?id=<?= $product['id'] ?>" class="btn btn-primary mt-auto">Ajouter au panier</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<style>
.product-img {
    width: 100%;
    height: 250px;
    object-fit: cover;
}
.card {
    display: flex;
    flex-direction: column;
    height: 100%;
}
.card-body {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}
</style>
<?php include('includes/footer.php'); ?>
