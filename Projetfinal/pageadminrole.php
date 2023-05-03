<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" src="logom.ico"/>
    <link href="adminrole.css" rel="stylesheet" id="bootstrap-css">
    <script type="text/javascript" src="admin.js"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap.min.css">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title> Gestion des Rôles </title>
</head>

<header>
<nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a href="pageadmin.php"><img src="logom.png" alt="Logo MW" style="height:50px;float:inline-start;display:inline-block;margin-right:10px;"></a>                   

                <a class="navbar-brand" >
                   Connecté en tant qu'Administrateur
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
                    <nav class="pichon navbar navbar-default " role="navigation">
                        <!-- Main Menu -->
                        <div class="side-menu-container">
                            <ul class="nav navbar-nav">
                            <li class="active"><a href="pageadminrole.php"><span class="glyphicon glyphicon-briefcase"></span> Rôles</a></li>
                                <li><a href="pageadmin.php"><span class="glyphicon glyphicon-user"></span> Utilisateurs</a></li>
                                <li><a href="pageadminfrais.php"><span class="glyphicon glyphicon-usd"></span> Frais</a></li>      
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </nav>

                </div>
            </div>
        </div>

        <div class="col-md-10 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Gestion des Rôles
                </div>
                <body>
<div class="container">
<h3>Ajouter un nouveau Rôle</h3>
    <div class="row">
        <form action="pageadminrole.php" method="post">

            <div class="mb-3">
                <label for="IDRole" class="form-label">Numéro de Rôle</label>
                <input type="text" name="ID_Role" class="form-control" id="IDRole">
            </div>

            <div class="mb-3">
                <label for="Type_de_role" class="form-label">Nom du Rôle</label>
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

<br>

                <div class="panel-body">
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