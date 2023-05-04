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



    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrateur frais</title>

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
    }
  ?>
    
</header>
   <body>
<div class="container3">
<section id="content">
            <h1>FRAIS A TRAITER</h1>
        <table id="table1" class="tableuser hover autumn-text1  table-margin" style="width: 100%">
            <thead>
                <tr class="tableuser">
                    <th scope="col">ID_frais</th>
                    <th scope="col">Créateur</th>
                    <th scope="col">Type</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Date</th>
                    <th scope="col">Objet</th>
                    <th scope="col">Choisir Etat</th>
                    
                </tr>
            </thead>
            <tbody>

                <?php

                $base = new PDO ('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', '');

                $donnees = $base->query("SELECT utilisateur.Nom ,frais.ID_frais, type_de_frais.Type_de_frais , frais.Date_de_frais , frais.Montant , frais.objet , etat_du_frais.IdEtat FROM frais JOIN utilisateur ON frais.ID_utilisateur=utilisateur.ID_utilisateur JOIN Type_de_frais ON frais.IDType=Type_de_frais.IDType JOIN etat_du_frais ON frais.IdEtat=etat_du_frais.IdEtat ORDER BY frais.Date_de_frais DESC")->fetchAll();


                foreach ($donnees as $row) {

                    if ($row['IdEtat']== 3) {
                    
                        ?>
                        <tr>
                            <td><h5><?=$row['ID_frais'];?></h5></td>
                            <td><h5><?=$row['Nom'];?></h5></td>
                            <td><h5><?=$row['Type_de_frais']?></h5></td>
                            <td><h5><?=$row['Montant']?></h5></td>
                            <td><h5><?=$row['Date_de_frais']?></h5></td>
                            <td><h5><?=$row['objet']?></h5></td>                          
                            <!-- Ajoutez le code suivant dans votre boucle foreach -->

                            <td>
    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal<?=$row['ID_frais']?>">Modifier l'état</button>
    <div class="modal fade" id="modal<?=$row['ID_frais']?>" tabindex="-1" role="dialog" aria-labelledby="modal<?=$row['ID_frais']?>Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal<?=$row['ID_frais']?>Label">Modifier l'état du frais</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Choisissez le nouvel état du frais :</p>
                    <form method="post" action="etatfraisadmin.php">
                        <input type="hidden" name="ID_frais" value="<?=$row['ID_frais']?>">
                        <button type="submit" name="nouvel_etat" value="1" class="btn btn-success">Validé</button>
                        <button type="submit" name="nouvel_etat" value="3" class="btn btn-info">En attente</button>
                        <button type="submit" name="nouvel_etat" value="2" class="btn btn-warning">Refusé</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</td>

                      
                        </tr>
                <?php
                    

                    }
           
                }
                                    
                ?>
            </tbody>
        </table> 
    
            <h1>FRAIS DEJA TRAITES</h1>
         <table id="table2" class=" tableuser hover autumn-text1" style="width: 100%">
             <thead>
                 <tr class="tableuser">
                     <th scope="col">Créateur</th>
                     <th scope="col">Type</th>
                     <th scope="col">Prix</th>
                     <th scope="col">Date</th>
                     <th scope="col">Objet</th> 
                     <th scope="col">Etat</th>
                     <th></th>

             </thead>
             <tbody>

             <?php

$base = new PDO ('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', '');

$donnees = $base->query("SELECT utilisateur.Nom ,frais.ID_frais, type_de_frais.Type_de_frais , frais.Date_de_frais , frais.Montant , frais.objet , etat_du_frais.IdEtat FROM frais JOIN utilisateur ON frais.ID_utilisateur=utilisateur.ID_utilisateur JOIN Type_de_frais ON frais.IDType=Type_de_frais.IDType JOIN etat_du_frais ON frais.IdEtat=etat_du_frais.IdEtat ORDER BY frais.Date_de_frais DESC")->fetchAll();

