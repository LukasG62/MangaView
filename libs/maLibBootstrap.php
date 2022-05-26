<?php

include_once "modele.php";
/*
Ce fichier définit diverses fonctions permettant de faciliter la production de mises en formes complexes
Il est utilisé en conjonction avec le style de bootstrap et insère des classes bootstrap
*/

function mkHeadLink($label,$view,$currentView="",$class="nav-item", $icon="")
{
	// fabrique un lien pour l'entête en insèrant la classe 'active' si view = currentView

	// EX: <?=mkHeadLink("Accueil","accueil",$view)
	// produit <li class="active"><a href="index.php?view=accueil">Accueil</a></li> si $view= accueil
	/* <li class="nav-item active">
	<a class="nav-link" href="index.php?view=accueil">Accueil</a>
	</li>*/
	$iconTag = "<i class=\"$icon\"></i>";
	if($icon == "")
		$iconTag = "";

	if ($view == $currentView) 
		$class .= " active";
	return "<li class=\"nav-item $class\"> <a class=\"nav-link\" href=\"index.php?view=$view\">$iconTag $label</a></li>";
}

function mkError($message) {
	// code inspiré du site W3School
	// https://www.w3schools.com/bootstrap/bootstrap_alerts.asp
	return '<div class="alert alert-danger"><strong>Erreur ! </strong><span>' . $message . '</span> </div>';
}

function mkNews($dataNews, $active="") { // TODO : banner à adapter pour les chemins relatifs
  $news = '<div class="carousel-item ' . $active . '"><div class="news-preview">'.
  		  '<a href="index.php?view=news&id=' . $dataNews["id"] . '"><img class="img-fluid" src="' . $dataNews["banner"]. '" /></a>' .
          '<div class="news-preview-text"><p><i class="bi bi-clock"></i> Posté le <b>' . date_format(date_create($dataNews["date"]), "d/m/Y") . '</b> par <b>' . getUserPseudo($dataNews["uid"]) . '</b></p>' .
          '<h1>' . $dataNews["title"] . '</h1>' .
          '<p>' . bbcodeparser(htmlspecialchars($dataNews["content"])) . '</p>' . '</div></div></div>';

  return $news;
}

function mkComment($dataComment) { // TODO : userAvatar à adapter pour les chemins relatifs  + faire le css pour rendre ça plus jolie
	$comment = '<div class="comment-widgets m-b-20"><div class="d-flex flex-row comment-row">' .
			   '<div class="p-2"><span class="round"><img src="' . getUserAvatar($dataComment["uid"]) . '" alt="user" width="100"></span></div>' .
			   '<div class="comment-text w-100"><h5>' . getUserPseudo($dataComment["uid"]) . ' : </h5>' .
			   '<p class="m-b-5 m-t-10">' . bbcodeParser(htmlspecialchars($dataComment["content"])) .'</p></div></div>';

	return $comment;
}

function mkReview($review) {
	// Fonction qui construit une review en html
}

function mkCollection($collection, $myprofile) {
	// Fonction qui construit une collection en fonction de la page (si c'est myprofile ou profile)
}



?>
