<?php

session_start(); 


?>



<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Connexion</title>
    <link rel="stylesheet" href="stylesheet.css">


</head>
<body>
<div class="container">
<h1>Se connecter :</h1>
    <div class="row">    
    <form action="pagelogin.php" method="post">
    <div class="mb-3"> 
        <label for="email" class="form-label">Email </label>
        <input name="email" type="text" class="form-control" id="email" aria-describedby="emailHelp">            
    </div>

    <div class="mb-3">
        <label for="mot_de_passe" class="form-label">Mot De Passe</label>
        <input type="password" name="mot_de_passe" class="form-control" id="mot_de_passe" aria-describedby="passwordHelp">
    </div>

        <input type="submit" class="btn btn-primary" value="Se connecter">

        <button> <a class="nav-link mx-2 active" href="mailto:?to=admin@entreprise.com &subject=Identifiant%20non%20enregistré &body=Bonjour,%20mes%20identifiants%20n'ont%20pas%20été%20saisi."> Si vous n'avez pas d'identifiant </a> </button>
<?php
//Validation du formulaire
if (isset($_POST['email']) && isset($_POST['mot_de_passe'])) {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $db = new PDO('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', '');

    $stmt = $db->prepare("SELECT * FROM utilisateur WHERE email = :email AND mot_de_passe = :mot_de_passe");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mot_de_passe', $mot_de_passe);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $ID_utilisateur = $row['ID_utilisateur'];
        $ID_role = $row['ID_Role'];
        $_SESSION['ID_utilisateur'] = $ID_utilisateur;
        if ($ID_role == 1) {
            header("Location: pageadmin.php");
        } elseif ($ID_role == 2) {
            header("Location: pagecompta.php");
        } elseif ($ID_role == 3) {
            header("Location: pagecommercial.php");
        }
    } else {
        // Pour afficher un message d'alerte si la connexion est impossible
        echo '<div class="alert alert-danger" role="alert"> Connexion impossible, êtes vous inscrit ? <a href="mailto:?to=admin@entreprise.com &subject=Identifiant%20non%20enregistré &body=Bonjour,%20mes%20identifiants%20n ont%20pas%20été%20saisi."> Si vous n avez pas d identifiant </a>. Cliquez pour vous inscrire. </div>';
    }
}
?>
</body>     
</form>
</html>

