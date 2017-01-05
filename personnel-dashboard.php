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

    <title>Garage - Personnel</title>

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
            <h1 class="page-header">Dashboard - Personnel</h1>

            <div class="container">
                <form id="contact" action="personnel-dashboard.php" method="post">
                    <h3>Choisissez le poste :</h3>
                    <fieldset>
                        <select name="job" required>
                            <?php
                            echo '<option value="techniciens">Techniciens</option><option value="referents">Référents</option>';
                            ?>
                        </select>
                    </fieldset>
                    <fieldset>
                        <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Valider</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div class="container">
            <?php if (isset($_POST['job'])) { ?>
            <?php $job = $_POST['job']; ?>
            <h3 class="sub-header">Liste des
                <?php if ($job != 'referents') {
                    echo 'techniciens';
                };
                if ($job != 'techniciens') {
                    echo 'référents';
                }; ?></h3>
            <div class="table-responsive col-md-8">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID <?php if ($job != 'referents') {
                                echo 'techniciens';
                            };
                            if ($job != 'techniciens') {
                                echo 'référents';
                            }; ?></th>
                        <th>Nom</th>
                        <th>Prénom</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        if ($job != 'referents') {
                            $reponse = $bdd->query('SELECT IDtechnicien, t.nom as nomt, t.prenom as prenomt FROM techniciens as t;');
                            while ($donnees = $reponse->fetch() OR $donnees2 = $reponse->fetch()) {
                                echo '<tr>';
                                echo '<td>' . $donnees['IDtechnicien'] . '</td>';
                                echo '<td>' . $donnees['nomt'] . '</td>';
                                echo '<td>' . $donnees['prenomt'] . '</td>';
                                echo '<td>';
                                echo '</tr>';
                            }
                        };
                        if ($job != 'techniciens') {
                            $reponse = $bdd->query('SELECT IDreferent, r.nom as nomr, r.prenom as prenomr FROM referents as r;');
                            while ($donnees = $reponse->fetch() OR $donnees2 = $reponse->fetch()) {
                            echo '<tr>';
                            echo '<td>' . $donnees['IDreferent'] . '</td>';
                            echo '<td>' . $donnees['nomr'] . '</td>';
                            echo '<td>' . $donnees['prenomr'] . '</td>';
                            echo '<td>';
                            echo '</tr>';
                        }
                        };
                        /**echo '<a class="delete" href="delete.php?ID='.$a['ID'].'"'.
                         * ' onclick="return confirm(\'Voulez-vous vraiment supprimer ces Jeux Olympiques ?\')")>X</a>&nbsp;';
                         * echo '<a href="detail.php?ID='.$a['ID'].'">'.$a['Annee'].'</a>';
                         * echo '</td>'; */
                    };
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>