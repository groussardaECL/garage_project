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

    <title>Garage - Dashboard</title>

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
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Dashboard</h1>

                <div class="row placeholders">
                    <div class="col-xs-6 col-sm-3 placeholder">
                        <a href="interventions-dashboard.php">
                            <img src="img/tools.png" width="200" height="200" class="img-responsive bw" alt="Accès aux interventions">
                        </a>
                        <h4>Interventions</h4>
                        <a href="add-intervention.php" class="text-muted">Nouveau</a>
                    </div>
                    <div class="col-xs-6 col-sm-3 placeholder">
                        <a href="clients-dashboard.php">
                            <img src="img/client.png" width="200" height="200" class="img-responsive bw" alt="Accés aux clients">
                        </a>
                        <h4>Clients</h4>
                        <a href="add-client.php" class="text-muted">Nouveau</a>
                    </div>
                    <div class="col-xs-6 col-sm-3 placeholder">
                        <a href="vehicules-dashboard.php">
                            <img src="img/car.png" width="200" height="200" class="img-responsive bw" alt="Accés aux véhicules">
                        </a>
                        <h4>Vehicules</h4>
                        <a href="add-vehicule.php" class="text-muted">Nouveau</a> | <a href="modify-vehicule.php" class="text-muted">Modifier</a>
                    </div>
                    <div class="col-xs-6 col-sm-3 placeholder">
                        <a href="personnel-dashboard.php">
                            <img src="img/staff.png" width="200" height="200" class="img-responsive bw" alt="Accés aux personnel">
                        </a>
                        <h4>Personnel</h4>
                        <a href="add-personnel.php" class="text-muted">Nouveau</a>
                    </div>
                </div>

                <div class="row">
                    <h2 class="sub-header">Statistiques générales</h2>
                    <div class="table-responsive col-md-4">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Elément</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Interventions</td>
                                <td>
                                    <?php
                                    $reponse = $bdd->query('SELECT COUNT(*) as totalinterventions FROM interventions');
                                    $donnees = $reponse->fetch();
                                    $reponse->closeCursor();
                                    echo $donnees['totalinterventions'];
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Clients</td>
                                <td>
                                    <?php
                                    $reponse = $bdd->query('SELECT COUNT(*) as totalclients FROM clients');
                                    $donnees = $reponse->fetch();
                                    $reponse->closeCursor();
                                    echo $donnees['totalclients'];
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Véhicules</td>
                                <td>
                                    <?php
                                    $reponse = $bdd->query('SELECT COUNT(*) as totalvehicules FROM vehicules');
                                    $donnees = $reponse->fetch();
                                    $reponse->closeCursor();
                                    echo $donnees['totalvehicules'];
                                    ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <h2 class="sub-header">Statistiques Communes</h2>
                    <div class="table-responsive col-md-4">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Villes</th>
                                <th>Nombre de clients</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $reponse = $bdd->query('SELECT nomCommune, COUNT(nomCommune) as nbclients FROM clients GROUP BY nomCommune');
                            while ($donnees = $reponse->fetch()) {
                                echo '<tr><td>'.$donnees['nomCommune'].'</td><td>'.$donnees['nbclients'].'</td></tr>';
                            };
                            $reponse->closeCursor();
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <h2 class="sub-header">Statistiques Techniciens</h2>
                    <div class="table-responsive col-md-4">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Techniciens</th>
                                <th>Nombre d'interventions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $reponse = $bdd->query('SELECT t.IDtechnicien, r.IDtechnicien, t.nom as nomt, t.prenom as prenomt, COUNT(t.IDtechnicien) as nbinterventions FROM repare as r, techniciens as t WHERE t.IDtechnicien=r.IDtechnicien GROUP BY t.IDtechnicien');
                            while ($donnees = $reponse->fetch()) {
                                echo '<tr><td>'.$donnees['prenomt'].' '.$donnees['nomt'].'</td><td>'.$donnees['nbinterventions'].'</td></tr>';
                            };
                            $reponse->closeCursor();
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>