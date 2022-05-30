<?php

include_once "maLibUtils.php";	// Car on utilise la fonction valider()
include_once "modele.php";	// Car on utilise la fonction connecterUtilisateur()

/**
 * @file login.php
 * Fichier contenant des fonctions de vérification de logins
 */

/**
 * Cette fonction vérifie si le login/passe passés en paramètre sont légaux
 * Elle stocke les informations sur la personne dans des variables de session : session_start doit avoir été appelé...
 * Infos à enregistrer : pseudo, idUser, heureConnexion, isAdmin
 * Elle enregistre l'état de la connexion dans une variable de session "connecte" = true
 * @pre login et passe ne doivent pas être vides
 * @param string $login
 * @param string $password
 * @return false ou true ; un effet de bord est la création de variables de session
 */
function verifUser($pseudo,$password)
{
	
	$userCredentials = getUserCredentials($pseudo);

	if (!$userCredentials) return false;
	if(!password_verify($password, $userCredentials[0]["password"])) return False;

	// Cas succès : on enregistre pseudo, idUser dans les variables de session 
	// il faut appeler session_start ! 
	// Le controleur le fait déjà !!
	$idUser = $userCredentials[0]["id"];
	$_SESSION["pseudo"] = $pseudo;
	$_SESSION["idUser"] = $idUser;
	$_SESSION["connecte"] = true;
	$_SESSION["heureConnexion"] = date("H:i:s");
	$_SESSION["isAdmin"] = isUserAdmin($idUser);
	$_SESSION["isReviewer"] = isUserReviewer($idUser);
	$_SESSION["isBlacklist"] = isUserBlacklist($idUser);

	return true;	
}




/**
 * Fonction à placer au début de chaque page privée
 * Cette fonction redirige vers la page $urlBad en envoyant un message d'erreur 
 * et arrête l'interprétation si l'utilisateur n'est pas connecté
 * Elle ne fait rien si l'utilisateur est connecté, et si $urlGood est faux
 * Elle redirige vers urlGood sinon
 */
function securiser($urlBad,$urlGood=false)
{
	if (! valider("connecte","SESSION")) {
		rediriger($urlBad);
		die("");
	}
	else {
		if ($urlGood)
			rediriger($urlGood);
	}
}

?>
