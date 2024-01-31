<?php 

//fonction createUser. But : ajouter les données encodées par l'utilisateur dans la table des utilisateurs 

function createUser($pdo) 
{
    try {
        //définition de la requête d'insertion en utilisant la notion de paramètre 
        $query = 'insert into utilisateurs (nomUser, prenomUser, loginUser, passwordUser, emailUser, role)
        values (:nomUser, prenomUser, loginUser, passwordUser, emailUser, role) ';
        //préparation de la requête 
        $ajouterUser = $pdo->prepare($query) ;
        //éxecution en attribuant les valeurs récupérées dans le formulaire aux paramètres 
        $ajouterUser->execute( [
            'nomUser' => $_POST["nom"],
            'prenomnomUser' => $_POST["prenom"],
            'loginUser' => $_POST["login"],
            'passWordUser' => $_POST["mot_de_passe"],
            'emailUser' => $_POST["email"],
            'role' => 'user'
        ]);
    } catch (PDOEXCEPTION $e) {
        $message = $e->getMessage();
        die($message);
    }
}


//fonction connectUser. But : rechercher les données de l'utilisateur dans la base de données pour les mémoriser dans la variable session  

function connectUser($pdo)
{
    try {
        //définition de la requête select en utilisant la notion de paramètre
        $query = 'select * from utilisateurs where loginUser = :loginUser and passWordUser = :passWordUser';
        //préparation de la requête 
        $connectUser = $pdo->prepare($query) ;
        //exécution en attribuant les valeurs récupérées dans le formulaire aux paramètres 
        $connectUser->execute([
            'loginUser' => $_POST["login"],
            'passWordUser' => $_POST["mot_de_passe"]
        ]);
        //stockage des données trouvées dans la variable $user
        $user = $connectUser->fetch();
        if (!$user) {
            return false;
        }
        else {
            //ajout de celle-ci à la variable session
            $_SESSION["user"] = $user;
            return true;
        }
    } catch (PDOEXCEPTION $e) {
        $message = $e->getMessage();
        die($message);
    }
}

// fonction verifEmptyData. But : remplir et envoyer un tableau associatif $messageError dont les clés sont les noms des champs avec un message rappelant que le champ concerné est vide, ou renvoyer false si on n'a pas rencontré d'erreurs.

function verifEmptyData()
{

    foreach ($_POST as $key => $value) {
        //str-replace remplace une chaine par une autre dans une chaine de caractères donnée, ici un espace par le vide dans $value.

        if (empty(str_replace(' ', '', $value))) {
            //on remplit un tableau associatif $messageError dont les clés sont les noms des champs avec un message rappelant que le champs concerné est vide.
            $messageError[$key] = "Votre" . $key . " est vide.";
        }
    }

    if (isset($messageError)) {
        return $messageError;
    } else {
        return false;
    }
}