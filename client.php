<?php require "connexion2.php"; ?>
<!DOCTYPE html>
<html lang="fr">
<!-- From Bootstrap Example document -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Fiche client</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<?php include "inc/header.html"; ?>

<div class="container-fluid">
    <div class="row">
        <?php include "inc/side-bar.html"; ?>
        <?php echo $_GET['IDclient']; ?>
        <?php
            $reponse = $bdd->query('SELECT * FROM clients WHERE IDclient=$_GET[IDclient]');
            $donnees = $reponse->fetch();
        ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Fiche client</h1>
            <div class="table-responsive col-md-8">
                <table class="table table-striped">
                            <tr>
                                <td>Nom</b></td>
                                <td colspan="14"><?php echo $donnees['nomc']; ?></td>
                            </tr>
                            <tr>
                                <td>Prénom</b></td>
                                <td colspan="14"><?php echo $donnees['prenomc']; ?></td>
                            </tr>
                            <tr>
                                <td>Commune</b></td>
                                <td colspan="14"><?php echo $donnees['nomCommune']; ?></td>
                            </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-inverse navbar-fixed-bottom">
    <div class="container-fluid">
        <div class="navbar-footer col-sm-3 col-md-2">
            <a class="navbar-brand" href="#">Actions</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-middle">
                <li>
                    <a href="add-client.php">
                        <img src="img/add-icon.png" width="16" height="16" class="img" alt="+">
                        Ajout d'un nouveau client
                    </a>
                </li>
                <li>
                    <a href="recherche-client.php">
                        <img src="img/search-icon.png" width="16" height="16" class="img" alt="+">
                        Recherche
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

</body>
</html>
