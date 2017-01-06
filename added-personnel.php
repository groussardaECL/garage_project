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
    <link href="css/form.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<?php include "inc/header.html"; ?>

<?php
if ( $_SERVER['REQUEST_METHOD'] != 'POST' ) die ('Illegal call');

$job=$_POST['job'];

if ($job!='referents') {

    $req1 = $bdd->prepare('INSERT INTO techniciens(nom, prenom) VALUES (:nom, :prenom)');
    $req1->execute(array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
    ));

};

if ($job!='techniciens') {

    $req2 = $bdd->prepare('INSERT INTO referents(nom, prenom) VALUES (:nom, :prenom)');
    $req2->execute(array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
    ));

};

?>

<div class="container-fluid">
    <div class="row">
        <?php include "inc/side-bar.html"; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">
                Employé ajouté!
            </h1>

            <div class="col-xs-6 col-sm-3 placeholder">
                <a href="personnel-dashboard.php">
                    <img src="img/staff.png" width="200" height="200" class="img-responsive bw" alt="Accés au personnel">
                </a>
                <h4> L'employé
                    <?php
                    echo $_POST['prenom'].' '.$_POST['nom'];
                    ?>
                    a bien été ajouté à la base de données.
                </h4>
                <a href="add-personnel.php" class="text-muted">Ajouter un autre employé</a> | <a href="modify-personnel.php" class="text-muted">Modifier un employé</a> | <a href="find-personnel.php" class="text-muted">Rechercher</a>
            </div>
        </div>
    </div>
</div>
<?php include "inc/footer-personnel.html";?>
</body>
</html>