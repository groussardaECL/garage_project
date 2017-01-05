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
            <h1 class="page-header">Dashboard - Clients</h1>

            <h2 class="sub-header">Liste des clients</h2>
            <div class="table-responsive col-md-8">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Voiture</th>
                        <th>Techniciens</th>
                        <th>Nombre de commentaires</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $reponse = $bdd->query('SELECT i.IDintervention as IDinterv, typeIntervention, i.immatriculation as immat, r.IDtechnicien, t.prenom as prenomt, t.nom as nomt, marque, annee FROM interventions as i, techniciens as t, repare as r, vehicules as v, commentaires as c WHERE r.IDtechnicien=t.IDtechnicien AND i.immatriculation=v.immatriculation;');
                    while ($donnees = $reponse->fetch())
                    {
                        echo '<tr>';
                        echo '<td>'.$donnees['IDinterv'].'</td>';
                        echo '<td>'.$donnees['typeIntervention'].'</td>';
                        echo '<td>'.$donnees['immat'].' ('.$donnees['marque'].' - '.$donnees['annee'].')</td>';
                        echo '<td>'.$donnees['prenomt'].' '.$donnees['nomt'].'</td>';
                        echo '<td>A calculer</td>';
                        /**echo '<a class="delete" href="delete.php?ID='.$a['ID'].'"'.
                            ' onclick="return confirm(\'Voulez-vous vraiment supprimer ces Jeux Olympiques ?\')")>X</a>&nbsp;';
                        echo '<a href="detail.php?ID='.$a['ID'].'">'.$a['Annee'].'</a>';
                        echo '</td>'; */
                        echo '</tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>