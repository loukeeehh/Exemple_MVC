<?php

    function selectAllSchools ($pdo) 
    {

        try {

            //défintiion de la requête
            $query = 'select * from school';

            //préparation de l'éxécution de la requête 
            $selectSchool = $pdo->prepare($query);

            //éxecution
            $selectSchool->execute();

            //récupération des données dans l'objet fetch
            $schools = $selectSchool-> fetchAll();

            //renvoi des données 
            return $schools;

        } catch (PDOException $e) {
            $message = $e-> getMessage();
            die ($message);
        }
    }


    /*
     BUT : supprimer toutes les écoles liées à l'utilisateur connecté dans la table school 
     IN : $pdo reprenant toutes les informations de connexion
    */

    function deleteAllSchoolsFromUser($pdo) {

        try {
            //requête avec critères et paramètre !
            $query = 'delete from school where utilisateurID = :utilisateurID';
            $deleteAllSchoolFromId = $pdo->prepare($query);
            $deleteAllSchoolFromId->execute([
                'utilisateurId' => $_SESSION["user"]-> id
            ]);
        } catch (PDOException $e) {
            $message = $e->getMessage();
            die($message);
        }
    }