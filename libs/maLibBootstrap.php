<?php
//
//
// TODO
// -> mkCollection
// -> mkPageSerie : mettre un offset de 2 quand il n'y que 2 séries sur une ligne et un offset de 4 quand y'en a qu'une
// -> changer les fonction pour faire moins de requete sql
//
include_once "modele.php";
include_once "LibMangaview.php";

define("NBSERIESBYPAGE", 16);
define("NBSERIESBYROW", 4);

/*
Ce fichier définit diverses fonctions permettant de faciliter la production de mises en formes complexes
Il est utilisé en conjonction avec le style de bootstrap et insère des classes bootstrap
*/

function mkHeadLink($label,$view,$currentView="",$class="", $icon="")
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

function mkSuccess($message) {
	return '<div class="alert alert-success"><strong>Succès ! </strong><span>' . $message . '</span> </div>';	
}

function mkInfo($message) {
	return '<div class="alert alert-info"><strong>Information : </strong><span>' . $message . '</span> </div>';	
}

function mkNews($dataNews, $active="", $carousel = "carousel-item") {
  global $uploadInfo;

  $news = '<div class="' . $carousel .' '. $active . '"><div class="news-preview">'.
  		  '<a href="index.php?view=news&id=' . $dataNews["id"] . '"><img class="img-fluid" src="' . $uploadInfo["NEWSPATH"] . $dataNews["banner"]. '" /></a>' .
          '<div class="news-preview-text"><p><i class="bi bi-clock"></i> Posté le <b>' . date_format(date_create($dataNews["date"]), "d/m/Y") . '</b> par <b>' . $dataNews["userPseudo"] . '</b></p>' .
          '<h1>' . $dataNews["title"] . '</h1>' .
          '<p>' . bbcodeparser(htmlspecialchars($dataNews["content"])) . '</p>' . '</div></div></div>';

  return $news;
}
//toggle_edit(refEdit, idComment, type, qsId)
function mkComment($dataComment, $writeByUser = 0, $isUserAdmin = 0, $type) {
	global $uploadInfo;
	$id = "";
	switch($type) {
		case "news":
			$id = "nid";
		break;

		case "serie":
			$id = "mid";
		break;

		case "tome":
			$id = "vid";
		break;
	}


	$edit = "";
	if($writeByUser) $edit .= "<i class=\"bi bi-pencil-fill\" onclick=\"toggle_edit(this, $dataComment[id], '$type', $dataComment[$id])\"></i> ";
	if($writeByUser || $isUserAdmin) $edit .= "<a href=\"controleur.php?action=deleteComment&id=$dataComment[id]\"><i class=\"bi bi-x-circle-fill\"></i></a>";

	$comment = '<div class="comment-widgets m-b-20"><div class="d-flex flex-row comment-row">' .
			   '<div class="p-2"><span class="round"><img src="' . $uploadInfo["USERSPATH"] . ($dataComment["avatarValided"] ? $dataComment["userAvatar"] : "default.png") . '" alt="user" width="100"></span></div>' .
			   '<div class="comment-text w-100"><h5>' . $dataComment["userPseudo"] . ' : ' . $edit . '</h5>' .
			   '<p class="m-b-5 m-t-10">' . bbcodeParser(htmlspecialchars($dataComment["comment"])) .'</p></div></div></div>';

	return $comment;
}

function mkReview($dataReview) {
	global $uploadInfo;

	$color = "color:green;";
	if($dataReview["note"] == 5) 
		$color = "color:darkorange;";
	else if($dataReview["note"] < 5) $color = "color:red;";

	$review = '<div class="mv-review container"><div class="row"><div class="col-md-2"><div class="avatar-review">' .
			  '<a href="index.php?view=profile&id=' . $dataReview["uid"] . '">' . 
			  '<div class="p-2"><span class="round"><img width="150" height="150" src="'. $uploadInfo["USERSPATH"] . ($dataReview["avatarValided"] ? $dataReview["userAvatar"] : "default.png").'" alt="User avatar"/></a></span></div>' .
			  '<h4>' . $dataReview["userPseudo"] . '</h4>' .
			  '<h5 style="' . $color . '">' . $dataReview["note"] . '/10</h5></div></div><div class="col-md-8"><p>' .
			  bbcodeParser(htmlspecialchars($dataReview["content"])) . '</p></div></div></div>';

	return $review;
}

