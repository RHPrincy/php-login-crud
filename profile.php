<?php
    //Ajout
    include('ajout.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <h2 class="text-center m-2 text-3xl text-blue-400">Ajouter un &eacute;tudiant</h2>
    <div class="flex justify-center"> 
        <form action="" method="post">
            <div class="flex">
                <div class="px-3 py-2">
                    <label for="firstname" class="block text-gray-700 font-semibold">Nom :</label>
                    <input class="px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="firstname" placeholder="Entrer votre nom" type="text" required><br><br>

                    <label for="lastname" class="block text-gray-700 font-semibold">Prénoms :</label>
                    <input class="px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="lastname" placeholder="Entrer votre prénoms" type="text" required><br><br>
                    
                    <div class="mb-4">
                        <label for="parcours" class="block text-gray-700 font-semibold mb-2">Parcours :</label>
                            <select name="parcours" id="parcours" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="mit">MIT</option>
                                <option value="misa">MISA</option>
                            </select>
                    </div>

                    <div class="flex justify-evenly text-gray-700 font-semibold ">
                        <input type="radio" id="masculin" name="sexe" value="masculin">
                        <label for="masculin">Masculin</label>
                        <input type="radio" id="feminin" name="sexe" value="feminin">
                        <label for="feminin">Feminin</label>
                    </div>
                </div>
                <div class="px-3 py-2">
                    <label class="block text-gray-700 font-semibold ">Date de naissance :</label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="birthdate" type="date" required><br><br>

                    <label class="block text-gray-700 font-semibold ">Adresse :</label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="address" placeholder="Adresse" type="text" required>
                </div>
            </div>
            <div class="flex justify-center py-2">
                <input name="submit" type="submit" value="Ajouter"  class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">  
            </div>
        </form>
    </div>
    
    <div class="mt-5 flex justify-center items-center">
        <div class="p-6 bg-gray-100">
            <p class="text-center text-xl font-semibold mb-4">Tous les étudiants</p>

            <?php
            
                // Connexion à la base de données et requête SQL
                try {
                    require_once 'config.php'; // Inclut le fichier de configuration de la base de données
                    $connection = new PDO($dsn, $username_db, $password_db);
                    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $reponse = $connection->query("SELECT * FROM members");

                    echo "<table class='min-w-full bg-white border border-gray-300'>";
                    echo "<thead class='bg-gray-200'>";
                    echo "<tr><th class='py-2 px-4 border-b'>ID</th><th class='py-2 px-4 border-b'>Nom</th><th class='py-2 px-4 border-b'>Prénoms</th><th class='py-2 px-4 border-b'>Parcours</th><th class='py-2 px-4 border-b'>Action</th></tr>";
                    echo "</thead><tbody>";

                    // Boucle pour afficher toutes les données
                    while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr class='even:bg-gray-100'>";
                        echo "<td class='py-2 px-2 text-center text-sm border border-gray'>" . htmlspecialchars($donnees['id']) . "</td>";
                        echo "<td class='py-2 px-2 text-center text-sm border border-gray'>" . htmlspecialchars($donnees['firstname']) . "</td>";
                        echo "<td class='py-2 px-2 text-center text-sm border border-gray'>" . htmlspecialchars($donnees['lastname']) . "</td>";
                        echo "<td class='py-2 px-2 text-center text-sm border border-gray'>" . htmlspecialchars($donnees['parcours']) . "</td>";
                        echo "<td class='py-2 px-2 text-center text-sm border border-gray'>";
                            echo "<a href=\"read.php?id=". $donnees['id'] ."\" class=\"me-3\" ><span class=\"bi bi-eye\"></span></a>";
                            echo "<a href=\"update.php?i=". $donnees['id'] ."\" class=\"me-3\" ><span class=\"bi bi-pencil\"></span></a>";
                            echo "<a href=\"delete.php?id=". $donnees['id'] ."\" ><span class=\"bi bi-trash\"></span></a>";
                        echo "</td>";
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
    <div class="mt-4 text-center"><a href="logout.php" class="bg-red-400 p-3 rounded-full text-white">Se deconnecter</a></div>
</body>
</html>