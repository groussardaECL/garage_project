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

    <title>Garage - Forfaits</title>

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

<?php if (isset($_POST['typeIntervention'])) {?>

    <?php
    $req = $bdd->query('SELECT * FROM forfaits')->fetchAll();
    $present = false;

    foreach ($req as $elem) {
        if ($elem['typeIntervention'] == $_POST['typeIntervention']) {
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
                    Forfait modifié !
                </h1>
                <div class="col-xs-6 col-sm-3 placeholder">
                    <a href="forfaits.php">
                        <img src="img/forfait.png" width="200" height="200" class="img-responsive bw"
                             alt="Accés aux forfaits">
                    </a>
                    <h4>
                        <?php echo 'Le forfait "<b>' . $_POST['typeIntervention'] . '</b>" a bien été modifié.';
                        ?>
                    </h4>
                </div>
            </div>
        </div>
    </div>

<?php

    if ($_SERVER['REQUEST_METHOD'] != 'POST') die ('Illegal call');

    $req1 = $bdd->prepare("UPDATE forfaits SET typeIntervention =:typeIntervention, prixForfait =:prixForfait WHERE typeIntervention='$_POST[typeIntervention]'");
    $req1->execute(array(
        'typeIntervention' => $_POST['typeIntervention'],
        'prixForfait' => $_POST['prixForfait']));
}?>

<?php }

if (!isset($_POST['typeIntervention']) or (isset($_POST['typeIntervention']) and (!$present))) {
?>
<div class="container-fluid">
    <div class="row">
        <?php include "inc/side-bar.html"; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Modifier un forfait</h1>

            <!-- Form Template from ColorLib.com -->
            <div class="container">
                <form id="contact" action="modify-forfait.php" method="post">
                    <h3>Informations Forfait</h3>
                    <h4>Indiquez d'abord le forfait</h4>
                    <fieldset>
                        <select name="typeIntervention" required>
                            <?php
                            $reponse = $bdd->query('SELECT typeIntervention, prixForfait FROM forfaits');
                            while ($donnees = $reponse->fetch()) {
                                echo '<option value="' .$donnees['typeIntervention']. '">' .$donnees['typeIntervention']. '</option>';
                            }
                            ?>
                        </select>
                    </fieldset>
                    <h4>Renseignez le nouveau prix</h4>

                    <fieldset>
                        <input value="<?php echo $donnees['prixForfait']?>" type="number" tabindex="2" name="prixForfait" required>
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
