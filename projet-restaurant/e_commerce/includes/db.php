<?php
$host = 'localhost';
$dbname = 'ecommerce';
$user = 'root';
$pass = ''; // pas de mot de passe par défaut avec XAMPP

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // Active le mode exception pour les erreurs PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connexion échouée : " . $e->getMessage());
}
?>

