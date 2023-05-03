<?php
//  <input type="hidden" name="email" value="<?= $utilisateur['email']  

if (isset($_POST['modif'])) {
    // Récupération des données du formulaire
    $ID_Role = $_POST['ID_Role'];
    $Nom = $_POST['Nom'];
    $Prenom = $_POST['Prenom'];
    $email = $_POST['email'];

    // Connexion à la base de données
    $dbh = new PDO('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', '');

    // Préparation de la requête SQL de mise à jour
    $stmt = $dbh->prepare('UPDATE utilisateur SET email = :email, Nom = :Nom, Prenom = :Prenom, ID_Role = :ID_Role WHERE email = :email');
    $stmt->bindParam(':Nom', $Nom);
    $stmt->bindParam(':Prenom', $Prenom);
    $stmt->bindParam(':ID_Role', $ID_Role);
    $stmt->bindParam(':email',  $email);

    /* // Exécution de la requête SQL de mise à jour
    $stmt->execute();

    // Redirection vers une autre page pour afficher un message de confirmation
    header('Location: pageadmin.php');
    exit(); */

    // Exécuter la requête SQL
    if ($stmt->execute()) {
        // echo "Les modifications ont été enregistrées avec succès.";
        header('Location: pageadmincopie.php');
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="admin.css?<?php echo time(); ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Modifier un utilisateur</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <h1>Modifier un utilisateur</h1>

            <?php
            $email = $_POST['email'];

            $dbh = new PDO('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', '');

            $stmt = $dbh->prepare('SELECT email, Nom,Prenom,ID_Role FROM utilisateur WHERE email = :email');
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

            // Begin the form outside of the foreach loop
            echo '<form action="" method="post" class="form-group">';

            ?>
            <form method="post" action="modifier_utilisateur.php">
            <div class="mb-3">
                <label for="email" class="form-label zoe">Email</label>
                <input type="email" readonly name="email" class="form-control zoe2" id="email" aria-describedby="emailHelp" value="<?php echo $utilisateur['email']; ?>">
            </div>

            <div class="mb-3">
                <label for="ID_Role" class="form-label zoe">Numéro de Rôle</label>
                <input type="ID_Role" name="ID_Role" class="form-control zoe2" id="Numéro de rôle" aria-describedby="emailHelp" value="<?php echo $utilisateur['ID_Role']; ?>">
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label zoe">Nom</label>
                <input type="text" name="Nom" class="form-control zoe2" id="nom" value="<?php echo $utilisateur['Nom']; ?>">
            </div>

            <div class="mb-3">
                <label for="prenom" class="form-label zoe">Prénom</label>
                <input type="text" name="Prenom" class="form-control zoe2" id="prenom" value="<?php echo $utilisateur['Prenom']; ?>">
            </div>

            <input type="submit" class="button" value="Mettre à jour" name="modif" id="modif"></input>

            <?php
            // Close the form after the foreach loop
            echo '</form>';
            ?>

        </div>
    </div>
</form>
</body>

</html>