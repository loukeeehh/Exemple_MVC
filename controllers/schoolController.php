<?php

//appel au modèle pour la gestion des écoles 
require_once "models/schoolModel.php";

//récupération du chemin désiré 
$uri = $_SERVER["REQUEST_URI"];

if ($uri === "/mesEcoles") {
    //rappel de la page d'accueil adaptée avec vérification de l'état de connexion 
    $schools = selectMySchools($pdo);

    $title = "Mes écoles";          //titre à afficher dans l'onglet de la page navigateur  
    $template = "views/pageAccueil.php";    //chemin vers la vue demandée 
    require_once("views/base.php");          //appel de la page de base qui sera remplie avec la vue demandée 

} 

else if ($uri === "/createSchool") {

}
// viendront ensuite les opérations sur une école : voir, modifier, supprimer 