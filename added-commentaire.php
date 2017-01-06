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
if ( $_SERVER['REQUEST_METHOD'] != 'POST' ) die ('Illegal call');

$ecriture = $bdd->prepare('INSERT INTO commentaires(IDintervention, IDtechnicien, commentaire, dateHeureCommentaire) VALUES (:IDintervention, :IDtechnicien, :commentaire, :dateHeureCommentaire)');
$ecriture->execute(array(
    'IDintervention' => $_POST['intervention'],
    'IDtechnicien' => $_POST['technicien'],
    'commentaire' => $_POST['commentaire'],
    'dateHeureCommentaire' => NOW()))
     or die(print_r($ecriture->errorInfo()));
?>

<div class="container-fluid">
    <div class="row">
        <?php include "inc/side-bar.html"; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">
                Client ajouté !
            </h1>

            <div class="col-xs-6 col-sm-3 placeholder">
                <a href="client-dashboard.php">
                    <img src="img/client.png" width="200" height="200" class="img-responsive bw" alt="Accés aux clients">
                </a>
                <h4> Le commentaire a bien été ajouté à la base de données.
                </h4>
                <a href="add-client.php" class="text-muted">Ajouter un autre client</a> | <a href="modify-client.php" class="text-muted">Modifier un client</a> | <a href="find-client.php" class="text-muted">Rechercher</a>
            </div>
        </div>
    </div>
</div>
</div>

</body>

</html>