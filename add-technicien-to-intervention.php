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

<?php
        if (isset($_POST['techniciensupplementaire'])) {

            $req1 = $bdd->prepare('INSERT INTO repare(IDtechnicien, IDintervention) VALUES (:IDtechnicien, :IDintervention)');
            $req1->execute(array(
                'IDtechnicien' => $_POST['techniciensupplementaire'],
                'IDintervention' => $_POST['intervention']))
            or die(print_r($req1->errorInfo()));

        }
?>
        <div class="container-fluid">
                <div class="row">
                    <?php include "inc/side-bar.html"; ?>
                    <div class="col-sm-9 col-sm-offset-3 col-md-5 col-md-offset-2 main">
                        <h1 class="page-header">
                            Ajouter un technicien à une intervention.
                        </h1>
                        <div class="container">
                            <form id="contact" action="add-technicien-to-intervention.php" method="post">
                                <h4>Allez sur le Dashboard Interventions pour connaitre l'ID :</h4>
                                <fieldset>
                                    <input placeholder="ID de l'intervention" type="number" tabindex="1" name="intervention" required autofocus>
                                </fieldset>
                                <h4>Choisissez le technicien en charge :</h4>
                                <fieldset>
                                    <select name="techniciensupplementaire" required>
                                        <?php
                                        $reponse = $bdd->query('SELECT IDtechnicien, nom, prenom FROM techniciens');
                                        while ($donnees = $reponse->fetch()) {
                                            echo '<option value="' .$donnees['IDtechnicien']. '">' .$donnees['nom']. ' ' .$donnees['prenom']. '</option>';
                                        }
                                        ?>
                                    </select>
                                </fieldset>
                                <fieldset>
                                    <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Valider</button>
                                </fieldset>
                            </form>
                            <?php
                            if (isset($_POST['techniciensupplementaire'])) {?>
                                <h4 style="color:darkred;">Technicien ajouté avec succès !</h4>
                           <?php };?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include "inc/footer-affectation.html";?>

</body>
</html>

