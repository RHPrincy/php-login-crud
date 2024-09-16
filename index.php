<?php
    // Inclut le script de connexion (login.php) qui gère l'authentification de l'utilisateur
    include('login.php'); 

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion d'&eacute;tudiant</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <h2 class="text-center text-3xl mt-5">CONNEXION</h2>
    <div class="flex justify-center items-center px-3 py-2 mt-5">
        <form action="" method="post">
            <div class="mt-2">
                <label for="email" class="block text-blue-500">Email :</label>
                <input id="email" name="email" placeholder="Entrer votre Email" type="text" class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mt-2">
                <label for="password" class="block text-blue-500">Mot de passe :</label>
                <input id="password" name="password" placeholder="Entrer votre Mot de passe" type="password" class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mt-5 flex justify-center">
                <input name="submit" type="submit" value="Se connecter" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            </div>

            <div class="mt-2 flex justify-end text-red-400">
                <a href="./password/index.php" class="text-xs">Mot de passe oubli&eacute;?</a>
            </div>

            <hr class="m-3 border-t-1 border-gray-400">

            <div class="mt-2 flex justify-between">
                <span class="text-sm">Pas de compte?</span>
                <a href="./register/index.php" class="text-sm text-gray-500">S'inscrire</a>
            </div>
            
            <!-- Affiche les messages d'erreur s'il y en a -->
            <?php if (!empty($error)): ?>
                <div class="mt-5 p-2 bg-red-500 text-white"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>

