<?php

// On crée une nouvelle instance PDO pour se connecter à la base de données MySQL
$db = new PDO('mysql:host=localhost;dbname=projetannuel;charset=utf8', 'root', '');

// On vérifie si les champs de formulaire requis (email, mot_de_passe, ID_Role, Nom et Prenom) ont été soumis via la méthode POST

if (isset($_POST['email']) && isset($_POST['mot_de_passe']) && isset($_POST['ID_Role']) && isset($_POST['Nom']) && isset($_POST['Prenom'])) {

    // On récupère les valeurs des champs soumis
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $ID_Role = $_POST['ID_Role'];
    $Nom = $_POST['Nom'];
    $Prenom = $_POST['Prenom'];

    // On prépare une requête SQL pour mettre à jour les informations de l'utilisateur dans la base de données
    $stmt = $db->prepare("UPDATE utilisateur SET email=:email, mot_de_passe=:mot_de_passe, Nom=:Nom, Prenom=:Prenom WHERE ID_Role=:ID_Role");

    // On lie les paramètres de la requête aux variables correspondantes
    $stmt->bindParam(':mot_de_passe', $mot_de_passe);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':Prenom', $Prenom);
    $stmt->bindParam(':Nom', $Nom);
    $stmt->bindParam(':ID_Role', $ID_Role);

    // On exécute la requête
    $stmt->execute();

    // On affiche un message de succès
    echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Modification réussie</strong>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}
// Si les champs de formulaire requis n'ont pas été soumis via POST, on vérifie si l'ID_Role est passé via la méthode GET
elseif (isset($_GET['ID_Role'])) {
    // On récupère la valeur de l'ID_Role
    $ID_Role = $_GET['ID_Role'];

    // On prépare une requête SQL pour récupérer les informations de l'utilisateur correspondant à l'ID_Role
    $stmt = $db->prepare("SELECT email, mot_de_passe, Nom, Prenom FROM utilisateur WHERE ID_Role=:ID_Role");

    // On lie le paramètre de la requête à la variable correspondante
    $stmt->bindParam(':ID_Role', $ID_Role);

    // On exécute la requête
    $stmt->execute();

    // On récupère le résultat de la requête sous forme de tableau associatif
    $result = $stmt->fetch();

    // On assigne les valeurs récupérées aux variables correspondantes
    $email = $result['email'];
    $mot_de_passe = $result['mot_de_passe'];
    $Nom = $result['Nom'];
    $Prenom = $result['Prenom'];

    // On redirige vers la page des utilisateurs enregistrés
    header('Location: pagecommercial.php');
    exit();
?>

    <form method="POST" action="modifier_utilisateur.php">
        <input type="hidden" name="ID_Role" value="<?= $ID_Role ?>">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>">
        </div>
        <div class="mb-3">
            <label for="mot_de_passe" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" value="<?= $mot_de_passe ?>">
        </div>
        <div class="mb-3">
            <label for="Nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="Nom" name="Nom" value="<?= $Nom ?>">
        </div>
        <div class="mb-3">
            <label for="Prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="Prenom" name="Prenom" value="<?= $Prenom ?>">
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>

<?php
} else {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Erreur:</strong> ID_Role manquant.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
?>
</body>

</html>