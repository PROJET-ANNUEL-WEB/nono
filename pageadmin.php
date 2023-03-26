<!DOCTYPE html>
<html>

<head>
    <link href="csscompta.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title> Page admin </title>
</head>

<body>
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
                    Administrateur
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
                                <li class="active"><a href="#"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
                                <li><a href="#"><span class="glyphicon glyphicon-plane"></span> Active Link</a></li>
                                <li><a href="#"><span class="glyphicon glyphicon-cloud"></span> Link</a></li>

                                <!-- Dropdown-->
                                <li class="panel panel-default" id="dropdown">
                                    <a data-toggle="collapse" href="#dropdown-lvl1">
                                        <span class="glyphicon glyphicon-user"></span> Sub Level <span class="caret"></span>
                                    </a>

                                    <!-- Dropdown level 1 -->
                                    <div id="dropdown-lvl1" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul class="nav navbar-nav">
                                                <li><a href="#">Link</a></li>
                                                <li><a href="#">Link</a></li>
                                                <li><a href="#">Link</a></li>

                                                <!-- Dropdown level 2 -->
                                                <li class="panel panel-default" id="dropdown">
                                                    <a data-toggle="collapse" href="#dropdown-lvl2">
                                                        <span class="glyphicon glyphicon-off"></span> Sub Level <span class="caret"></span>
                                                    </a>
                                                    <div id="dropdown-lvl2" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            <ul class="nav navbar-nav">
                                                                <li><a href="#">Link</a></li>
                                                                <li><a href="#">Link</a></li>
                                                                <li><a href="#">Link</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li><a href="#"><span class="glyphicon glyphicon-signal"></span> Link</a></li>

                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </nav>

                </div>
            </div>
        </div>
        <div class="col-md-10 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Gestion des rôles
                </div>
                <div class="panel-body">
                     - Ajouter un rôle <br>- Modifier un rôle <br> - Supprimer un rôle
                </div>
            </div>
        </div>
        <div class="col-md-10 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Gestion des utilisateurs
                </div>
                <div class="panel-body">
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

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>C est nickel</strong> l ajout est OK.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}
?>

</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>





</body>

</html>