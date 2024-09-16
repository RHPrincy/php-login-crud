<?php
require_once "config.php"; // Inclure le fichier de configuration PDO

// Vérifier si l'ID est présent dans la requête GET
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = trim($_GET["id"]); // Obtenir l'ID depuis GET

    // Préparer la requête SQL
    $sql = "DELETE FROM members WHERE id = :id";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            // Préparer la requête
            $stmt = $connection->prepare($sql);

            // Lier les paramètres
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Exécuter la requête
            if ($stmt->execute()) {
                // Redirection vers la page d'accueil après la suppression
                header("Location: profile.php");
                exit();
            } else {
                echo "Oops! Une erreur est survenue.";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
} else {
    // Si aucun ID, redirection vers une page d'erreur
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer l'enregistrement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .wrapper {
            width: 700px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Supprimer l'enregistrement</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo htmlspecialchars($id); ?>" method="post">
                        <div class="alert alert-danger">
                            <p>Êtes-vous sûr de vouloir supprimer cet étudiant ?</p>
                            <p>
                                <input type="submit" value="OUI" class="btn btn-danger">
                                <a href="profile.php" class="btn btn-secondary">NON</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
