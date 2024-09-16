<?php
    include('ajout.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

    <h2 class="text-center px-3 py-2 text-xl"><u>Ajouter un admin</u></h2>
    <div class="flex justify-center"> 
        <form action="" method="post">
            <div>
                <div class="px-3 py-2">
                    <label for="firstname" class="block">Nom :</label>
                    <input class="px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="firstname" placeholder="Entrer votre nom" type="text" required><br><br>

                    <label for="lastname" class="block">Prénoms :</label>
                    <input class="px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="lastname" placeholder="Entrer votre prénoms" type="text" required><br><br>

                    <label for="email" class="block">Email :</label>
                    <input class="px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="email" placeholder="Entrer votre email" type="email" required><br><br>

                    <label for="password" class="block">Password :</label>
                    <input class="px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="password" placeholder="Entrer votre mot de passe" type="password" required><br><br>
                </div>  
            </div>
            <div class="flex justify-center py-2">
                <input name="submit" type="submit" value="Ajouter"  class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">  
            </div>
        </form>
        
    </div>
    <div class="flex justify-center items-center">
        <div class="p-6 bg-gray-100">
            <p class="text-xl font-semibold mb-4">Tous les Admins</p>

            <?php
                $dsn = "mysql:host=localhost;dbname=etudiant;charset=utf8mb4";
                $username_db = "princy";
                $password_db = "misa2026";
            
                // Connexion à la base de données et requête SQL
                try {
                    $bdd = new PDO($dsn, $username_db, $password_db);
                    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $reponse = $bdd->query("SELECT * FROM admin");

                    echo "<table class='min-w-full bg-white border border-gray-300'>";
                    echo "<thead class='bg-gray-200'>";
                    echo "<tr><th class='py-2 px-4 border-b'>Nom</th><th class='py-2 px-4 border-b'>Prénoms</th><th class='py-2 px-4 border-b'>Email</th></tr>";
                    echo "</thead><tbody>";

                    // Boucle pour afficher toutes les données
                    while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr class='even:bg-gray-100'>";
                        echo "<td class='py-2 px-4 border-b'>" . htmlspecialchars($donnees['firstname']) . "</td>";
                        echo "<td class='py-2 px-4 border-b'>" . htmlspecialchars($donnees['lastname']) . "</td>";
                        echo "<td class='py-2 px-4 border-b'>" . htmlspecialchars($donnees['email']) . "</td>";
                        echo "</tr>";
                    }

                    echo "</tbody></table>";
                    $reponse->closeCursor(); // Termine le traitement de la requête
                } catch (PDOException $e) {
                    echo 'Erreur : ' . $e->getMessage();
                }
            ?>
        </div>
    </div>
    <div class="mt-4 text-center">Deja un compte ? <a href="../index.php" class="bg-red-400 p-3 rounded-full text-white">Se connecter</a></div>

</body>
</html>