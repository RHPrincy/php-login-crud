<?php
    // Démarre la session PHP
    session_start(); 
    // Détruit toutes les sessions existantes
    if(session_destroy()) 
    {
        // Redirige vers la page d'accueil
        header("Location: index.php"); 
    }
?>

