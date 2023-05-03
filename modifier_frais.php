<?php

if (isset($_POST['modification'])) {
    // Récupération des données du formulaire
    $Date_de_frais = $_POST['Date_de_frais'];
    $Montant = $_POST['Montant'];
    $objet = $_POST['objet'];
    $category = $_POST['idType'];
    $ID_utilisateur = $_POST['ID_utilisateur'];

    // Connexion à la base de données
    $dbh = new PDO('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', '');

    // Préparation de la requête SQL de mise à jour
    $stmt = $dbh->prepare('UPDATE frais SET Date_de_frais = :Date_de_frais, Montant = :Montant, objet = :objet, ID_utilisateur = :ID_utilisateur, idType = :category WHERE ID_Frais = :ID_Frais');
    $stmt->bindParam(':Montant', $Montant);
    $stmt->bindParam(':objet', $objet);
    $stmt->bindParam(':Date_de_frais', $Date_de_frais);
    $stmt->bindParam(':idType', $category);
    $stmt->bindParam(':ID_utilisateur', $ID_utilisateur);

    // Exécuter la requête SQL
    if ($stmt->execute()) {
        // echo "Les modifications ont été enregistrées avec succès.";
        header('Location: pagecommercial.php');
    } else {
        echo "Erreur lors de l'enregistrement des modifications.";
    }
}
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Modifier un frais</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <h1>Modifier un frais</h1>

            <?php
            $ID_Frais = $_POST['ID_Frais'];

            $dbh = new PDO('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', '');

            $stmt = $dbh->prepare('SELECT ID_Frais, Date_de_frais, Montant, objet, ID_utilisateur, idType FROM frais WHERE ID_Frais = :ID_Frais');
            $stmt->bindParam(':ID_Frais', $ID_Frais);
            $stmt->execute();
            $frais = $stmt->fetch(PDO::FETCH_ASSOC);

            // Begin the form outside of the foreach loop
            echo '<form action="" method="post" class="form-group">';
            ?>
            <div class="mb-3">
                <!-- <label for="ID_Frais" class="form-label">Email</label> -->
                <input type="hidden" name="ID_Frais" class="form-control" id="ID_Frais" aria-describedby="emailHelp" value="<?php echo $frais['ID_Frais']; ?>">
            </div>

            <div class="mb-3">
                <label for="ID_Role" class="form-label">Numéro de Rôle</label>
                <input type="text" name="Date_de_frais" class="form-control" id="Date_de_frais" aria-describedby="emailHelp" value="<?php echo $frais['Date_de_frais']; ?>">
            </div>
            <div class="mb-3">
                <label for="Montant" class="form-label">Montant</label>
                <input type="text" name="Montant" class="form-control" id="Montant" value="<?php echo $frais['Montant']; ?>">
            </div>

            <div class="mb-3">
                <label for="objet" class="form-label">Objet</label>
                <input type="text" name="objet" class="form-control" id="objet" value="<?php echo $frais['objet']; ?>">
            </div>

            <div class="mb-3">
                <label for="idType" class="form-label">Catégorie</label>
                <input type="text" name="idType" class="form-control" id="idType" aria-describedby="emailHelp" value="<?php echo $frais['idType']; ?>">
            </div>

            <div class="mb-3">
                <label for="ID_utilisateur" class="form-label">Catégorie</label>
                <input type="hidden" name="ID_utilisateur" class="form-control" id="ID_utilisateur" aria-describedby="emailHelp" value="<?php echo $frais['ID_utilisateur']; ?>">
            </div>

            <input type="submit" class="btn btn-primary" value="Mettre à jour" name="modification" id="modification"></input>

            <?php
            // Close the form after the foreach loop
            echo '</form>';
            ?>

        </div>
    </div>
</body>

</html>