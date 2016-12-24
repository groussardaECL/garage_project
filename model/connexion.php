<?php

/** Connexion à la base de données, avec récupération et affichage de l'erreur */

try
{
    $bdd = new PDO('mysql:host=localhost:3306;dbname=bdd_garage','application','asqs5d654q8h6qd6');
}
catch (Exception $e)
{
    die ('Une erreur lors de la connexion à la base de données est survenue : ' $e->getMessage());
}

/**
 * Created by PhpStorm.
 * User: GROUSSARD
 * Date: 21/12/2016
 * Time: 21:36
 */