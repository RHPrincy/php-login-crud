<?php
// Afficher toutes les erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
$host = 'localhost';
$db   = 'etudiant';
$user = 'princy';
$pass = 'misa2026';

$dsn = "mysql:host=$host;dbname=$db";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Récupérer l'email depuis le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST['email'];

        // Vérifier si l'email existe dans la base de données
        $stmt = $pdo->prepare('SELECT password FROM admin WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            // Récupérer le mot de passe (à ne pas faire en pratique pour des raisons de sécurité)
            $password = $user['password'];

            // Envoyer l'email
            $to = $email;
            $subject = 'Votre Mot de Passe';
            $message = "Votre mot de passe est : $password";
            $headers = "From: php@php.com";

            if (mail($to, $subject, $message, $headers)) {
                echo "Un email a été envoyé avec votre mot de passe.";
            } else {
                echo "Une erreur est survenue lors de l'envoi de l'email.";
            }
        } else {
            echo "Cet email n'est pas enregistré.";
        }
    } else {
        echo "Adresse email invalide.";
    }
} else {
    echo "Méthode de requête non autorisée.";
}
?>
