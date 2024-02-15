<?php // code php php qui décide de ce qu'il faut donner comme valeur à la variable $template

    //appel au controller
    require_once("models/schoolModel.php");    
    // on ajoutera par la suite les require aux modèle 

    // récupération du chemin désiré
    $uri = $_SERVER["REQUEST_URI"];

    if ($uri === "/index.php" || $uri === "/") {
        //récupérer toutes les données de la table school
        $schools = selectAllSchools($pdo);
       

        $title = "Page d'accueil";
        $template = "views/pageAccueil.php";
        require_once("views/base.php");
    }