<div class="container">
    <h3>Enregistrer un utilisateur</h3>
    <div class="row">
        <form action="modifier_utilisateurs.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="mot_de_passe" class="form-label">Mot de passe</label>
                <input name="mot_de_passe" type="text" class="form-control" id="mot_de_passe">
            </div>

            <div class="mb-3">
                <label for="IDRole" class="form-label">Numéro de Rôle</label>
                <input type="text" name="ID_Role" class="form-control" id="IDRole">
            </div>

            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="Nom" class="form-control" id="nom">
            </div>

            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" name="Prenom" class="form-control" id="prenom">
            </div>


            <input type="submit" class="btn btn-primary" value="Enregistrer"></input>


            <?php
            // Récupérer les données du formulaire
            $db = new PDO('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', '');

            $email = $_POST['email'];
            $Nom = $_POST['Nom'];
            $Prenom = $_POST['Prenom'];
            $ID_Role = $_POST['ID_Role'];

            // Mettre à jour l'utilisateur dans la base de données
            // (à remplacer avec votre code de mise à jour de la base de données)
            $sql = "UPDATE utilisateurs SET Nom='$Nom', Prenom='$Prenom', adresse='$adresse' WHERE email='$email'";
            $result = mysqli_query($db, $sql);

            // Rediriger vers la page des utilisateurs
            header("Location: pageadmin.php");
            exit();
            ?>