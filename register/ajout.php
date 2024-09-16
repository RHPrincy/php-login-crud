<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$message = ''; // Variable pour stocker les messages d'erreur

require_once '../config.php'; // Inclut le fichier de configuration de la base de données

try {
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérification si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des données du formulaire
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Requête SQL pour insérer les données dans la table 'admin'
        $sql = "INSERT INTO admin (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)";

        // Préparation de la requête SQL
        $stmt = $connection->prepare($sql);

        // Liaison des paramètres avec les valeurs des variables PHP
        $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        // Exécution de la requête SQL
        if ($stmt->execute()) {
            // Si l'insertion est réussie, message de confirmation
            $message = "Enregistrement réussi.";
            // Optionnel : Redirection vers une page de confirmation ou de connexion
            header("Location: index.php");
            exit();
        } else {
            // Si l'insertion échoue, message d'erreur
            $message = "Erreur lors de l'exécution de la requête.";
        }
    }
} catch (PDOException $e) {
    // Capture et affichage des erreurs PDO
    $message = "Erreur de connexion à la base de données : " . $e->getMessage();
} catch (Exception $e) {
    // Capture et affichage des autres erreurs
    $message = "Erreur : " . $e->getMessage();
} finally {
    // Fermeture de la connexion PDO
    $connection = null;
}

// Affichage du message
echo $message;
?>
