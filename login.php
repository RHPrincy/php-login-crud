<?php
// Démarrage de la session
session_start();

// Variable pour stocker les messages d'erreur 
$error = ''; 

if (isset($_POST['submit'])) { // Vérifie si le formulaire a été soumis
    $email = $_POST['email'];
    $password = $_POST['password'];

    require_once 'config.php'; // Inclut le fichier de configuration de la base de données
    

    /* Préparation de la requête SQL avec paramètres sécurisés
    La requête SQL sélectionne les enregistrements de la table login où le nom d'utilisateur et le mot de passe correspondent aux valeurs fournies par l'utilisateur
    
    - prepare() est une méthode de l'objet PDO ($connection dans ce cas) qui permet de préparer une requête SQL à être exécutée.
    - À l'intérieur des guillemets doubles (" "), vous définissez votre requête SQL. Dans cet exemple : "SELECT * FROM members WHERE email=? AND password=?".
    - Les ? dans la requête sont des marqueurs de paramètres. Ils indiquent à PDO où insérer les valeurs des variables fournies ultérieurement.*/
    
    $stmt = $connection->prepare("SELECT * FROM admin WHERE BINARY email=? AND BINARY password=?");
    // En utilisant BINARY, vous indiquez à MySQL de traiter les champs email et password en respectant la casse (utf8_bin), ce qui rend la requête SQL sensible à la case.

    // $stmt est l'objet qui représente la requête préparée, créé avec la méthode prepare() de l'objet PDO ($connection dans votre cas).
    // execute([$email, $password]) est une méthode de l'objet PDOStatement ($stmt), qui exécute la requête SQL préparée avec les valeurs spécifiées dans le tableau [ $email, $password ].
    $stmt->execute([$email, $password]);

    // Vérification du résultat de la requête
    $rows = $stmt->rowCount(); // Nombre de lignes retournées par la requête

    if ($rows == 1) {
        // Initialisation de la session utilisateur
        $_SESSION['login_user'] = $email;
        // Redirection vers la page de profil
        header("Location: profile.php");
        // Arrêt du script après la redirection
        exit(); 
    } 
    else {
        // Message d'erreur si l'authentification échoue
        $error = "Email ou mot de passe invalide"; 
    }

    // Fermeture de la connexion à la base de données
    $connection = null; 
    // En affectant null à la variable $connection qui maintient l'objet PDO, vous indiquez à PHP que vous ne souhaitez plus utiliser cette connexion.
}
?>
