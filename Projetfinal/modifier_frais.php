<!DOCTYPE html>
<html lang="en">
<head>
<link href="modifrais.css?<?php echo time(); ?>" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


<?php
session_start();

if (!isset($_SESSION['ID_utilisateur'])) {
    header("Location: pagecommercia1.php");
    exit();
}

if (!isset($_POST['ID_Frais'])) {
    header("Location: pagecommercia1.php");
    exit();
}

$ID_Frais = $_POST['ID_Frais'];
$pdo = new PDO ('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', '');

$sql = "SELECT * FROM frais WHERE ID_Frais = :ID_Frais AND ID_utilisateur = :ID_utilisateur";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':ID_Frais', $ID_Frais);
$stmt->bindParam(':ID_utilisateur', $_SESSION['ID_utilisateur']);
$stmt->execute();
$result = $stmt->fetch();

if (!$result) {
    header("Location: pagecommercia2.php");
    exit();
}

if (isset($_POST['submit'])) {
    $idType = $_POST['idType'];
    $Montant = $_POST['Montant'];
    $Date_de_frais = $_POST['Date_de_frais'];
    $objet = $_POST['objet'];
   

    $sql = "UPDATE frais SET idType = :idType, Montant = :Montant, Date_de_frais = :Date_de_frais, objet = :objet WHERE ID_Frais = :ID_Frais AND ID_utilisateur = :ID_utilisateur";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idType', $idType);
    $stmt->bindParam(':Montant', $Montant);
    $stmt->bindParam(':Date_de_frais', $Date_de_frais);
    $stmt->bindParam(':objet', $objet);
    $stmt->bindParam(':ID_Frais', $ID_Frais);
    $stmt->bindParam(':ID_utilisateur', $_SESSION['ID_utilisateur']);
    $stmt->execute();

    header("Location: pagesalarie.php");
    exit();
}
?>

<form method="post" action="modifier_frais.php">
    <label for="idType">Type</label>
    <input type="text" name="idType" value="<?=$result['idType']?>">

    <label for="Montant">Prix</label>
    <input type="text" name="Montant" value="<?=$result['Montant']?>">

    <label for="Date_de_frais">Date</label>
    <input type="text" name="Date_de_frais" value="<?=$result['Date_de_frais']?>">

    <label for="objet">Objet</label>
    <input type="text" name="objet" value="<?=$result['objet']?>">

  

     <input type="hidden" name="ID_Frais" value="<?php echo $result['ID_Frais']; ?>">

    <button type="submit" name="submit">Enregistrer</button>
</form>
</body>
</html>