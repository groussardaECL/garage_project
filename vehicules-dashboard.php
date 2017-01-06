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

    <title>Garage - Véhicules</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/form.css" rel="stylesheet">

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
            <h1 class="page-header">Dashboard - Véhicules</h1>

            <h2 class="sub-header">Liste des véhicules</h2>
            <div class="table-responsive col-md-8">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Immatriculation</th>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>Année</th>
                        <th>Propriétaire</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $reponse = $bdd->query('SELECT  immatriculation, typeVehicule, marque, annee FROM vehicules');
                    while ($donnees = $reponse->fetch())
                    {
                        $reponse2 = $bdd->prepare('SELECT c.prenom as prenomc, c.nom as nomc FROM clients as c, appartient as a WHERE a.immatriculation= ? AND a.IDclient=c.IDclient');
                        $reponse2->execute(array($donnees['immatriculation']));
                        while ($donnees2 = $reponse2->fetch())
                        {
                            echo '<tr>';
                            echo '<td>' . $donnees['immatriculation'] . '</td>';
                            echo '<td>' . $donnees['marque'] . '</td>';
                            echo '<td>' . $donnees['typeVehicule'] . '</td>';
                            echo '<td>' . $donnees['annee'] . '</td>';
                            echo '<td>'. $donnees2['prenomc'] . ' '. $donnees2['nomc'] . '</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include "inc/footer-vehicule.html";?>
</body>
</html>