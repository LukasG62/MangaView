<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
// Pas de soucis de bufferisation, puisque c'est dans le cas où on appelle directement la page sans son contexte
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=accueil");
	die("");
}

//$news = getNews();

// TEMPORAIRE POUR TEST LE CARROUSEL SANS LE MODELE A RETIRER DÉS QUE MODELE PRÊT
$news = [0=>["uid" => 1,
             "date"=> "2022-05-26",
		     "title"=> "TEST 1",
		     "content"=>"Tandis que la diffusion de la deuxième saison de l'adaptation animée du manga Rent-A-Girlfriend approche à grands pas, l'œuvre de Reiji Miyajima sera aussi portée en série live cet été.\n\nPrévue pour le mois de juillet, soit le même mois que la deuxième saison de l'anime, la série live sera diffusée sur TV Asahi pour le Kanto et sur ABC TV pour le Kansai. Dirigée par Daisuke Yamamoto et Kazunori Ima, elle est scénarisée par Kumiko Asô, en se basant sur le manga d'origine de Reiji Miyajima.\n\nCôté casting, les deux têtes d'affiche ont été dévoilées. Ainsi, Kazuya Kinoshita, le protagoniste, sera incarné par l'idole Ryusei Onishi, membre du groupe de musique Naniwa Danshi. Chizuru Mizuhara, la petite amie de location du héros, sera interprétée par l'actrice Hiyori Sakurada. Les deux comédiens ont été dévoilés, dans leurs rôles respectifs, via un premier visuel promotionnel.\n\nLancé en 2017 dans le Shônen Magazine de l'éditeur Kôdansha, sous le titre Kanojo, Okarishimasu, le manga Rent-A-Girlfriend de Reiji Miyajima dénombre actuellement 25 tomes au Japon, le 26e opus étant justement prévu pour demain dans les librairies nippones. De notre côté, la comédie sentimentale est publiée aux éditions Noeve avec 6 opus disponibles. Côté anime, la première saison est disponible en VOD sur Crunchyroll et ADN.\nDepuis 2020, le manga a droit à un spin-off des mains de Yunkeru : Kanojo, Hitomishirimasu. Centré sur le personnage de Sumi, introduite en fin de cinquième volume, le dérivé sera publié dès ce mois-ci chez nous par Noeve, sous le titre Rent-A-Really-Shy-Girlfriend. Son premier volume sera disponible le 20 mai.\n\n[u]Synopsis du manga :[/u]\n\nKazuya Kinoshita, 20 ans, étudiant, vient de se faire larguer. Un déboire de plus dans la vie de ce garçon maladroit et malchanceux. Désespéré, il installe l’application Diamond, qui permet de faire appel aux services d’une petite amie de location. C’est la belle et inaccessible Chizuru Mizuhara qui se présente à leur premier rendez-vous... et si cette rencontre changeait la donne pour Kazuya ?\n\n[b][url=https://natalie.mu/comic/news/477410]Source[/url][/b]",
		     "banner"=>"1.png",
		     "id" => 0],
		 1=>["uid" => 1,
             "date"=> "2022-05-25",
		     "title"=> "TEST 2",
			 "content" => "Non mais c trop bien vu que ça marchera",
		     "banner"=>"1.png",
		     "id" => 1],
		 2=>["uid" => 1,
             "date"=> "2022-05-24",
		     "title"=> "TEST 3",
			 "content" => "Lorem ipsum .... ",
		     "banner"=>"1.png",
		     "id" => 2],
		 3=>["uid" => 1,
             "date"=> "2022-05-23",
		     "title"=> "TEST 4",
			 "content" => "Lorem ipsum .... ",
		     "banner"=>"1.png",
		     "id" => 2],		    
		];

?>

<br />
<br />
<div class="container mv-pagebase">
  <div id="carouselExampleIndicators" class="carousel slide carousel-inner" data-ride="carousel">
  <div class="carousel-inner">
  	<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	  <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
	</a>
	<?php
		$active = "active";
		$i = 0;
		foreach($news as $dataNews) {
			echo mkNews($dataNews,$active);
			$i++;
			$active = "";
			if($i == 3) break;

		}
	?>
  </div>
</div>
<br />
<a href="index.php?view=newshistory"><button type="button" class="btn btn-secondary btn-lg btn-block">Historique des news</button></a>
</div>