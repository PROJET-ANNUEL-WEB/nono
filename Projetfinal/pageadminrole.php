<?php
session_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>



<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 <link href="admin.css?<?php echo time(); ?>" rel="stylesheet">
</head>


<header>
  <nav>
    <ul>
    <li><a class="sabrille" href="pageadmincopie.php">Utilisateurs</a></li>
      <li><a class="sabrille" href="pageadminrole.php">Rôles</a></li>
      <li><a class="sabrille" href="pageadminfrais.php">Frais</a></li>
    </ul>
  </nav>
  <?php
      if (isset($_SESSION['nom_utilisateur'])) {
          $nom_utilisateur = $_SESSION['nom_utilisateur'];
          echo "<p class='rulio'>Bonjour Mr $nom_utilisateur</p>";
      }
    ?>
    
</header>
            
 <body>
<div class="container6">
    <div class="row">
<h3>Ajouter un nouveau Rôle</h3>
    
        <form  class="form2" action="pageadminrole.php" method="post">

            <div class="mb-3">
                <label for="IDRole" class="form-label zoe">Numéro de Rôle</label>
                <input type="text" name="ID_Role" class="form-control" id="IDRole">
            </div>

            <div class="mb-3">
                <label for="Type_de_role" class="form-label zoe">Nom du Rôle</label>
                <input type="text" name="Type_de_role" class="form-control" id="Type_de_role">
            </div>


            <input type="submit" class="btn btn-primary" value="Enregistrer"></input>

<?php
    if (isset($_POST['ID_Role']) && isset($_POST['Type_de_role'])){
        $ID_Role = $_POST['ID_Role'];
        $Type_de_role = $_POST['Type_de_role'];

        $db = new PDO('mysql:host=localhost;dbname=projetannuel;charset=utf8', 'root', '');

        $stmt = $db->prepare("INSERT INTO roles (ID_Role, Type_de_role) VALUES (:ID_Role, :Type_de_role)");
        $stmt->bindParam(':ID_Role', $ID_Role);
        $stmt->bindParam(':Type_de_role', $Type_de_role);

        $stmt->execute();

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Role bien enregistré</strong> .
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}
?>


</form>
 <section id="content">
<div class="container autumn-text  ">
            <h3>Rôles enregistrés</h3>
        <table id="table1" class="autumn-text1 tableuser" style="width: 100%">
            <thead>
                <tr class="tableuser">
                    <th scope="col">Numéro de Rôle</th>
                    <th scope="col">Type de Rôle</th>
           <!--         <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th> -->
                </tr>
            </thead>
            <tbody>
            <?php

                $base = new PDO ('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', '');

                $donnees = $base->query("SELECT ID_Role, Type_de_role FROM roles")->fetchAll();


                
                    foreach ($donnees as $row) {
                        if ($row['ID_Role'] != NULL) {
                    ?>
                            <tr>
                                <td><h5><?=$row['ID_Role'];?></h5></td>
                                <td><h5><?=$row['Type_de_role']?></h5></td>
                  <!--              <td>
                                    <form method="post" action="supprimer_utilisateur.php">
                                        <input type="hidden" name="email" value="<?=$row['email']?>">
                                        <button type="submit border-none" class="glyphicon glyphicon-pencil"></button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="supprimer_utilisateur.php">
                                        <input type="hidden" name="email" value="<?=$row['email']?>">
                                        <button type="submit border-none" class="glyphicon glyphicon-trash"></button>
                                    </form>
                                </td> -->
                            </tr>
                    <?php
                        }
                    }
                    ?>

                    </section>


</body>

</html>