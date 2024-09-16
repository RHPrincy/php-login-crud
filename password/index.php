<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du Mot de Passe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-center text-3xl font-semibold text-blue-500 mb-6">Réinitialiser le Mot de Passe</h2>
        <form action="password_reset_request.php" method="post" class="space-y-4">
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-1">Adresse Email :</label>
                <input type="email" id="email" name="email" placeholder="Entrez votre adresse email" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <button type="submit"
                    class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Envoyer le lien de réinitialisation
                </button>
            </div>
        </form>
    </div>
</body>
</html>
