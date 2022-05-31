<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=manga");
	die("");
}

	$idManga = valider("mid", "GET");
	$idTome = valider("id", "GET");
	$dataSerie = getSerieInfos($idManga);
	$dataTome = getTome($idManga, $idTome);
	$imgPath = $uploadInfo["SERIESPATH"] . $dataSerie[0]['banner'];
?>

<div class="container" >
	<br>
	<h1 class="text_centre"> <?php echo($dataTome)[0]['title'] ?></h1>
	<img src="<?= $imgPath ?>" alt="banner" class="banner">

	<?php
		$imgPath = $uploadInfo["VOLUMESPATH"] . $dataTome[0]['cover'];
	?>
	<br>
	<br>
	<br>
	<div class="flex">
		<img src="<?= $imgPath ?>" alt="First Tome's cover" class="couverturedeu floatLeft" >
		<div class="description" >
			<p class="synopsis"><?php echo($dataTome[0]['synopsis']) ?></p>
			<p>Date de parution : <?php echo($dataTome[0]['releaseDate']) ?></p>
		</div>
	</div>
	<?php
		$dataComment = getComments($idTome, 'tome');
		foreach($dataComment as $dataOneComment){
			$comment = mkComment($dataOneComment);
			echo($comment);
		}
	?>
</div>

