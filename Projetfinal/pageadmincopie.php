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
$sql = "SELECT * FROM roles";
$result = mysqli_query($conn, $sql);

// Stocker les options de type de frais dans un tableau
$options = array();
while($row = mysqli_fetch_assoc($result)) {
    $options[$row['ID_Role']] = $row['Type_de_role'];
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrateur</title>
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
	<div class="container">
		<form class="form2" action="pageadmincopie.php" method="post">
			<h2>Enregistrement d'utilisateur</h2>	
      <label>Rôle</label>
      <select class="form-select" name="idType">
<?php
foreach($options as $ID_Role => $Type_de_role) {
    echo "<option value=\"$ID_Role\">$Type_de_role ($ID_Role)</option>";
}
?>
</select>
			<label>Adresse e-mail</label>
			<input type="email" name="email">
			<label>Mot de passe</label>
			<input type="password" name="mot_de_passe">
    	<label>Nom</label>
			<input type="text" name="Nom">
      <label>Prénom</label>
			<input type="text" name="Prenom">
	
			<input type="submit" value="Enregistrer">
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
        $role = $_POST['ID_Role'];
if ($role == 'admin') {
  $ID_Role = 1;
} elseif ($role == 'comptable') {
  $ID_Role = 2;
} elseif ($role == 'salarié') {
  $ID_Role = 3;
} else {
  // Gérer le cas où le rôle est invalide
}

// Insérer l'utilisateur dans la base de données en utilisant $id_role comme valeur pour le champ "ID_Role"

        $stmt->execute();

        echo "<script> alert('Utilisateur bien ajoute') </script>";

}
?>
		</form>
    </div>
    <div class= "container2">
    <section id="content">
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
                    <button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></button>
                </form>
            </td>
            <td>
                <form method="post" action="supprimer_utilisateur.php">
                    <input type="hidden" name="email" value="<?=$row['email']?>">
                    <button type="submit" class="btn btn-danger"><i class="fas fa-times"></i></button>
                </form>
            </td>
        </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>

<h3>Utilisateurs désactivés</h3>
            <table id="table1" class="autumn-text1 tableuser" style="width: 100%">
    <thead>
        <tr class="tableuser">
            <th scope="col">Email</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Rôle</th>            
            <th scope="col">Etat du compte</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
      $base = new PDO('mysql:host=localhost;dbname=projetannuel;charset=utf8mb4', 'root', '');
      $donnees = $base->query("SELECT utilisateur.email, Nom, Prenom, ID_Role, etat_user FROM utilisateur, etat_utilisateur WHERE utilisateur.ID_Etat = 2 AND utilisateur.ID_Etat = etat_utilisateur.ID_Etat")->fetchAll();
      
      foreach ($donnees as $row) {
        
          ?>
          <tr>
              <td><h5><?=$row['email'];?></h5></td>
              <td><h5><?=$row['Nom']?></h5></td>
              <td><h5><?=$row['Prenom']?></h5></td>
              <td><h5><?=$row['ID_Role']?></h5></td>
              <td><h5><?=$row['etat_user']?></h5></td>
              <td>
                  <form method="post" action="active_utilisateur.php">
                      <input type="hidden" name="email" value="<?=$row['email']?>">
                      <button type="submit" class="btn btn-success"><i class="fas fa-times"></i></button>
                  </form>
              </td>
          </tr>
          <?php
      }
      ?>
      
        
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#table1').DataTable( {
            "pagingType": "full_numbers"
        } );
    } );
</script>

                    </section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>


  <script src="https://code.jquery.com/jquery-3.6.3.min.js"integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.js"></script>


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


</body>
</html>