foreach ($donnees as $row) {
    if ($row['IdEtat'] != 3) {
?>
    <tr>
        <td><h5><?=$row['Nom'];?></h5></td>
        <td><h5><?=$row['Type_de_frais']?></h5></td>
        <td><h5><?=$row['Montant']?></h5></td>
        <td><h5><?=$row['Date_de_frais']?></h5></td>
        <td><h5><?=$row['objet']?></h5></td>
        <?php
            if ($row['IdEtat']== 1)  { ?>
                <td colspan="2"><a href="valid_frais.php?id=<?=$row['ID_frais']?>" class="glyphicon glyphicon-thumbs-up"><img width=30px height=auto></a></td>
            <?php } else if($row['IdEtat']== 2) { ?>
                <td colspan="2"><a href="valid_frais.php?id=<?=$row['ID_frais']?>" class="glyphicon glyphicon-thumbs-down"><img width=30px height=auto></a></td>
            <?php }
        ?>
        <td>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal<?=$row['ID_frais']?>">Modifier l'état</button>
            <div class="modal fade" id="modal<?=$row['ID_frais']?>" tabindex="-1" role="dialog" aria-labelledby="modal<?=$row['ID_frais']?>Label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal<?=$row['ID_frais']?>Label">Modifier l'état du frais</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Choisissez le nouvel état du frais :</p>
                            <form method="post" action="etatfraisadmin.php">
                                <input type="hidden" name="ID_frais" value="<?=$row['ID_frais']?>">
                                <button type="submit" name="nouvel_etat" value="1" class="btn btn-success">Validé</button>
                                <button type="submit" name="nouvel_etat" value="3" class="btn btn-info">En attente</button>
                                <button type="submit" name="nouvel_etat" value="2" class="btn btn-warning">Refusé</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
<?php
    }
}

?>
            </tbody>
        </table> 
    
</div>

            </section>


            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>


  <script src="https://code.jquery.com/jquery-3.6.3.min.js"integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <script type="text/javascript" src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
  $('#table1').DataTable({
    "paging": true,
    "language": {
      "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
    }
  }).column(0).visible(false);
});

</script>

<script type="text/javascript">
$(document).ready(function() {
  $('#table2').DataTable({
    "paging": true,
    "language": {
      "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
    }
  });
});

</script>

                    <div class="container5">
                    <form class="form2" action="pageadminfrais.php" method="post">
                    <h3>Ajouter un nouveau type de Frais</h3>
                        
                            

                    <div>
                        <label for="idType" class="form-label">Numéro du type de Frais</label>
                        <input type="text" name="idType" class="form-control" id="idType">
                    </div>



                    <div>
                        <label for="Type_de_frais" class="form-label">Nom du nouveau type de Frais</label>
                        <input type="text" name="Type_de_frais" class="form-control" id="Type_de_frais">
                    </div>

                    <p><em>Pensez à regarder les frais déjà existant afin d'éviter les doublons</em></p>


                    <input type="submit" class="btn btn-primary" value="Enregistrer"></input>

                <?php
                    if (isset($_POST['idType']) && isset($_POST['Type_de_frais'])){
                        $idType = $_POST['idType'];
                        $Type_de_frais = $_POST['Type_de_frais'];

                        $db = new PDO('mysql:host=localhost;dbname=projetannuel;charset=utf8', 'root', '');

                        $stmt = $db->prepare("INSERT INTO type_de_frais (idType, Type_de_frais) VALUES (:idType, :Type_de_frais)");
                        $stmt->bindParam(':idType', $idType);
                        $stmt->bindParam(':Type_de_frais', $Type_de_frais);

                        $stmt->execute();

                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Role bien enregistré</strong> .
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                }
                ?>
</form>


                     
                        <section id="content">
                        <div class="container3 autumn-text  ">
                            <h3>Types de frais déja enregistrés</h3>
                        <table id="table1" class="autumn-text1 tableuser" style="width: 100%">
                            <thead>
                                <tr class="tableuser">
                                    <th scope="col">Numéro de Frais</th>
                                    <th scope="col">Type de Frais</th>
                                   <!-- <th scope="col">Modifier</th>
                                    <th scope="col">Supprimer</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                $base = new PDO ('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', '');

                $donnees = $base->query("SELECT idType, Type_de_frais FROM type_de_frais")->fetchAll();


                
                    foreach ($donnees as $row) {
                        if ($row['idType'] != NULL) {
                    ?>
                            <tr>
                                <td><h5><?=$row['idType'];?></h5></td>
                                <td><h5><?=$row['Type_de_frais']?></h5></td>
                              <!--  <td>
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
                        </tbody>
                    </table>
                </section>
                
           
           </div>


                <br>



<!-- inclure les fichiers CSS de Bootstrap -->

<!-- inclure les fichiers CSS personnalisés -->


<!-- inclure la bibliothèque jQuery -->

</body>


</body>


</html>







