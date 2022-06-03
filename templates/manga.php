<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=manga");
	die("");
}

	//TODO REDIRIGER QUAND IDMANGA PAS BON
	$idManga = valider("id", "GET");
	$dataSerie = getSerieInfos($idManga);
	$imgPath = $uploadInfo["SERIESPATH"] . $dataSerie[0]['banner'];

	$listTags = getSerieTags($idManga);
?>

<div class="container mv-pagebase" >
	<h1 class="text_centre"> <?php echo($dataSerie)[0]['titre'] ?></h1>
	
	<div class="row"><img src="<?= $imgPath ?>" alt="banner" class="banner"></div>

	<?php
		$dataFirstTome = getFirstTomeSerie($idManga);
		$imgPath = $uploadInfo["VOLUMESPATH"] . $dataFirstTome[0]['cover'];
	?>

	<div class="row mv-manga-info">
		<div class="col-0">
			<img src="<?= $imgPath ?>" alt="First Tome's cover" class="couverturedeu" >
		</div>
		<div class="col">
			<div class="description" >
				<p class="synopsis"><b>Synopsis : </b><?php echo($dataSerie[0]['synopsis']) ?></p>
				<div class="row">
					<div class="col-7">
						<p><b>Auteur : </b><?php echo($dataSerie[0]['author']) ?></p>
						<p><b>Publieur :</b> <?php echo($dataSerie[0]['publisher']) ?></p>
						<p><b>Annee de parution :</b> <?php echo($dataSerie[0]['year']) ?></p>
						<p><b>Nombre de chapitres :</b> <?php echo($dataSerie[0]['chapters']) ?></p>
					</div>
					<div class="col-2">
						<?php mkListTomes($idManga);?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="tags">
		<div class="card">
		<div class="card-header" id="TagsHeader">
			<h5 class="mb-0">
			<button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseTags" aria-expanded="true" aria-controls="collapseTags">Themes :</button>
			</h5>
		</div>
		<div id="collapseTags" class="collapse show" aria-labelledby="TagsHeader" data-parent="#tags">
			<div class="card-body">
			<?php
			$partionedTagsList = array_chunk($listTags, 10);
			foreach($partionedTagsList as $dataTagsList) {
				echo "<div class=\"row\">";
				foreach($dataTagsList as $dataTags) {
				echo "<div class=\"col\">";
				echo "<a href=index.php?view=series&tag[]=$dataTags[tid]><button class=\" rounded btn btn-outline-dark\">$dataTags[label]</button></a>";
				echo "</div>";
				}

				echo "</div>";
			}
			?>
			</div>
		</div>
		</div>
	</div>
	<div class="mv-postcomment-container">
		<?php
			if(valider("connecte", "SESSION")) {
				echo '<div class="mv-postcomment">';
				echo mkForm();
				echo '<div class="form-group">';
				echo '<label for="exampleFormControlTextarea1">Poster un commentaire :</label>';
				echo '<textarea placeholder="[spoiler] [/spoiler] : Pour les spoil \ [size=...][/size] : Pour modifier la taille \ [color=...][/color] : Pour modiifer la couleur \ [center][/center] : Pour centrer  \ [underline] [/underline] : Pour souligner"  name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>';
				echo mkButton("submit","action","writeComment", "Poster", "class=\"btn btn-primary form-control\"");
				echo mkInput("hidden", "type", "serie");
				echo mkInput("hidden", "id", $idManga);
				echo '</div>';
				echo endForm();
				echo '</div>';
			}
		
		?>
	</div>
	<h2>Les commentaires :</h2>
	<div class="mv-comment-container">
	<?php
		$dataComment = getComments($idManga, 'serie');
		foreach($dataComment as $dataOneComment){
			$comment = mkComment($dataOneComment);
			echo($comment);
		}
	?>
	</div>
</div>




