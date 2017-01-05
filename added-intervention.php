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

<?php if (isset($_POST['immatriculation'])) { ?>

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

        if ($_SERVER['REQUEST_METHOD'] != 'POST') die ('Illegal call');

        $repa = $_POST['reparation'];

        if ($repa != 'forfaitaire') {

            $req1 = $bdd->prepare('INSERT INTO interventions(typeIntervention, Designation, prixPiece, prixMainOeuvre, kilometrage, dateArrivee, immatriculation) VALUES (:typeIntervention, :Designation, :prixPiece, :prixMainOeuvre, :kilometrage, :dateArrivee, :immatriculation)');
            $req1->execute(array(
                'typeIntervention' => $_POST['forfait'],
                'Designation' => $_POST['Designation'],
                'prixPiece' => $_POST['pieces'],
                'prixMainOeuvre' => $_POST['mdo'],
                'kilometrage' => $_POST['km'],
                'dateArrivee' => $_POST['date'],
                'immatriculation' => $_POST['immatriculation'],
            )) or die(print_r($req1->errorInfo()));

        };

        if ($repa != 'nonforfaitaire') {

            $req2 = $bdd->query("SELECT prixForfait FROM forfaits WHERE typeIntervention='$_POST[forfait]'");
            $donnees = $req2->fetch();

            $req3 = $bdd->prepare('INSERT INTO interventions(typeIntervention, Designation, prixPiece, prixMainOeuvre, kilometrage, dateArrivee, immatriculation) VALUES (:typeIntervention, :Designation, :prixPiece, :prixMainOeuvre, :kilometrage, :dateArrivee, :immatriculation)');
            $req3->execute(array(
                'typeIntervention' => $_POST['forfait'],
                'Designation' => 'NULL',
                'prixPiece' => 0,
                'prixMainOeuvre' => 0,
                'kilometrage' => $_POST['km'],
                'dateArrivee' => $_POST['date'],
                'immatriculation' => $_POST['immatriculation'],
            )) or die(print_r($req3->errorInfo()));

        };


        $req4 = $bdd->query("SELECT MAX(IDintervention) FROM interventions");
        $donnees4 = $req4->fetch();

        $req5 = $bdd->prepare('INSERT INTO repare(IDtechnicien, IDintervention) VALUES (:IDtechnicien, :IDintervention)');
        $req5->execute(array(
            'IDtechnicien' => $_POST['technicien'],
            'IDintervention' => $donnees4['MAX(IDintervention)']));
    ?>
        <div class="container-fluid">
            <div class="row">
                <?php include "inc/side-bar.html"; ?>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h1 class="page-header">
                        Intervention enregistrée !
                    </h1>
                    <div class="col-xs-6 col-sm-3 placeholder">
                        <a href="interventions-dashboard.php">
                            <img src="img/tools.png" width="200" height="200" class="img-responsive bw"
                                 alt="Accés aux interventions">
                        </a>
                        <h4> L'intervention sur le véhicule immatriculé
                            <?php
                            echo $_POST['immatriculation'];
                            ?>
                            a été enregistrée.
                        </h4>
                        <a href="add-intervention.php" class="text-muted">Ajouter une autre intervention</a> | <a
                            href="modify-intervention.php" class="text-muted">Modifier</a> | <a
                            href="find-intervention.php" class="text-muted">Rechercher</a>
                    </div>
                </div>
            </div>
        </div>
    <?php };
        if (!$present) {
        ;
        ?>
        <div class="container-fluid">
            <div class="row">
                <?php include "inc/side-bar.html"; ?>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h1 class="page-header">
                        Echec de l'enregistrement !
                    </h1>
                    <div class="col-xs-6 col-sm-3 placeholder">
                        <a href="interventions-dashboard.php">
                            <img src="img/tools.png" width="200" height="200" class="img-responsive bw"
                                 alt="Accés aux interventions">
                        </a>
                        <h4> Le véhicule immatriculé
                            <?php
                            echo $_POST['immatriculation'];
                            ?>
                            n'existe pas dans la base de données.
                        </h4>
                        <a href="add-intervention.php" class="text-muted">Ajouter une autre intervention</a> | <a
                            href="modify-intervention.php" class="text-muted">Modifier</a> | <a
                            href="find-intervention.php" class="text-muted">Rechercher</a>
                    </div>
                </div>
            </div>
        </div>
    <?php };
};?>
</body>
</html>

