
<?php
// Connexion à la base de données
$base = new PDO('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', '');

// Vérification de l'adresse e-mail de l'utilisateur à supprimer
if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Vérification si l'utilisateur existe dans la base de données
    $utilisateur = $base->query("SELECT * FROM utilisateur WHERE email = '$email'")->fetch();
    if ($utilisateur) {
        // Suppression de l'utilisateur
        $base->query("DELETE FROM utilisateur WHERE email = '$email'");

        // Redirection vers la page des utilisateurs enregistrés
        header('Location: pageadmin.php');
        exit();
    }
}
