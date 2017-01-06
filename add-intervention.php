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
            <h1 class="page-header">Ajout des interventions</h1>
            <div class="container">
                                <form id="contact" action="added-intervention.php" method="post">
                                    <h3>Informations Intervention</h3>
                                    <h4>Choisissez le type de prestation :</h4>
                                    <fieldset>
                                        <select name="reparation" required>
                                           <option value="forfaitaire">Forfait</option><option value="nonforfaitaire">Non-forfaitaire</option>';
                                        </select>
                                    </fieldset>
                                    <h4>Renseignez les champs ci-dessous :</h4>
                                    <fieldset>
                                        <input placeholder="N° d'immatriculation du véhicule" type="number" tabindex="1" name="immatriculation" required>
                                    </fieldset>
                                    <fieldset>
                                        <input placeholder="Kilométrage" type="number" tabindex="2" name="km" required>
                                    </fieldset>
                                    <fieldset>
                                        <input placeholder="Date d'entrée du véhicule" type="date" tabindex="3" name="date" required>
                                    </fieldset>
                                    <h4>Choisissez le forfait :</h4>
                                    <fieldset>
                                        <select name="forfait">
                                            <?php
                                            $reponse = $bdd->query('SELECT typeIntervention, prixForfait FROM forfaits');
                                            while ($donnees = $reponse->fetch()) {
                                                echo '<option value="' .$donnees['typeIntervention']. '">' .$donnees['typeIntervention']. ' à ' .$donnees['prixForfait'].' €</option>';
                                            }
                                            ?>
                                        </select>
                                    </fieldset>
                                    <h4>S'il s'agit d'une prestation non forfaitaire</h4>
                                    <fieldset>
                                        <input placeholder="Désignation" type="text" tabindex="4" name="Designation">
                                    </fieldset>
                                    <fieldset>
                                        <input placeholder="Prix des pièces en €" type="number" tabindex="5" name="pieces">
                                    </fieldset>
                                    <fieldset>
                                        <input placeholder="Prix main d'oeuvre en €" type="number" tabindex="6" name="mdo">
                                    </fieldset>
                                    <h4>Indiquez le(s) technicien(s) en charge :</h4>
                                    <fieldset>
                                        <select name="technicien" required>
                                            <?php
                                            $reponse = $bdd->query('SELECT IDtechnicien, nom, prenom FROM techniciens');
                                            while ($donnees_technicien = $reponse->fetch()) {
                                                echo '<option value="' .$donnees_technicien['IDtechnicien']. '">' .$donnees_technicien['prenom']. ' ' .$donnees_technicien['nom']. '</option>';
                                            }
                                            ?>
                                        </select>
                                    </fieldset>
                                    <fieldset>
                                        <select name="technicien-2" required>
                                            <?php
                                            $reponse = $bdd->query('SELECT IDtechnicien, nom, prenom FROM techniciens');
                                            while ($donnees_technicien2 = $reponse->fetch()) {
                                                echo '<option value="' .$donnees_technicien2['IDtechnicien']. '">' .$donnees_technicien['prenom']. ' ' .$donnees_technicien['nom']. '</option>';
                                            }
                                            ?>
                                        </select>
                                    </fieldset>
                                    <fieldset>
                                        <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Ajouter</button>
                                    </fieldset>
                                </form>
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