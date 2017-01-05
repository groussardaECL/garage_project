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

<?php
$req = $bdd->query('SELECT * FROM vehicules')->fetchAll();
$present = false;

foreach ($req as $elem) {                           // Vérification dans la base de données si le pays existe déjà
    if ($elem['immatriculation'] == $_POST['immatriculation']) {
        $present = true;
        break;
    }
}

if (!$present) {

    if ($_SERVER['REQUEST_METHOD'] != 'POST') die ('Illegal call');

    $req1 = $bdd->exec('INSERT INTO vehicules(immatriculation, typeVehicule, marque, annee) VALUES (\''
        . $_POST['immatriculation'] . '\',\''
        . $_POST['typeVehicule'] . '\',\''
        . $_POST['marque'] . '\','
        . $_POST['annee'] . ');');

    $req2 = $bdd->prepare('INSERT INTO appartient(IDclient, immatriculation) VALUES(:IDclient, :immatriculation)');
    $req2->execute(array(
        'IDclient' => $_POST['client'],
        'immatriculation' => $_POST['immatriculation'],
    )) or die(print_r($req2->errorInfo()));
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include "inc/side-bar.html"; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">
                <?php if ($present) echo 'Véhicule déjà présent dans la base de données !'; ?>
                <?php if (!$present) echo 'Véhicule ajouté !'; ?>
            </h1>

                <div class="col-xs-6 col-sm-3 placeholder">
                    <a href="vehicules-dashboard.php">
                        <img src="img/car.png" width="200" height="200" class="img-responsive bw" alt="Accés aux véhicules">
                    </a>
                    <h4>
                        <?php if ($present) echo 'Le véhicule immatriculé <b>'.$_POST['immatriculation'].'</b> appartient à '; ?>
                        <?php if (!$present) echo 'Le véhicule immatriculé <b>'.$_POST['immatriculation'].'</b> appartenant à '; ?>
                        <?php
                        $reponse = $bdd->query("SELECT nom, prenom FROM clients WHERE IDclient='$_POST[client]'");
                        $donnees = $reponse->fetch();
                        echo $donnees['prenom'].' '.$donnees['nom'];
                        ?>
                        <?php if (!$present) echo 'a bien été enregistré dans la base de données.'; ?>
                    </h4>
                    <a href="add-vehicule.php" class="text-muted">Ajouter un autre véhicule</a> | <a href="modify-vehicule.php" class="text-muted">Modifier un véhicule</a> | <a href="find-vehicule.php" class="text-muted">Rechercher</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>