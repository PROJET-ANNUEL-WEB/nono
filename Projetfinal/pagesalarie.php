<?php
session_start();

?>
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

// Récupérer les options de type de frais dans la base de données
$sql = "SELECT * FROM type_de_frais";
$result = mysqli_query($conn, $sql);

// Stocker les options de type de frais dans un tableau
$options = array();
while($row = mysqli_fetch_assoc($result)) {
    $options[$row['idType']] = $row['Type_de_frais'];
}
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
    <title>Frais salarié</title>

    <header>
  <nav>
    <ul>

    </ul>
  </nav>
  <?php
    if (isset($_SESSION['nom_utilisateur'])) {
        $nom_utilisateur = $_SESSION['nom_utilisateur'];
    }
  ?>
    
</header>
 <body>

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
            echo "<script> alert('Frais bien ajoute') </script>";
        } else {
            echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

          
 

// Fermeture de la connexion à la base de données

?>
<div class="container3">
    <div class="row">
    <form class="form3" action="pagesalarie.php" method="post">
<h2>Formulaire de saisie de frais </h2>
  <p><i>Complétez le formulaire. Les champs marqué par </i><em>*</em> sont <em>obligatoires</em></p>
  <fieldset>
    <legend></legend>
      <label for="Date_de_frais">Date de frais <em>*</em></label>

      <input id="Date_de_frais" type="date" name="Date_de_frais" placeholder="**/**/****" autofocus="" required=""><br>
      
      
    <label for="Montant">Montant<em>*</em></label>
    
    <input id="Montant" type="decimal" name="Montant" placeholder="00,00€">
   
  
     

    <label for="objet"> Objet <em>*</em></label>
    <input id="objet" type="objet" name="objet" placeholder="ex: Repas midi"><br>
    <input type="hidden" name="ID_utilisateur" value="<?php echo $ID_utilisateur ?>">


 
  <fieldset>
  <label for="objet"> Type <em>*</em></label>
  <select class="form-select" name="idType">
<?php
foreach($options as $idType => $Type_de_frais) {
    echo "<option value=\"$idType\">$Type_de_frais ($idType)</option>";
}
?>
</select>
  </fieldset>

  <!-- formulaire -->
<form id="form" enctype="multipart/form-data">
  <div>
    <label>
      <input type="checkbox" name="extra-field-checkbox"> Souhaitez-vous joindre une facture/ticket de caisse ?
    </label>
    <br>
    <label>
      <input type="file" onchange="handleFiles(event)" id="upload" multiple accept=".jpg, .jpeg, .png" name="extra-field" disabled>
      <div id="preview"></div>
    </label>
  </div>
</form>
</form>

<!-- script -->
<script>
  const checkbox = document.querySelector('input[name="extra-field-checkbox"]');
  const extraField = document.querySelector('input[name="extra-field"]');
  const preview = document.getElementById('preview');
  const form = document.getElementById('form');

  checkbox.addEventListener('change', function() {
    if (checkbox.checked) {
      extraField.removeAttribute('disabled');
    } else {
      extraField.setAttribute('disabled', '');
      preview.innerHTML = ''; // effacer l'aperçu de l'image
    }
  });

  function handleFiles(event) {
    var imageType = /^image\//;
    var file = event.target.files[0];
    if (!imageType.test(file.type)) {
      alert("veuillez sélectionner une image");
    } else {
      var reader = new FileReader();
      reader.onload = function(e) {
        var img = new Image();
        img.src = e.target.result;
        img.onload = function() {
          preview.innerHTML = '';
          preview.appendChild(img);
        }
        // convertir l'image en base64
        var base64Image = e.target.result.split('base64,')[1];
        // envoyer l'image au backend pour la stocker dans la base de données
        // par exemple, avec jQuery :
        /*
        $.ajax({
          url: 'backend.php',
          type: 'POST',
          data: {image: base64Image},
          success: function(response) {
            console.log(response);
          }
        });
        */
      }
      reader.readAsDataURL(file);
    }
  }

  form.addEventListener('submit', function(event) {
    event.preventDefault(); // empêcher l'envoi du formulaire
    // envoyer les autres champs du formulaire au backend
    // par exemple, avec jQuery :
    /*
    $.ajax({
      url: 'backend.php',
      type: 'POST',
      data: new FormData(form),
      processData: false,
      contentType: false,
      success: function(response) {
        console.log(response);
      }
    });
    */
  });
</script>
<p><input type="submit" value="Soummettre" name="btn"></p>
</div>    



<section id="content">

        <div class="container3 autumn-text  ">
            <h1>FRAIS EN ATTENTE</h1>
        <table id="table1" class="tableuser autumn-text1 table-margin" style="width: 100%">
            <thead>
                <tr class="tableuser">
                    <th scope="col">Type</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Date</th>
                    <th scope="col">Objet</th>
                    <th scope="col">Supprimer</th>
                    <th scope="col">Modifier</th>
                </tr>
            </thead>
            <tbody>

            <?php
                $ID_utilisateur = $_SESSION['ID_utilisateur'];
                $pdo = new PDO ('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', '');
                $sql = "SELECT * FROM frais WHERE ID_utilisateur = :ID_utilisateur";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':ID_utilisateur', $ID_utilisateur);
                $stmt->execute();
                $result = $stmt->fetchAll();
                foreach ($result as $row) {
                    if ($row['IdEtat'] == 3) {
                        ?>
                        <tr>
                           
                            <td><h5><?=$row['idType']?></h5></td>
                            <td><h5><?=$row['Montant']?></h5></td>
                            <td><h5><?=$row['Date_de_frais']?></h5></td>
                            <td><h5><?=$row['objet']?></h5></td>
                            <td>
                                    <form method="post" action="supprimer_frais.php">
                                        <input type="hidden" name="Montant" value="<?=$row['Montant']?>">
                                        <button type="submit" class="glyphicon glyphicon-trash"></button>
                                    </form>
                                </td> 
                                <td>
                                <form method="post" action="modifier_frais.php">
                                    <input type="hidden" name="ID_Frais" value="<?=$row['ID_Frais']?>">
                                    <button type="submit border-none" class="glyphicon glyphicon-pencil"></button>
                                </form>
                                </td> 
                        </tr>
                        <?php
                    }
           
                }
                                    
                ?>
            </tbody>
        </table> 

  
            <h1>FRAIS DEJA TRAITES</h1>
         <table id="table2" class="tableuser hover autumn-text1" style="width: 100%">
             <thead>
                 <tr class="tableuser">
                    <th></th>
                     <th scope="col">Type</th>
                     <th scope="col">Prix</th>
                     <th scope="col">Date</th>
                     <th scope="col">Objet</th> 
                     <th scope="col">Etat</th>
                    

 <!-- @@ -237,40 +236,43 @@ -->
             </thead>
             <tbody>

             <?php
