<?php
// Connexion à la base de données
$base = new PDO('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', '');

// Vérification de l'adresse e-mail de l'utilisateur à supprimer
if (isset($_POST['Montant'])) {
    $Montant = $_POST['Montant'];

    // Vérification si l'utilisateur existe dans la base de données
    $objet = $base->query("SELECT * FROM frais WHERE Montant = '$Montant'")->fetch();
    if ($objet) {
        // Suppression de l'utilisateur
        $base->query("DELETE FROM frais WHERE Montant = '$Montant'");

        // Redirection vers la page des utilisateurs enregistrés
        header('Location: pagecommercial.php');
        exit();
    }
}
?>