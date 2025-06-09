<!-- Bootstrap 5 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="assets\css\style.css">


<?php include('includes/header.php'); ?>
<?php include('includes/navbar.php'); ?>




<?php
include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Vérifier si l'email existe déjà
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        echo "<div class='alert alert-danger'>Email déjà utilisé</div>";
    } else {
        // Insérer dans la base
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $email, $password])) {
            echo "<div class='alert alert-success'>Inscription réussie</div>";
        } else {
            echo "<div class='alert alert-danger'>Erreur lors de l'inscription</div>";
        }
    }
}
?>





<div class="container mt-5">
    <h2>Créer un compte</h2>
    <form action="register.php" method="post" class="row g-3 mt-3">
        <div class="col-md-6">
            <label for="name" class="form-label">Nom complet</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">Adresse Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="col-md-6">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <div class="col-md-6">
            <label for="confirm_password" class="form-label">Confirmer mot de passe</label>
            <input type="password" class="form-control" name="confirm_password" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </div>
    </form>
</div>

<?php include('includes/footer.php'); ?>
<?php include('includes/db.php'); ?>
