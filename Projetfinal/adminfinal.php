<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="admin.css?<?php echo time(); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrateur</title>
    <?php
                        if(isset($_SESSION['Nom'])){
                            $Nom= $_SESSION['Nom'];
                        }
    ?>
        <h1>Bonjour <?php echo $Nom; ?>, vous êtes l'admin</h1> 
        <nav class="navMenu">
      <a href="#"></a>
  
      <a href="pageadminrole.php">Rôles</a>
      <a href="pageadminfrais">Frais</a>
      <div class="dot"></div>
    </nav>
</head>
<body>
   
    <div class="container">
<h3>Enregistrer un utilisateur</h3>
    <div class="row">
        <form action="pageadmin.php" method="post">
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
    if (isset($_POST['email']) && isset($_POST['mot_de_passe']) && isset($_POST['ID_Role']) && isset($_POST['Nom']) && isset($_POST['Prenom'])){
        $email = $_POST['email'];
        $mot_de_passe = $_POST['mot_de_passe'];
        $ID_Role = $_POST['ID_Role'];
        $Nom = $_POST['Nom'];
        $Prenom = $_POST['Prenom'];

        $db = new PDO('mysql:host=localhost;dbname=projetannuel;charset=utf8', 'root', '');

        $stmt = $db->prepare("INSERT INTO utilisateur (email, mot_de_passe, Nom, Prenom,ID_Role) VALUES (:email, :mot_de_passe, :Nom, :Prenom, :ID_Role)");
        $stmt->bindParam(':mot_de_passe', $mot_de_passe);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':Prenom', $Prenom);
        $stmt->bindParam(':Nom', $Nom);
        $stmt->bindParam(':ID_Role', $ID_Role);

        $stmt->execute();

        echo "<script> alert('Utilisateur bien ajoute') </script>";

}
?>


</form>

                </form>
                <section id="content">
<div class="container autumn-text  ">
            <h3>Utilisateurs enregistré récemments</h3>
        <table id="table1" class="autumn-text1 tableuser" style="width: 100%">
            <thead>
                <tr class="tableuser">
                    <th scope="col">Email</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Rôle</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Désactiver</th>
                </tr>
            </thead>
            <tbody>
            <?php

$base = new PDO ('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', '');

$donnees = $base->query("SELECT email ,  Nom, Prenom, ID_Role FROM utilisateur")->fetchAll();



    foreach ($donnees as $row) {
        if ($row['email'] != NULL) {
    ?>
            <tr>
                <td><h5><?=$row['email'];?></h5></td>
                <td><h5><?=$row['Nom']?></h5></td>
                <td><h5><?=$row['Prenom']?></h5></td>
                <td><h5><?=$row['ID_Role']?></h5></td>
                <td>
                    <form method="post" action="modifier_utilisateur.php">
                        <input type="hidden" name="email" value="<?=$row['email']?>">
                        <button type="submit border-none" class="glyphicon glyphicon-pencil"></button>
                    </form>
                </td>
                <td>
                    <form method="post" action="supprimer_utilisateur.php">
                        <input type="hidden" name="email" value="<?=$row['email']?>">
                        <button type="submit border-none" class="glyphicon glyphicon-trash"></button>
                    </form>
                </td>
            </tr>
    <?php
        }
    }
    ?>

                    </section>

                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>


  <script src="https://code.jquery.com/jquery-3.6.3.min.js"integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <script type="text/javascript" src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
<script type="text/javascript">
$(document).ready( function () {
    $('#table1').DataTable( {
        "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    } );
} );
</script>

</body>

</html>


