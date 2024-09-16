<?php
// Variable pour stocker les messages d'erreur
$message = '';
// Inclut le fichier de configuration de la base de données
require_once 'config.php';
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $parcours = $_POST['parcours'];
    $sexe = $_POST['sexe'];
    $birthdate = $_POST['birthdate'];
    $address = $_POST['address'];

    // Requête SQL pour insérer les données dans la table 'members'
    $sql = "INSERT INTO members (firstname, lastname, parcours, sexe, birthdate, address) VALUES (:firstname, :lastname, :parcours,:sexe, :birthdate, :address)";

    // Préparation de la requête SQL
    $stmt = $connection->prepare($sql);

    // Liaison des paramètres avec les valeurs des variables PHP
    $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $stmt->bindParam(':parcours', $parcours, PDO::PARAM_STR);
    $stmt->bindParam(':sexe', $sexe, PDO::PARAM_STR);
    $stmt->bindParam(':birthdate', $birthdate, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);

    // Exécution de la requête SQL
    if ($stmt->execute()) {
        // Si l'insertion est réussie, message de confirmation
        $message = "Enregistrement réussi.";
        // Redirection vers 'profile.php'
        header("Location: profile.php");
        exit();
    } 
    else {
        // Si l'insertion échoue, message d'erreur
        $message = "Erreur de connexion à la base de données";
    }
}

// Fermeture de la connexion PDO
$connection = null;
?>
