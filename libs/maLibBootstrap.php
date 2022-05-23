<?php


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

function mkNews($dataNews, $complete = false) {
	// Fonction qui affiche une news
	// Params : data un tableau contenant toutes les info d'une news; complete, si on affiche toute la news ou non

}

function mkComment($comments) {
	// Fonction qui consruit un commentaire
}


?>
