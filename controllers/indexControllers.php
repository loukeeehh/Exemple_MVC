<?php


    require_once("models/schoolModel.php");    


    $uri = $_SERVER["REQUEST_URI"];

    if ($uri === "/index.php" || $uri === "/") {

        $schools = selectAllSchools($pdo);


        $title = "Page d'accueil";
        $template = "views/pageAccueil.php";
        require_once("views/base.php");
    }