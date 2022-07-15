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
            
            
			//TODO : reflechir sur un refactoring 
            case "Signup":
				$valide = -4 ; // postulat que la validation échoue
				$newid = getLastUserId() + 1; // on récupère le nouvelle id utilisateur

				// Vérification du mot de passe
				if ($passe = valider("password")) { 
					// Contrainte technique lié à bcrypt2
					if(strlen($passe) > 72) {
						$tabQs["view"] = "signup";
						$tabQs["msg"] = "Afin de pouvoir chiffrer le mot de passe il ne doit pas dépasser 72 caractères";
						break;
					}
				}
				// Cas ou il n'y a pas de mot de passe
				else {
					$tabQs["view"] = "signup";
					$tabQs["msg"] = "Mot de passe manquant";
					break;
				}
				// Vérification de pseudo
				if ($user = htmlspecialchars(valider("username"))) {
					// Pseudo déjà utilisé
					if(getUserCredentials($user)) {
						$tabQs["view"] = "signup";
						$tabQs["msg"] = "Ce pseudo est déjà utilisé";
						break;
					}
					// Vérification de la taille du pseudo
					if(strlen($user) > 20 || strlen($user) <= 2) {
						$tabQs["view"] = "signup";
						$tabQs["msg"] = "Votre pseudo doit faire entre 3 et 20 caractères";
						break;
					}
				}
				// Si il n'y a pas de pseudo
				else {
					$tabQs["view"] = "signup";
					$tabQs["msg"] = "Pseudo manquant";
					break;
				}

				// Vérification de l'avatar
				if (isset($_FILES["fileToUpload"]) && is_array($_FILES["fileToUpload"]))
				{	
					// Cas ou il n'y a pas d'avatar : on peut quand même faire un compte	
					if($_FILES["fileToUpload"]["error"] == UPLOAD_ERR_NO_FILE) {
						$tabQs["success"] = "Création du compte réussie!";
						$tabQs["view"] = "login";

						$hashpasse = password_hash($passe, PASSWORD_BCRYPT, ["cost"=>10]);
						createUser($user,$hashpasse,"",0);
						break;

					}
					// Vérification de l'upload
					$valide = uploadUserAvatar(hash("sha1",$newid),$uploadInfo);
					switch($valide["CODE"]) 
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

						case 1 :
							$tabQs["success"] = "Création du compte réussie!";
							$tabQs["view"] = "login";

							$hashpasse = password_hash($passe, PASSWORD_BCRYPT, ["cost"=>10]);
							createUser($user,$hashpasse,"",0,$valide["FILENAME"]);
						break;
					}
				}
            break;
            
            
            case "AddToCollection" :
				$fav = valider("fav");
				if ($idUser = valider("idUser","SESSION"))
				if ($idVolume = valider("id"))
				if (!inCollection($idUser, $idVolume))
				addToCollection($idUser, $idVolume,$fav);
				$tabQs["view"] = "tome";
				$tabQs["id"] = $idVolume;
            break;

			   
            case "addToFav" :
				if($id = valider("id"))
				if($idUser = valider("idUser","SESSION"))
				if($toto = inCollection($idUser, $id))
				if (isfav($idUser,$id)) {
					addfav($idUser,$id,0);
				}
				else
					addfav($idUser,$id,1);
				
				$tabQs["view"] = "profile";
				$tabQs["id"] =  valider("idUser","SESSION");
				break;

				   
				case "removeToCollection" :
					if($id = valider("id"));
					if($idUser = valider("idUser","SESSION"))
					if(inCollection($idUser, $id))
						removecollec($idUser,$id);

					$tabQs["view"] = "profile";
					$tabQs["id"] =  valider("idUser","SESSION");
					break;
            
            
            case "Modifier" :
				if($user = valider("idUser","SESSION")) {
					$destroysession = 0;
					if (($newusername = htmlspecialchars(valider("username"))) && $newusername != valider("pseudo", "SESSION")) {
						if(getUserCredentials($newusername)) {
							$tabQs["view"] = "myprofile";
							$tabQs["msg"] = "Ce pseudo est déjà utilisé";
						}
						else
							if(strlen($newusername) > 20 || strlen($newusername) <= 2) {
								$tabQs["view"] = "myprofile";
								$tabQs["msg"] = "Votre pseudo doit faire entre 3 et 20 caractères";
							}
							else {
								changeUserPseudo($user,$newusername);
								$destroysession = 1;
							}
					}

					if($oldpasse = valider("oldpassword"))
					if($newpasse= valider("newpassword"))
					{
						$datauser = getUser($user)[0];
						$userCredentials = getUserCredentials($datauser["pseudo"]);
						if(strlen($newpasse) > 72) {
							$tabQs["view"] = "myprofile";
							$tabQs["msg"] = "Afin de pouvoir chiffrer le mot de passe il ne doit pas dépasser 72 caractères";
						}
						else 
							if(password_verify($oldpasse, $userCredentials[0]["password"]))
							{
								$destroysession = 1;
								$newpasse = password_hash($newpasse, PASSWORD_BCRYPT, ["cost"=>10]);
								changeUserPassword($user,$newpasse);
							}
							else {
								$tabQs["view"] = "myprofile";
								$tabQs["msg"] = "Mot de passe incorrect";
							}
					}
					if (($file = valider("fileToUpload","FILES")) && is_array($file) && $file["error"] == UPLOAD_ERR_OK)
					{
						$pdp = uploadUserAvatar(hash("sha1",$user),$uploadInfo);
						switch($pdp["CODE"]) 
						{
							case -1 :
								$tabQs["msg"] = "Type de fichier incorrect !";
								$tabQs["view"] = "myprofile";
							break;

							case -2 :
								$tabQs["msg"] = "Fichier trop grand !";
								$tabQs["view"] = "myprofile";
							break;

							case -3 :
								$tabQs["msg"] = "Extension de fichier incorrect !";
								$tabQs["view"] = "myprofile";
							break;

							case -4 :
								$tabQs["msg"] = "Upload failed!";
								$tabQs["view"] = "myprofile";
							break;

							case 1 :
								changeUserAvatarPath($user,$pdp["FILENAME"]);
							break;
						}
					}
					if ($nbio=valider("bio"))
					{
						if(strlen($nbio) > 300) {
								$tabQs["msg"] = "La biographie ne peut pas dépasser 300 caractères";
								$tabQs["view"] = "myprofile";
						}
						else {
							changeUserBio($user, $nbio);
						}
					}
					
					if ($destroysession)
					{
						session_destroy();
						sessionchange($user,0);
						$tabQs["view"] = "login";
						$tabQs["msg"] = "Déconnexion suite à un changement de données utilisateur. Veuillez vous reconnecter";
						break;
					}
					$tabQs["view"] = "myprofile";
				}
            break;

			case "editComment" :
			case "writeComment":
				if ($comment = htmlspecialchars(valider("comment")))
				if ($type = isCommentTypeValid(valider("type")))
				if ($id = valider("id"))
				if ($uid = valider("idUser","SESSION"))
				if(!isUserBlacklist($uid))
					if($action == "writeComment") addComment($uid, $comment, $type, $id);
					else
						if($idComment = valider("idComment")) editComment($uid, $idComment, $type, $comment);
				
				$tabQs["id"] = $id;
				$tabQs["view"] = $type;
			break;

			
			case "editReview" :
			case "writeReview":
				$note =0;
				if ($content = htmlspecialchars(valider("content")))
				if (($note = valider("note")) && (0 <= $note) && ($note <= 10));
			    if ($vid = valider("vid"))
			    if ($uid = valider("idUser","SESSION"))
				if (valider("isReviewer","SESSION"))
				if(strlen($content) <= 1500) {
					if($action == "writeReview") addReview($uid, $content,$note,$vid);
					else
						if($id = valider("id")) editReview($uid, $id, $note, $content);
				}
				$tabQs["view"] = "tome";
			    $tabQs["id"] = $vid;
			break;

			case "deleteComment":
				$isAdmin = valider("isAdmin", "SESSION");
				if($id = valider("id"))
				if($idUser = valider("idUser", "SESSION"))
				if($idComment = valider("idComment"))
				if($type = isCommentTypeValid(valider("type"))) {
					deleteComment($idComment, $idUser, $isAdmin, $type);

					$tabQs["view"] = $type;
					$tabQs["id"] = $id;
					
				}


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