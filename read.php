<?php
// Vérifiez si le paramètre id existe
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Connexion à la base de données
    try {
        require_once 'config.php'; // Inclut le fichier de configuration de la base de données
        $connection = new PDO($dsn, $username_db, $password_db);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête
        $sql = "SELECT * FROM members WHERE id = :id";
        $stmt = $connection->prepare($sql);

        // Bind les variables
        $stmt->bindParam(':id', $param_id, PDO::PARAM_INT);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Exécuter la requête
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            // Récupérer l'enregistrement
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Récupérer les champs
            $nom = $row["firstname"];
            $prenom = $row["lastname"];
            $parcours = $row["parcours"];
            $sexe = $row["sexe"];
            $birthdate = $row["birthdate"];
        } else {
            echo "Aucun enregistrement trouvé.";
            exit();
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        exit();
    }
} else {
    // Si pas de id correct, retourne la page d'erreur
    header("location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Read</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                    <h1 class="m-3 text-3xl text-center">&Agrave; propos de l'&eacute;tudiant</h1>
                    <div class="m-5">   
                        <div class="form-group">
                            <b><label>Nom : </label></b>
                            <?php echo htmlspecialchars($nom); ?>
                        </div>
                        <div class="form-group">
                            <b><label>Pr&eacute;nom : </label></b>
                            <?php echo htmlspecialchars($prenom); ?>
                        </div>
                        <div class="form-group">
                            <b><label>Parcours : </label></b>
                            <?php echo htmlspecialchars($parcours); ?>
                        </div>
                        <div class="form-group">
                            <b><label>Sexe : </label></b>
                            <?php echo htmlspecialchars($sexe); ?>
                        </div>
                        <div class="form-group">
                            <b><label>Date de naissance</label></b>
                            <?php echo htmlspecialchars($birthdate); ?>
                        </div>
                    </div>
                    <div class="flex justify-center mt-4">
                        <a href="profile.php" class="btn btn-primary">Retour</a>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
