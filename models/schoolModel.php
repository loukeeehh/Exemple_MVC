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

    function deleteAllSchoolsFromUser($pdo) 
    {

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

    /* Fonction selectMyschools

    BUT : aller rechercher les caractéristiques des école de l'uitlisateur connecté dans la base de données 
    IN : $pdo reprenant toutes les informations de connexion
    OUT : objet pdo contenant les écoles de l'utilisateur connecté de la base de données 
    */
    
    function selectMySchools($pdo)
    {
        try {
            //requête avec critère et paramètre ! 
            $query = 'select * from school where utilisateurId = :utilisateurId';
            $selectSchool = $pdo->prepare($query);
            $selectSchool->execute([
                // le paramètre est l'id de l'utilisateur connecté 
                'utilisateurId' => $_SESSION["user"]-> id
            ]);
            $schools = $selectSchool->fetchAll();
            return $schools;

        } catch (PDOException $e) {
            $message = $e-> getMessage();
            die ($message);
        }
    }

    
    /* 
    fonction selectAllOptions

    BUT : aller rechercher les caractéristiques de toutes les options disponibles dans la bas de données 
    IN : $pdo reprenant toutes les informations de connexion 
    OUT : objet pdo contenant la liste de toutes les options existantes de la base de données 
    */

    function selectAllOptions($pdo)
    {
        try {
            $query = 'SELECT * FROM optionScolaire';
            $selectOptions = $pdo-> prepare($query);
            $selectOptions-> execute();
            $options = $selectOptions-> fetchAll();
            return $options;

        } catch (PDOException $e) {
            $message = $e->getMessage();
            die($message);
        }
    }


     /* 
    fonction deleteOptionsShollsFromUser

    BUT : supprimer les options des écoles dé l'utilisateur dans la table options
    IN : $pdo reprenant toutes les informations de connexion
    */

    function deleteOptionsSchoolFromUser($dbh)
    {
        try {
            $query = 'delete from option_ecole where schoolId in (select schoolId from school where utlisateurId = :utilisateurId)';
            $deleteAllSchoolsFromId = $dbh-> prepare($query);
            $deleteAllSchoolsFromId-> execute([
                'utilisateurId' => $_SESSION["user"]->id  //utilisateur actif
            ]);
        } catch (PDOException $e) {
            $message = $e->getMessage();
            die($message);
        }
    }

    