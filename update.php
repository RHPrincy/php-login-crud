<?php
// Vérifiez si le paramètre id existe
if (isset($_GET["i"]) && !empty(trim($_GET["i"]))) {
    $user_id = trim($_GET["i"]);
    

    try {
        // Connexion à la base de données
        require_once 'config.php';
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête
        $sql = "SELECT * FROM members WHERE id = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
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
    header("location: profile.php");
    exit();
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_nom = trim($_POST["firstname"]);
    $new_prenom = trim($_POST["lastname"]);
    $new_parcours = trim($_POST["parcours"]);
    $new_sexe = trim($_POST["sexe"]);
    $new_birthdate = trim($_POST["birthdate"]);

    try {
        $sql = "UPDATE members SET firstname = :firstname, lastname = :lastname, parcours = :parcours, sexe = :sexe, birthdate = :birthdate WHERE id = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':firstname', $new_nom);
        $stmt->bindParam(':lastname', $new_prenom);
        $stmt->bindParam(':parcours', $new_parcours);
        $stmt->bindParam(':sexe', $new_sexe);
        $stmt->bindParam(':birthdate', $new_birthdate);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: profile.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'enregistrement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <h1 class="mt-5 mb-3">Modifier l'enregistrement</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?i=" . $user_id; ?>" method="post">
                <div class="form-group">
                    <label for="firstname">Nom</label>
                    <input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo htmlspecialchars($nom); ?>" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Prénom</label>
                    <input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo htmlspecialchars($prenom); ?>" required>
                </div>
                <div class="form-group">
                    <label for="parcours">Parcours</label>
                    <select name="parcours" id="parcours" class="form-control" required>
                        <option value="mit" <?php echo ($parcours == 'mit') ? 'selected' : ''; ?>>MIT</option>
                        <option value="misa" <?php echo ($parcours == 'misa') ? 'selected' : ''; ?>>MISA</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sexe">Sexe</label><br>
                    <input type="radio" id="masculin" name="sexe" value="masculin" <?php echo ($sexe == 'masculin') ? 'checked' : ''; ?>>
                    <label for="masculin">Masculin</label>
                    <input type="radio" id="feminin" name="sexe" value="feminin" <?php echo ($sexe == 'feminin') ? 'checked' : ''; ?>>
                    <label for="feminin">Féminin</label>
                </div>
                <div class="form-group">
                    <label for="birthdate">Date de naissance</label>
                    <input type="date" name="birthdate" id="birthdate" class="form-control" value="<?php echo htmlspecialchars($birthdate); ?>" required>
                </div>
                <div class="form-group mt-3">
                    <input type="submit" class="btn btn-primary" value="Mettre à jour">
                    <a href="profile.php" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
