<?php
// Connexion à la base de données
$base = new PDO('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', '');

// Vérification de l'adresse e-mail de l'utilisateur à désactiver
if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Vérification si l'utilisateur existe dans la base de données
    $utilisateur = $base->query("SELECT * FROM utilisateur WHERE email = '$email'")->fetch();
    if ($utilisateur) {
        // Mise à jour de l'état de l'utilisateur à "désactivé"
        $base->query("UPDATE utilisateur SET ID_Etat = 1 WHERE email = '$email'");

        // Redirection vers la page des utilisateurs enregistrés
        header('Location: pageadmincopie.php');
        exit();
    }
}
