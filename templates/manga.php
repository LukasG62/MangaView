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
	<br>
	<h1 class="text_centre"> <?php echo($dataSerie)[0]['titre'] ?></h1>
	<img src="<?= $imgPath ?>" alt="banner" class="banner">

	<?php
		$dataFirstTome = getFirstTomeSerie($idManga);
		$imgPath = $uploadInfo["VOLUMESPATH"] . $dataFirstTome[0]['cover'];
	?>
	<br>
	<br>
	<br>
	<div class="flex">
		<img src="<?= $imgPath ?>" alt="First Tome's cover" class="couverturedeu floatLeft" >
		<div class="description" >
			<p class="synopsis"><?php echo($dataSerie[0]['synopsis']) ?></p>
			<p>Auteur : <?php echo($dataSerie[0]['author']) ?></p>
			<p>Publieur : <?php echo($dataSerie[0]['publisher']) ?></p>
			<p>Annee de parution : <?php echo($dataSerie[0]['year']) ?></p>
			<p>Nombre de chapitres : <?php echo($dataSerie[0]['chapters']) ?></p>
		</div>
	</div>
</div>
	<?php
		mkListTomes($idManga);
	?>

