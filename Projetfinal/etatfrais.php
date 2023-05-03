<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $idFrais = $_POST["ID_frais"];
    $nouvelEtat = $_POST["nouvel_etat"];

    // Mettre à jour l'état du frais dans la base de données
    $base = new PDO('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', '');
    $requete = $base->prepare("UPDATE frais SET IdEtat = :nouvelEtat WHERE ID_frais = :idFrais");
    $requete->execute(array(":nouvelEtat" => $nouvelEtat, ":idFrais" => $idFrais));

    // Rediriger vers la page de liste des frais
    header("Location: pagecompta.php");
    exit();
}

?>