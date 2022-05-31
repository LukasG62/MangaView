<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=manga");
	die("");
}

	$idManga = valider("id", "GET");
	$dataSerie = getSerieInfos($idManga);
	$imgPath = $uploadInfo["SERIESPATH"] . $dataSerie[0]['banner'];
?>

<div class="container" >
	<br/>
	<h1 class="text_centre"> <?php echo($dataSerie)[0]['titre'] ?></h1>
	
	<div class="row"><img src="<?= $imgPath ?>" alt="banner" class="banner"></div>

	<?php
		$dataFirstTome = getFirstTomeSerie($idManga);
		$imgPath = $uploadInfo["VOLUMESPATH"] . $dataFirstTome[0]['cover'];
	?>
	<br>
	<br>
	<br>
	<div class="row">
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
	<?php
		$dataComment = getComments($idManga, 'serie');
		foreach($dataComment as $dataOneComment){
			$comment = mkComment($dataOneComment);
			echo($comment);
		}
	?>
</div>



