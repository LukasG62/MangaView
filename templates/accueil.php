<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
// Pas de soucis de bufferisation, puisque c'est dans le cas où on appelle directement la page sans son contexte
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=accueil");
	die("");
}
?>

<br />
<div class="container mv-pagebase">
  <div id="carouselExampleIndicators" class="carousel slide carousel-inner" data-ride="carousel">
	<div class="carousel-inner">
	  <div class="carousel-item active">
		<div class="news-preview">
		  <img class="img-fluid" src="https://www.manga-news.com/public/dossier/Dossier-jumbor-angzengbang.jpg">
		  <div class="news-preview-text">
			<p>
			  <i class="bi bi-clock">
			  </i> Posté le <b>20/20/2022</b> par <b>Auteur</b>
			  </p><h1>TITRE SUPER SYMPA</h1><p>
			  Tandis que la diffusion de la deuxième saison de l'adaptation animée du manga Rent-A-Girlfriend approche à grands pas, l'œuvre de Reiji Miyajima sera aussi portée en série live cet été.
			  <br />
			  <br />
			  Prévue pour le mois de juillet, soit le même mois que la deuxième saison de l'anime, la série live sera diffusée sur TV Asahi pour le Kanto et sur ABC TV pour le Kansai. Dirigée par Daisuke Yamamoto et Kazunori Ima, elle est scénarisée par Kumiko Asô, en se basant sur le manga d'origine de Reiji Miyajima.
			  <br />
			  <br />
			  Côté casting, les deux têtes d'affiche ont été dévoilées. Ainsi, Kazuya Kinoshita, le protagoniste, sera incarné par l'idole Ryusei Onishi, membre du groupe de musique Naniwa Danshi. Chizuru Mizuhara, la petite amie de location du héros, sera interprétée par l'actrice Hiyori Sakurada. Les deux comédiens ont été dévoilés, dans leurs rôles respectifs, via un premier visuel promotionnel.
			  <br />
			  <br />
			  Lancé en 2017 dans le Shônen Magazine de l'éditeur Kôdansha, sous le titre Kanojo, Okarishimasu, le manga Rent-A-Girlfriend de Reiji Miyajima dénombre actuellement 25 tomes au Japon, le 26e opus étant justement prévu pour demain dans les librairies nippones. De notre côté, la comédie sentimentale est publiée aux éditions Noeve avec 6 opus disponibles. Côté anime, la première saison est disponible en VOD sur Crunchyroll et ADN.
			  <br />
			  <br />
			  Depuis 2020, le manga a droit à un spin-off des mains de Yunkeru : Kanojo, Hitomishirimasu. Centré sur le personnage de Sumi, introduite en fin de cinquième volume, le dérivé sera publié dès ce mois-ci chez nous par Noeve, sous le titre Rent-A-Really-Shy-Girlfriend. Son premier volume sera disponible le 20 mai.
			  <br />
			  <u>Synopsis du manga :
			  </u>
			  <br />
			</p>
		  </div>
		</div>
	  </div>
	</div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	<span class="carousel-control-prev-icon" aria-hidden="true">
	</span>
	<span class="sr-only">Previous
	</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	<span class="carousel-control-next-icon" aria-hidden="true">
	</span>
	<span class="sr-only">Next
	</span>
  </a>
  <br />
  <button type="button" class="btn btn-secondary btn-lg btn-block">Historique des news
  </button>
</div>
