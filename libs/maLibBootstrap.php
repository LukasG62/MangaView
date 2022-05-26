<?php

include_once "modele.php";
/*
Ce fichier définit diverses fonctions permettant de faciliter la production de mises en formes complexes
Il est utilisé en conjonction avec le style de bootstrap et insère des classes bootstrap
*/

function mkHeadLink($label,$view,$currentView="",$class="")
{
	// fabrique un lien pour l'entête en insèrant la classe 'active' si view = currentView

	// EX: <?=mkHeadLink("Accueil","accueil",$view)
	// produit <li class="active"><a href="index.php?view=accueil">Accueil</a></li> si $view= accueil

	if ($view == $currentView) 
		$class .= " active";
	return "<li class=\"$class\"> <a href=\"index.php?view=$view\">$label</a></li>";
}

function mkError($message) {
	// code inspiré du site W3School
	// https://www.w3schools.com/bootstrap/bootstrap_alerts.asp
	return '<div class="alert alert-danger"><strong>Erreur ! </strong><span>' . $message . '</span> </div>';
}

function mkNews($dataNews, $active="") {
  $news = '<div class="carousel-item' .$active . '"><div class="news-preview">'.
  		  '<a href="index.php?view=news&id=' . $dataNews["id"] . '"><img class="img-fluid" src="' . $dataNews["banner"]. '" /></a>' .
          '<div class="news-preview-text"><p><i class="bi bi-clock"></i> Posté le <b>' . date_format(date_create($dataNews["date"]), "d/m/Y") . '</b> par <b>' . getUserPseudo($dataNews["uid"]) . '</b></p>' .
          '<h1>' . $dataNews["title"] . '</h1>' .
          '<p>' . bbcodeparser(htmlspecialchars($dataNews["content"])) . '</p>' . '</div></div></div>';

  return $news;
}

function mkComment($comments) {
	// Fonction qui consruit un commentaire en HTML
}

function mkReview($review) {
	// Fonction qui construit une review en html
}

function mkCollection($collection, $myprofile) {
	// Fonction qui construit une collection en fonction de la page (si c'est myprofile ou profile)
}



?>
