<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" src="logom.ico"/>
    <link href="compta.css" rel="stylesheet" id="bootstrap-css">
    <script type="text/javascript" src="admin.js"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap.min.css">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title> Comptabilité </title>
</head>

<header>
<nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a href="pagecompta.php"><img src="logom.png" alt="Logo MW" style="height:50px;float:inline-start;display:inline-block;margin-right:10px;"></a>                   

                <a class="navbar-brand" >
                   Connecté en tant que Comptable
                </a>


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
           
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" target="_blank">
                
                <?php

                       /* echo(`.$ID_utilisateur.`);

                            $db = new PDO('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', 'root');
                            $stmt = $db->prepare("SELECT ID_role FROM utilisateur WHERE ID_utilisateur = $ID_utilisateur");

                            $stmt->bindParam(':ID_utilisateur', $ID_utilisateur);
                            $stmt->execute();



                        */
                        ?> 

                        </a>
                    </li>
                    <li><a href="pagelogin.php"><B>Se déconnecter</B></a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
<body>
    <div class="container-fluid main-container">
        <div class="col-md-2 sidebar">
            <div class="row">
                <!-- uncomment code for absolute positioning tweek see top comment in css -->
                <div class="absolute-wrapper"> </div>
                <!-- Menu -->
                <div class="side-menu">
                    <nav class="navbar navbar-default" role="navigation">
                        <!-- Main Menu -->
                        <div class="side-menu-container">
                            <ul class="nav navbar-nav">
                                <li><a href="pagecompta.php"><span class="glyphicon glyphicon-usd"></span> Frais</a></li>
                                                           </ul>
                        </div><!-- /.navbar-collapse -->
                    </nav>

                </div>
            </div>
        </div>

        <div class="col-md-10 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                Gestion des Frais
                </div>
                <body>
<div class="container">
    <div class="row">
    <form action="pagescompta.php" method="post">


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
                            
                            <td>
                                    <form method="post" action="supprimer_frais.php">
                                        <input type="hidden" name="IdEtat" value="<?=$row['IdEtat']?>">
                                        <button type="submit" class="glyphicon glyphicon-ok"></button>
                                    </form>
                            </td> 
                            <td>
                                <form method="post" action="modifier_frais.php">
                                    <input type="hidden" name="Nom" value="<?=$row['Nom']?>">
                                    <button type="submit" class="glyphicon glyphicon-remove"></button>
                                </form>
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
                     <th></th>
                 <!--    <th scope="col">Editer</th> -->




 <!-- @@ -237,40 +236,43 @@ -->
             </thead>
             <tbody>

             <?php

$base = new PDO ('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', '');

$donnees = $base->query("SELECT utilisateur.Nom ,frais.ID_frais, type_de_frais.idType , frais.Date_de_frais , frais.Montant , frais.objet , etat_du_frais.IdEtat FROM frais JOIN utilisateur ON frais.ID_utilisateur=utilisateur.ID_utilisateur JOIN Type_de_frais ON frais.IDType=Type_de_frais.IDType JOIN etat_du_frais ON frais.IdEtat=etat_du_frais.IdEtat ORDER BY frais.Date_de_frais DESC")->fetchAll();

foreach ($donnees as $row) {
    if ($row['IdEtat'] != 3) {
        ?>
    <tr>
    <td><h5><?=$row['Nom'];?></h5></td>
    <td><h5><?=$row['idType']?></h5></td>
    <td><h5><?=$row['Montant']?></h5></td>
    <td><h5><?=$row['Date_de_frais']?></h5></td>
    <td><h5><?=$row['objet']?></h5></td>
    <?php
    if ($row['IdEtat']!= 3) {
        if ($row['IdEtat']== 1)  { ?>
            <td colspan="2"><a href="refus.php?id=<?=$row['ID_frais']?>" class="glyphicon glyphicon-thumbs-up"><img width=30px height=auto></a></td>
        <?php } else if($row['IdEtat']== 2) { ?>
            <td colspan="2"><a href="valide.php?id=<?=$row['ID_frais']?>" class="glyphicon glyphicon-thumbs-down"><img width=30px height=auto></a></td>
        <?php }
    } else { ?>
        <td></td>
    <?php } ?>
    <td><a class="glyphicon glyphicon-pencil"><img width=30px height=auto></a></td>
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