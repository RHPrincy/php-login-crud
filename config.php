<?php
    // Connexion à la base de données
    /*$dsn = Data source name; 
    c'est une chaîne de connexion qui contient les informations nécessaires pour se connecter à une base de données.*/
    $dsn = "mysql:host=localhost;dbname=etudiant;charset=utf8mb4";
    $username_db = "princy";
    $password_db = "misa2026";

    // Connexion à la base de données et requête SQL
    $connection = new PDO($dsn, $username_db, $password_db);
?>