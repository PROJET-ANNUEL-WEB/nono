<?php
$db = new PDO('mysql:host=localhost;dbname=projetannuel;charset=utf8', 'root', '');
if (isset($_POST['email']) && isset($_POST['mot_de_passe']) && isset($_POST['ID_Role']) && isset($_POST['Nom']) && isset($_POST['Prenom'])) {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $ID_Role = $_POST['ID_Role'];
    $Nom = $_POST['Nom'];
    $Prenom = $_POST['Prenom'];

    $stmt = $db->prepare("UPDATE utilisateur SET email=:email, mot_de_passe=:mot_de_passe, Nom=:Nom, Prenom=:Prenom WHERE ID_Role=:ID_Role");
    $stmt->bindParam(':mot_de_passe', $mot_de_passe);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':Prenom', $Prenom);
    $stmt->bindParam(':Nom', $Nom);
    $stmt->bindParam(':ID_Role', $ID_Role);

    $stmt->execute();

    echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Modification réussie</strong>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
} elseif (isset($_GET['ID_Role'])) {
    $ID_Role = $_GET['ID_Role'];

    $stmt = $db->prepare("SELECT email, mot_de_passe, Nom, Prenom FROM utilisateur WHERE ID_Role=:ID_Role");
    $stmt->bindParam(':ID_Role', $ID_Role);
    $stmt->execute();
    $result = $stmt->fetch();

    $email = $result['email'];
    $mot_de_passe = $result['mot_de_passe'];
    $Nom = $result['Nom'];
    $Prenom = $result['Prenom'];
?>

    <form method="POST" action="">
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