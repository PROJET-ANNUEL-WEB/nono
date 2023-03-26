<?php
session_start();

?>


<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Comptable</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
<link href="csscompta.css?<?php echo time(); ?>" rel="stylesheet">
<!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap.min.css">

</head>
<header>


<nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle navbar-toggle-sidebar collapsed">
                    MENU
                </button>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    Administrator
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <form class="navbar-form navbar-left" method="GET" role="search">
                    <div class="form-group">
                        <input type="text" name="q" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="http://www.pingpong-labs.com" target="_blank">Visit Site</a></li>
                    <li class="dropdown ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Account
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-header">SETTINGS</li>
                            <li class=""><a href="#">Other Link</a></li>
                            <li class=""><a href="#">Other Link</a></li>
                            <li class=""><a href="#">Other Link</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
<body>

<form action="pagecommercial.php" method="post">
<?php
// Connexion à la base de données MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projetannuel";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérifiez si la connexion a réussi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_SESSION['ID_utilisateur'])){
    $ID_utilisateur = $_SESSION['ID_utilisateur'];
} 

// Vérifiez si le formulaire a été soumis
if (isset($_POST['btn'])) {
    // Récupération des données du formulaire
    $Date_de_frais = $_POST['Date_de_frais'];
    $Montant = $_POST['Montant'];
    $objet = $_POST['objet'];
    $category = $_POST['idType'];
    $ID_utilisateur = $_POST['ID_utilisateur'];
    
    // Insertion des données dans la base de données
    $sql = "INSERT INTO frais (Montant, Date_de_frais,  idType, ID_utilisateur, objet)
            VALUES  ('$Montant','$Date_de_frais', '$category', '$ID_utilisateur','$objet')";
          
          if (mysqli_query($conn, $sql)) {
            echo "Les données ont été insérées avec succès.";
        } else {
            echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

          
 

// Fermeture de la connexion à la base de données
mysqli_close($conn);
?>


<div class="container">
<h2>Formulaire de saisie de frais </h2>
<form action="#">
  <p><i>Complétez le formulaire. Les champs marqué par </i><em>*</em> sont <em>obligatoires</em></p>
  <fieldset>
    <legend></legend>
      <label for="Date_de_frais">Date de frais <em>*</em></label>

      <input id="Date_de_frais" type="date" name="Date_de_frais" placeholder="**/**/****" autofocus="" required=""><br>
      
      
    <label class="input-icon"for="Montant">Montant<em>*</em></label>
    
    <input id="Montant" type="decimal" name="Montant" placeholder="00,00"> <i>€</i><br>
   
  
     

    <label for="objet"> Objet <em>*</em></label>
    <input id="objet" type="objet" name="objet" placeholder="ex: Repas midi"><br>
    <input type="" name="ID_utilisateur" value="<?php echo $ID_utilisateur ?>">


 
  <fieldset>
  <select class="form-select" name="idType">
  <option value="1">Restaurant (1)</option>
  <option value="2">Hotel (2)</option>
  <option value="3">Transport (3)</option>
  <option value="4">Fournitures (4)</option>
</select>
  </fieldset>
  <p><input type="submit" value="Soummettre" name="btn"></p>
</form>
</div>
</form>




<section id="content">

        <div class="container autumn-text  ">
            <h1>FRAIS A TRAITER</h1>
        <table id="table1" class="autumn-text1" style="width: 100%">
            <thead>
                <tr>
                    <th scope="col">Créateur</th>
                    <th scope="col">Type</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Date</th>
                    <th scope="col">Objet</th>
                    <th scope="col">Valider</th>
                    <th scope="col">Refuser</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $base = new PDO ('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', '');

                $donnees = $base->query("SELECT utilisateur.Nom ,frais.ID_frais, type_de_frais.idType , frais.Date_de_frais , frais.Montant , frais.objet , etat_du_frais.IdEtat FROM frais JOIN utilisateur ON frais.ID_utilisateur=utilisateur.ID_utilisateur JOIN Type_de_frais ON frais.IDType=Type_de_frais.IDType JOIN etat_du_frais ON frais.IdEtat=etat_du_frais.IdEtat ORDER BY frais.Date_de_frais DESC")->fetchAll();


                foreach ($donnees as $row) {

                    if ($row['IdEtat']== 3) {
                    
                        ?>
                        <tr>
                            <td><h5><?=$row['Nom'];?></h5></td>
                            <td><h5><?=$row['idType']?></h5></td>
                            <td><h5><?=$row['Montant']?></h5></td>
                            <td><h5><?=$row['Date_de_frais']?></h5></td>
                            <td><h5><?=$row['objet']?></h5></td>
                            
                            <!--Nous alons mettre l'id de chaque employé dans ce lien -->
                           <td><a href="valide.php?id=<?=$row['ID_frais']?>"><img src="images/icons/valid.png" width=30px height=auto></a></td> 
                            <td><a href="refus.php?id=<?=$row['ID_frais']?>"><img src="images/icons/trash.png" width=30px height=auto></a></td> 
                        </tr>
                        <?php
                    }
           
                }
                                    
                ?>
            </tbody>
        </table> 
    </div>

            </section>
    <section id="content">

        <div class="container autumn-text">
            <h1>FRAIS DEJA TRAITES</h1>
        <table id="table2" class="table hover autumn-text1" style="width: 100%">
            <thead>
                <tr>
                    <th scope="col">Créateur</th>
                    <th scope="col">Type</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Date</th>
                    <th scope="col">Objet</th>
                    <th scope="col">Etat</th>
                    <th scope="col">Modifier</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $base = new PDO ('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', '');

                $donnees = $base->query("SELECT utilisateur.Nom ,frais.ID_frais, type_de_frais.idType , frais.Date_de_frais , frais.Montant , frais.objet , etat_du_frais.IdEtat FROM frais JOIN utilisateur ON frais.ID_utilisateur=utilisateur.ID_utilisateur JOIN Type_de_frais ON frais.IDType=Type_de_frais.IDType JOIN etat_du_frais ON frais.IdEtat=etat_du_frais.IdEtat ORDER BY frais.Date_de_frais DESC")->fetchAll();

                foreach ($donnees as $row)
                

                    if ($row['IdEtat']!= 3) {
                    
                        ?>
                        <tr>
                            <td><h5><?=$row['Nom'];?></h5></td>
                            <td><h5><?=$row['idType']?></h5></td>
                            <td><h5><?=$row['Montant']?></h5></td>
                            <td><h5><?=$row['Date_de_frais']?></h5></td>
                            <td><h5><?=$row['objet']?></h5></td>
                            
                            <?php
                        foreach ($donnees as $row) {
                            if($row['IdEtat']!= 3)
                                if ($row['IdEtat']== 1)  {
                                    ?>
                                    <td><img src="images/icons/valid.png" width=30px height=auto></a></td>
                                    <td><a href="refus.php?id=<?=$row['ID_frais']?>"><img src="images/icons/trash.png" width=30px height=auto></a></td>
                                </tr>
                                    <?php
                                }                          

                                else if($row['IdEtat']== 2) {
                                    ?>
                                    <td><img src="images/icons/trash.png" width=30px height=auto></a></td>
                                    <td><a href="valide.php?id=<?=$row['ID_frais']?>"><img src="images/icons/valid.png" width=30px height=auto></a></td>
                                </tr>
                                    <?php

                            }

                            ?>
                            
                        
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


  <script
  src="https://code.jquery.com/jquery-3.6.3.min.js"
  integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
  crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <script type="text/javascript" src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
$(document).ready( function () {
    $('#table1').DataTable( {
        "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    } );
} );
</script>

<script type="text/javascript">
$(document).ready( function () {
    $('#table2').DataTable( {
        "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    } );
} );
</script>

  </body>
</html>