$ID_utilisateur = $_SESSION['ID_utilisateur'];
$base = new PDO ('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', '');

$donnees = $base->query("SELECT utilisateur.Nom ,frais.ID_frais, type_de_frais.idType , frais.Date_de_frais , frais.Montant , frais.objet , etat_du_frais.IdEtat FROM frais JOIN utilisateur ON frais.ID_utilisateur=utilisateur.ID_utilisateur JOIN Type_de_frais ON frais.IDType=Type_de_frais.IDType JOIN etat_du_frais ON frais.IdEtat=etat_du_frais.IdEtat WHERE utilisateur.ID_utilisateur = $ID_utilisateur AND etat_du_frais.IdEtat != 3 ORDER BY frais.Date_de_frais DESC")->fetchAll();

foreach ($donnees as $row) {
    if ($row['IdEtat'] != 3) {
        ?>
    <tr>
    <td></td>
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
   
</tr>
        <?php
    }
}
?>
            </tbody>
        </table> 
   
        

            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>


  <script src="https://code.jquery.com/jquery-3.6.3.min.js"integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="crossorigin="anonymous"></script>
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

<div class="container7 autumn-text">
 <h3>Types de frais existants</h3>
                        <table id="table1" class="autumn-text1 tableuser" style="width: 100%">
                            <thead>
                                <tr class="tableuser">
                                    <th scope="col">Numéro de Frais</th>
                                    <th scope="col">Type de Frais</th>
                  
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

                            </tr>
                    <?php
                        }
                    }
                    ?>

                    </section>
                
                               
                    </div>

</body>

</html>