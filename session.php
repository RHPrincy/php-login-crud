<?php
// Démarrage de la session
session_start();

// Connexion à la base de données
require_once 'config.php';

/* session_start() initialise ou reprend une session PHP existante, 
nécessaire pour accéder aux variables de session comme $_SESSION['login_user'].*/

// Vérification de la session utilisateur
if (!isset($_SESSION['login_user'])) {
    // Redirection vers la page d'accueil si l'utilisateur n'est pas connecté
    header('Location: index.php'); 
    exit;
}
/* if (!isset($_SESSION['login_user'])) { ... } 
vérifie si l'utilisateur est connecté en vérifiant si la variable de session login_user est définie. 
Si elle ne l'est pas, l'utilisateur est redirigé vers index.php et le script s'arrête.*/


// $user_check = $_SESSION['login_user']; récupère le nom d'utilisateur depuis la session.
// $stmt = $connection->prepare("SELECT email FROM login WHERE email=:email"); prépare une requête SQL pour sélectionner le nom d'utilisateur dans la table login où le nom d'utilisateur correspond à celui stocké dans $user_check.
// $stmt->bindParam(':email', $user_check, PDO::PARAM_STR); lie le paramètre :email à la variable $user_check.
// $stmt->execute(); exécute la requête préparée.

// Récupération email depuis la session
$user_check = $_SESSION['login_user'];

// Requête SQL pour vérifier l'existence de l'utilisateur dans la base de données
$stmt = $connection->prepare("SELECT email FROM members WHERE email=:email");
$stmt->bindParam(':email', $user_check, PDO::PARAM_STR);
// L'instruction $stmt->bindParam(':email', $user_check, PDO::PARAM_STR); est utilisée pour lier une variable PHP à un paramètre nommé dans une instruction SQL préparée. Cela se fait avec la méthode bindParam de l'objet PDOStatement, qui est renvoyé par la méthode prepare de l'objet PDO
$stmt->execute();

// Récupération du résultat de la requête
$row = $stmt->fetch(PDO::FETCH_ASSOC);
// $row = $stmt->fetch(PDO::FETCH_ASSOC); récupère la première ligne de résultat sous forme de tableau associatif.
// PDO::FETCH_ASSOC est une constante de la classe PDO qui spécifie le mode de récupération des résultats. Avec PDO::FETCH_ASSOC, chaque ligne de résultat est retournée sous forme de tableau associatif, où les clés sont les noms des colonnes de la table et les valeurs sont les valeurs des colonnes correspondantes.
$login_session = $row['email'];
// $login_session = $row['email']; récupère l'email de la ligne récupérée.

if (!$login_session) {
    // if (!$login_session) { ... } vérifie si $login_session est vide ou non défini. Si c'est le cas, l'utilisateur est redirigé vers index.php et le script s'arrête.
    header('Location: index.php'); // Redirection vers la page d'accueil si l'utilisateur n'est pas trouvé
    exit;
}

// Fermeture de la connexion à la base de données
$connection = null;
?>
