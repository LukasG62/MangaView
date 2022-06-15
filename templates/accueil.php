<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
// Pas de soucis de bufferisation, puisque c'est dans le cas où on appelle directement la page sans son contexte
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=accueil");
	die("");
}

$news = getNews();


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