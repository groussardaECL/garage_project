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

    <title>Garage - Personnel</title>

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
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Ajout d'un employé</h1>

            <!-- Form Template from ColorLib.com -->
            <div class="container">
                <form id="contact" action="added-personnel.php" method="post">
                    <h3>Informations Employé</h3>
                    <h4>Renseignez tous les champs</h4>
                    <fieldset>
                        <input placeholder="Nom" type="text" tabindex="1" name="nom" required autofocus>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Prénom" type="text" tabindex="2" name="prenom" required>
                    </fieldset>
                    <h4>Choisissez le rôle :</h4>
                    <fieldset>
                        <select name="job" required>
                            <?php
                            echo '<option value="techniciens">Technicien</option><option value="referents">Référent</option>';
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

<?php include "inc/footer-personnel.html";?>


</body>
</html>