function mkVolumeCollection($dataVolume, $myprofile) {
	// Créer un volume dans une collection 

	global $uploadInfo;
	$changecollection = "";

	// Si c'est le profil de l'utilisateur connecté alors on ajoute les élément de commande (supprimer, mettre en favoris)
	if($myprofile) {
		$changecollection = '<h5><a href="controleur.php?action=addToFav&id=' . $dataVolume["id"]. '"><i class="bi bi-star-fill"></i></a>' . 
		                    ' <a href="controleur.php?action=removeToCollection&id=' .$dataVolume["id"]. '"><i class="bi bi-x-circle-fill"></i></a></h5>';
	}

	$volume = '<div class="mv-volume-col col-3 mx-auto"><div class="mv-volume-container"><a href="index.php?view=tome&id=' . $dataVolume["id"] . '">' . 
	          '<img src="' . $uploadInfo["VOLUMESPATH"] . $dataVolume["cover"] . '" alt="couverture tome"/></a><div>' .
			  '<h4>' . htmlspecialchars($dataVolume["title"]) . '</h4>' . $changecollection .'</div></div></div>';
	
	return $volume;
	

}

function mkCollection($collectionbySeries, $myprofile, $fav=0) {
	// créer une collection
	// prends un tableau de volumme regrouper par séries 
	global $uploadInfo;



	//Creation de l'accordion
	$collection = '<div class="collection-accordion" id="collectionAccordion">';

	//Creation des cartes
	foreach($collectionbySeries as $dataSeries) {
		$collaspeId = 'collapse' . $dataSeries[0]["mid"] . ($fav ? "-fav" : "");
		$imgpath = $uploadInfo["SERIESPATH"] . $dataSeries[0]["banner"];
		//Creation du header d'un cartes
		$collection .= '<div class="card">
							<button type="button" class="btn btn-link" data-toggle="collapse" data-target="#' . $collaspeId .'">
								<div class="mv-collection-banner"><img class="card-img-top" src="' . $imgpath . '" alt="series banner" /></div>
							</button>
							<div class="card-body collapse" id="' . $collaspeId. '" data-parent="#collectionAccordion">
							<div class="mv-collection-listTome">';
		//Creation du contenu d'une carte
		$volumeRows = array_chunk($dataSeries, 4, true);
		foreach($volumeRows as $volumeRow) {
			$collection .= '<div class="mv-collection-row row">';
			foreach($volumeRow as $dataVolume) {
				$collection .= mkVolumeCollection($dataVolume, $myprofile);
			}
			$collection .= "</div></div></div>";
		}
		$collection .= "</div>";
	}

	return $collection;
}

function mkSearchSeries($dataSeries) {
	// Fonction qui construit l'affichage d'une serie dans la vue liste de mangas
	global $uploadInfo;

	$series = '<div class="mv-series-col col-3 mx-auto"><div class="mv-series-container"><a href="index.php?view=manga&id=' . $dataSeries["id"] . '">' . 
	          '<img src="' . $uploadInfo["VOLUMESPATH"] . $dataSeries["cover"] . '" alt="couverture dernier tome"/></a><div>' .
			  '<h4>' . htmlspecialchars($dataSeries["titre"]) . '</h4>' .
			  '<h5 style="' . getStatusColor($dataSeries["status"]) .'">' . getStatusLabel($dataSeries["status"]). '</h5></div></div></div>';
	
	return $series;
}

function mkSearchPage($partionedSeriesList, $page, $nbPages, $tabQs) {
	// Fonction qui construit la vue de recherche en fonction du numéro de page
	$series = "";
	$seriesRows = array_chunk($partionedSeriesList[$page], NBSERIESBYROW); // on affiche 3 séries par ligne

	// Affichage des séries 3 par ligne avec 15 séries par pages (donner par le partionedSeriesList)
	foreach($seriesRows as $seriesList) {
		$series = $series . '<div class="mv-series-row row">';
		foreach($seriesList as $dataSeries) {
			$series = $series . mkSearchSeries($dataSeries);
		}
		$series = $series . '</div>';
	}

	//// Gestion de la barre de navigation
	
	// Ajout de la commande previous dans la barre de navigation des pages
	$series = $series . '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">' .
	          '<li class="page-item ' . (($page == 0) ? "disabled" : "") .'">' . 
			  '<a class="page-link" href="index.php?'  . http_build_query($tabQs) . "&page=" . ($page-1) .'" aria-label="Previous"><span aria-hidden="true">&laquo;</span>' .
			  '<span class="sr-only">Previous</span></a></li>';

	// Ajout de toutes les pages avec les liens vers les pages
	for($i=0; $i < $nbPages; $i++) {
		$series .= '<li class="page-item ' . (($page == $i) ? "active" : "") . '"><a class="page-link" href="index.php?' . http_build_query($tabQs) . "&page=" . $i . '">' . ($i+1) . '</a></li>';
	}

	// Ajout de la commande next dans la barre de navigation des pages
	$series .=  '<li class="page-item ' . (($page+1 == $nbPages) ? "disabled" : "") .'">' .
	            '<a class="page-link" href="index.php?' . http_build_query($tabQs) . "&page=" . ($page+1) . '" aria-label="Next">' .
				'<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li></ul></nav>';


	return $series;

}


?>
