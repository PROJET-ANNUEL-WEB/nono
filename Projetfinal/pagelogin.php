<?php

session_start(); 

?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="enregistrement.css" rel="stylesheet" id="bootstrap-css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

    <title>Page login</title>
</head>

<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="logoMW.png" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                <form action="pagelogin.php" method="post">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input name="email" type="text" class="form-control input_user" id="email" value="" placeholder="Adresse mail">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="mot_de_passe" class="form-control input_pass" id="mot_de_passe" value="" placeholder="Mot de passe">
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customControlInline">
                                <label class="custom-control-label" for="customControlInline">Remember me</label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <input type="submit" class="btn btn-primary login_btn" value="Se connecter">

                            <!--<button type="submit" name="button" class="btn login_btn">Login</button> -->
                        </div>
                </div>

                <div class="mt-4">
                    <div class="d-flex justify-content-center links">
                        Pas d'identifiant ? <a href="mailto:?to=admin@entreprise.com &subject=Identifiant%20non%20enregistré &body=Bonjour,%20mes%20identifiants%20n'ont%20pas%20été%20saisi." class="ml-2">Contacter un admin</a>
                    </div>
                    <div class="d-flex justify-content-center links">
                        <a href="mailto:?to=admin@entreprise.com &subject=Identifiant%20oublié &body=Bonjour,%20j'ai%20oublié%20mon%20mot%20de%20passe.">Mot de passe oublié?</a> 
                    </div>
                </div>
            </div>
        </div>
    </div>


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
        $ID_Role = $row['ID_Role'];
        $Nom = $row['Nom'];
        $_SESSION['ID_utilisateur'] = $ID_utilisateur;
        $_SESSION['Nom'] = $Nom;
        if ($ID_Role == 1) {
            header("Location: pageadmin.php");
        } elseif ($ID_Role == 2) {
            header("Location: pagecompta.php");
        } elseif ($ID_Role == 3) {
            header("Location: pagesalarie.php");
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

