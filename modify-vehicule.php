<?php require "connexion2.php"; ?>
<!DOCTYPE html>
<html lang="fr">
<!-- From Bootstrap Example document -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="GarageProject">
    <meta name="author" content="Arnaud Groussard">
    <link rel="icon" href="favicon.ico">

    <title>Garage - Clients</title>

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

<?php if (isset($_POST['immatriculation'])) {?>

    <?php
    $req = $bdd->query('SELECT * FROM vehicules')->fetchAll();
    $present = false;

    foreach ($req as $elem) {
        if ($elem['immatriculation'] == $_POST['immatriculation']) {
            $present = true;
            break;
        }
    }
    if ($present) {
    ?>

    <div class="container-fluid">
        <div class="row">
            <?php include "inc/side-bar.html"; ?>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">
                    Véhicule modifié !
                </h1>
                <div class="col-xs-6 col-sm-3 placeholder">
                    <a href="vehicules-dashboard.php">
                        <img src="img/car.png" width="200" height="200" class="img-responsive bw"
                             alt="Accés aux véhicules">
                    </a>
                    <h4>
                        <?php echo 'Le véhicule immatriculé <b>' . $_POST['immatriculation'] . '</b> appartenant à '; ?>
                        <?php
                        $reponse = $bdd->query("SELECT nom, prenom FROM clients WHERE IDclient='$_POST[client]'");
                        $donnees = $reponse->fetch();
                        echo $donnees['prenom'] . ' ' . $donnees['nom'].' a bien été modifié.';
                        ?>
                    </h4>
                    <a href="add-vehicule.php" class="text-muted">Ajouter un autre véhicule</a> | <a
                        href="modify-vehicule.php" class="text-muted">Modifier un véhicule</a> | <a
                        href="find-vehicule.php" class="text-muted">Rechercher</a>
                </div>
            </div>
        </div>
    </div>

<?php

    if ($_SERVER['REQUEST_METHOD'] != 'POST') die ('Illegal call');

    $req1 = $bdd->prepare("UPDATE vehicules SET typeVehicule =:typeVehicule, marque =:marque, annee =:annee WHERE immatriculation='$_POST[immatriculation]'");
    $req1->execute(array(
        'typeVehicule' => $_POST['typeVehicule'],
        'marque' => $_POST['marque'],
        'annee' => $_POST['annee']));

    $req2 = $bdd->prepare("UPDATE appartient SET IDclient =:IDclient WHERE immatriculation='$_POST[immatriculation]'");
    $req2->execute(array(
        'IDclient' => $_POST['client'],
    )) or die(print_r($req2->errorInfo()));
}?>

<?php }

if (!isset($_POST['immatriculation']) or (isset($_POST['immatriculation']) and (!$present))) {
?>
<div class="container-fluid">
    <div class="row">
        <?php include "inc/side-bar.html"; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Modifier un véhicule</h1>

            <!-- Form Template from ColorLib.com -->
            <div class="container">
                <form id="contact" action="modify-vehicule.php" method="post">
                    <h3>Informations Véhicule</h3>
                    <h4>Indiquez d'abord le N° d'immatriculation du véhicule</h4>
                    <?php if (isset($_POST['immatriculation']) and (!$present)) echo '<h4 style="color:darkred;"> Véhicule inexistant !</h4>'; ?>
                    <fieldset>
                        <input placeholder="N° d'immatriculation du véhicule" type="text" tabindex="1" name="immatriculation" required autofocus>
                    </fieldset>
                    <h4>Renseignez les nouvelles informations</h4>
                    <fieldset>
                        <input placeholder="Marque" type="text" tabindex="2" name="marque" required>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Modèle" type="text" tabindex="3" name="typeVehicule" required>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Année (ex : 2005)" type="number" tabindex="4" name="annee" required>
                    </fieldset>
                    <fieldset>
                        <select name="client" required>
                            <?php
                            $reponse = $bdd->query('SELECT IDclient, nom, prenom, nomCommune FROM clients');
                            while ($donnees = $reponse->fetch()) {
                                echo '<option value="' .$donnees['IDclient']. '">' .$donnees['prenom']. ' ' .$donnees['nom']. ' de ' .$donnees['nomCommune']. '</option>';

                            }
                            ?>
                        </select>
                    </fieldset>
                    <fieldset>
                        <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Ajout</button>
                    </fieldset>
                </form>
            </div>

        </div>
    </div>
</div>
    <?php
}
?>

<?php include "inc/footer-vehicule.html";?>


</body>
</html>
