<!-- Bootstrap 5 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="assets\css\style.css">




<?php
include('includes/db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: index.php');
        exit();
    } else {
        echo "<div class='alert alert-danger'>Email ou mot de passe incorrect</div>";
    }
}
?>






<?php include('includes/header.php'); ?>
<?php include('includes/navbar.php'); ?>

<div class="container mt-5">
    <h2>Connexion</h2>
    <form action="login.php" method="post" class="mt-3">
        <div class="mb-3">
            <label for="email" class="form-label">Adresse Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" class="btn btn-success">Se connecter</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>
<?php include('includes/db.php'); ?>
