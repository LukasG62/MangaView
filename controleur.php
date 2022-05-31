<?php
session_start();

	include_once "libs/maLibUtils.php";
	include_once "libs/maLibSQL.pdo.php";
	include_once "libs/maLibSecurisation.php"; 
	include_once "libs/modele.php"; 

	//$qs = "";
	$tabQs = array();
	
	if ($view = valider("view")) {
	  //$qs = "view=$view";
	  $tabQs["view"] = $view;
	}

	if ($action = valider("action"))
	{
		ob_start ();
		echo "Action = '$action' <br />";
        
		// Un paramètre action a été soumis, on fait le boulot...
		switch($action)
		{

			// Connexion //////////////////////////////////////////////////
			case 'Login' :
			if ($passe = valider("password"))
			if ($user = valider("username"))
			if(verifUser($user,$passe))
			{
				$tabQs["view"] = "accueil";
				$id = valider("idUser","SESSION");
				sessionchange($id,1);
			}
			else {
				$tabQs["view"] = "login";
				$tabQs["msg"] = "Identifiant incorrect !";
			}

			break;
            
            // Deconnexion
			case 'Logout' :
				if ($id = valider("idUser","SESSION"))
				sessionchange($id,0);
				session_destroy();
				$tabQs["view"] = "login";
			break;
            
            
            case "Signin":
			if ($passe = valider("password"))
			if ($user = valider("username"))
            if ($file = valider("fileToUpload","FILES"))
			{			
				$valide = uploadUserAvatar(hash("SHA-1",$user),$uploadInfo);
			}
			switch ($valide) 
			{
				// -1 type de fichier pas bon
    			// -2 taile du fichier pas bon
    			// -3 extension du fichier pas correct
    			// -4 erreur survenu lors de l'upload
    
				case -1 :
					$tabQs["msg"] = "Type de fichier incorrect !";
					$tabQs["view"] = "signup";
				break;

				case -2 :
					$tabQs["msg"] = "Fichier trop grand !";
					$tabQs["view"] = "signup";
				break;

				case -3 :
					$tabQs["msg"] = "Extension de fichier incorrect !";
					$tabQs["view"] = "signup";
				break;

				case -4 :
					$tabQs["msg"] = "Upload failed!";
					$tabQs["view"] = "signup";
				break;

				case 0 :
					$tabQs["msg"] = "Création du compte réussie!";
					$tabQs["view"] = "login";
			
			}
            break;
            
            
            case "AddToCollection" :
            
            break;
            
            
            case "ModifyProfile" :
            
            break;
            
			case "Rechercher":
			case "Trier":

				if($search = valider("search"))
					$tabQs["search"] = $search;
				
				if($sortby = valider("sortby"))
					$tabQs["sortby"] = $sortby;

				if($tags = valider("tag"))
					$tabQs["tag"] = $tags;


				$tabQs["view"] = "series";
			
			break;
            

		}

	}

	// On redirige toujours vers la page index, mais on ne connait pas le répertoire de base
	// On l'extrait donc du chemin du script courant : $_SERVER["PHP_SELF"]
	// Par exemple, si $_SERVER["PHP_SELF"] vaut /chat/data.php, dirname($_SERVER["PHP_SELF"]) contient /chat

	$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
	// On redirige vers la page index avec les bons arguments
  
    rediriger($urlBase, $tabQs, false);
	//header("Location:" . $urlBase . $qs);

	// On écrit seulement après cette entête
	ob_end_flush();
	
?>
