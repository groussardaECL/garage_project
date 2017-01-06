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

    <title>Garage - Interventions</title>

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
            <h1 class="page-header">Dashboard - Interventions</h1>

            <h2 class="sub-header">Liste des interventions</h2>
            <div class="table-responsive col-md-10">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type d'intervention</th>
                        <th>Désignation</th>
                        <th>Immatriculation</th>
                        <th>Kilométrage</th>
                        <th>Date d'entrée</th>
                        <th>Technicien</th>
                        <th>Plus de détails</th>
                        <th><i>Commentaire</i></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $reponse = $bdd->query('SELECT  IDintervention, typeIntervention, Designation, prixForfait, prixPiece, prixMainOeuvre, kilometrage, dateArrivee, immatriculation FROM interventions');
                    while ($donnees = $reponse->fetch())
                    {
                        $reponse2 = $bdd->query("SELECT  r.IDtechnicien, t.nom as nomt, t.prenom as prenomt FROM repare as r, techniciens as t WHERE r.IDintervention=$donnees[IDintervention] AND r.IDtechnicien=t.IDtechnicien");
                        while ($donnees2 = $reponse2 ->fetch()) {

                            echo '<tr>';
                            echo '<td>' . $donnees['IDintervention'] . '</td>';
                            echo '<td>' . $donnees['typeIntervention'] . '</td>';
                            echo '<td>' . $donnees['Designation'] . '</td>';
                            echo '<td>' . $donnees['immatriculation'] . '</td>';
                            echo '<td>' . $donnees['kilometrage'] . '</td>';
                            echo '<td>' . $donnees['dateArrivee'] . '</td>';
                            echo '<td>'. $donnees2['prenomt'] . ' '. $donnees2['nomt'] . '</td>';
                            echo '<td><a href="intervention.php?idintervention='.$donnees['IDintervention'].'">Details</a></td>';
                            echo '<td><a href="add-commentaire.php?idintervention='.$donnees['IDintervention'].'"><img src=img/add-comment-icon.png width="16" height="16" class="img" alt="+"/></a></td>';
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
<?php include "inc/footer-intervention.html";?>
</body>
</html>