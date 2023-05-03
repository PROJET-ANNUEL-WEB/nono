<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="admin.css?<?php echo time(); ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Modifier un utilisateur</title>
</head>
<body>
    

<body>
    <div class="container">
        <div class="row">
            <h1>Modifier un utilisateur</h1>

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

<form class="form2" method="post" action="modifier_frais.php">
    <label class="form-label zoe" for="idType">Type</label>
    <input type="text" class="form-control zoe2" name="idType" value="<?=$result['idType']?>">

    <label class="form-label zoe" for="Montant">Prix</label>
    <input type="text" class="form-control zoe2" name="Montant" value="<?=$result['Montant']?>">

    <label class="form-label zoe" for="Date_de_frais">Date</label>
    <input type="text" class="form-control zoe2" name="Date_de_frais" value="<?=$result['Date_de_frais']?>">

    <label class="form-label zoe" for="objet">Objet</label>
    <input type="text" class="form-control zoe2" name="objet" value="<?=$result['objet']?>">

  

     <input type="hidden" name="ID_Frais" value="<?php echo $result['ID_Frais']; ?>">

    <button type="submit" name="submit">Enregistrer</button>
</form>
</body>
</html>