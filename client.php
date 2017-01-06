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
        <?php
        $reponse_client = $bdd->query("SELECT IDclient, c.nom as nomc, c.prenom as prenomc, nomCommune FROM clients as c WHERE IDclient='$_GET[idclient]'");
        $donnees_client = $reponse_client->fetch();
        ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Fiche client</h1>
            <div class="table-responsive col-md-8">
                <table class="table table-striped">
                    <tr>
                        <td>Client</td>
                        <td><?php echo $donnees_client['prenomc'].' '.$donnees_client['nomc']; ?></td>
                    </tr>
                    <tr>
                        <td>Commune</td>
                        <td><?php echo $donnees_client['nomCommune']; ?></td>
                    </tr>
                    <tr>
                        <td>Véhicule(s)</td>
                        <td>
                            <?php
                            $reponse_immat= $bdd->query("SELECT a.immatriculation as immatriculationa, v.immatriculation as immatriculationv, marque, annee FROM appartient as a, vehicules as v WHERE IDclient=$_GET[idclient] AND a.immatriculation=v.immatriculation;");
                            while ($donnees_immat = $reponse_immat->fetch())
                            {
                                echo $donnees_immat['immatriculationa'].' ('.$donnees_immat['marque'].' - '.$donnees_immat['annee'].')</br>';
                            }
                            ?>
                        </td>
                    </tr>
                </table>
                <a href="clients-dashboard.php">Retour au Dashboard Client</a>
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
