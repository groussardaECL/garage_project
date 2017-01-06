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

    <title>Fiche Intervention</title>

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
        <?php
        $reponse_intervention = $bdd->query("SELECT IDintervention, typeIntervention, designation, prixForfait, prixPiece, prixMainOeuvre, kilometrage, dateArrivee, immatriculation FROM interventions WHERE IDintervention='$_GET[idintervention]'");
        $donnees_intervention = $reponse_intervention->fetch();
        ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Fiche intervention</h1>
            <div class="table-responsive col-md-8">
                <table class="table table-striped">
                    <tr>
                        <td>ID</td>
                        <td><?php echo $donnees_intervention['IDintervention']; ?></td>
                    </tr>
                    <tr>
                        <td>Type d'Intervention</td>
                        <td><?php echo $donnees_intervention['typeIntervention']; ?></td>
                    </tr>
                    <tr>
                        <td>Véhicule</td>
                        <td><?php echo $donnees_intervention['immatriculation']; ?></td>
                    </tr>
                    <tr>
                        <td>Désignation</td>
                        <td><?php echo $donnees_intervention['designation']; ?></td>
                    </tr>
                    <tr>
                        <td>Prix du forfait</td>
                        <td><?php echo $donnees_intervention['prixForfait']; ?></td>
                    </tr>
                    <tr>
                        <td>Prix des pièces</td>
                        <td><?php echo $donnees_intervention['prixPiece']; ?></td>
                    </tr>
                    <tr>
                        <td>Prix de la main d'oeuvre</td>
                        <td><?php echo $donnees_intervention['prixMainOeuvre']; ?></td>
                    </tr>
                    <tr>
                        <td>Kilométrage lors de la prise en charge</td>
                        <td><?php echo $donnees_intervention['kilometrage']; ?></td>
                    </tr>
                    <tr>
                        <td>Date de la prise en charge</td>
                        <td><?php echo $donnees_intervention['dateArrivee']; ?></td>
                    </tr>
                    <tr>
                        <td>Techniciens</td>
                        <td>
                            <?php
                            $reponse_technicien= $bdd->prepare("SELECT t.IDtechnicien, t.nom as nomt, t.prenom as prenomt FROM repare as r, techniciens as t WHERE IDintervention= ? AND t.IDtechnicien=r.IDtechnicien");
                            $reponse_technicien->execute(array($_GET['idintervention']));
                            while($donnees_technicien = $reponse_technicien->fetch())
                            {
                                echo $donnees_technicien['prenomt'].' '.$donnees_technicien['nomt'].'</br>';
                            }
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Commentaires</td>
                        <td>
                            <?php
                            $reponse_commentaire= $bdd->prepare("SELECT IDintervention, commentaire, dateHeureCommentaire, t.nom as nomt, t.prenom as prenomt FROM commentaires as c, techniciens as t WHERE IDintervention= ? AND t.IDtechnicien=c.IDtechnicien ORDER BY dateHeureCommentaire ASC");
                            $reponse_commentaire->execute(array($_GET['idintervention']));
                            while($donnees_commentaire = $reponse_commentaire->fetch())
                            {
                                echo '<strong>"'.$donnees_commentaire['commentaire']. '"</strong><br/> posté par <i>'.$donnees_commentaire['prenomt'].' '.$donnees_commentaire['nomt'].'</i> le '.$donnees_commentaire['dateHeureCommentaire'].'<br/>';
                            }
                            ?>
                        </td>
                    </tr>
                </table>
                <a href="interventions-dashboard.php">Retour au Dashboard intervention</a>
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
                    <a href="add-intervention.php">
                        <img src="img/add-icon.png" width="16" height="16" class="img" alt="+">
                        Ajout d'une nouvelle intervention
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

</body>
</html>
