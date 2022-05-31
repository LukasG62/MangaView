<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=manga");
	die("");
}
	$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
	if(!($idTome = valider("id", "GET"))) rediriger($url,["view"=>"accueil"]);
	
	//TODO VERIFIER ID TOME INEXISTANT
	if(!($dataTome = getVolume($idTome)[0])) rediriger($url,["view"=>"accueil"]);
	
	$dataSerie = getSerie($dataTome["mid"])[0];
	$listReview = getReview($idTome);
	$imgPath = $uploadInfo["SERIESPATH"] . $dataSerie['banner'];
?>

<div class="container" >
	<br>
	<h1 class="text_centre"> <?php echo $dataTome['title'] ?></h1>
	<div class="row"><img src="<?= $imgPath ?>" alt="banner" class="banner"></div>
	<?php
		$imgPath = $uploadInfo["VOLUMESPATH"] . $dataTome['cover'];
	?>

	<div class="row tome-info">
		<div class="col-0">
			<img src="<?= $imgPath ?>" alt="First Tome's cover" class="couverturedeu" >
		</div>
		
		<div class="col">
			<div class="description" >
				<p class="synopsis"><?php echo($dataTome['synopsis']) ?></p>
				<p><b>Date de parution : </b><?php echo(date_format(date_create($dataTome["releaseDate"]), "d/m/Y")) ?></p>
			</div>
		</div>
	</div>
	<br />
	<div class="row">
		<?php
		   if($dataTome["prev"]) echo '<div class="col"><a href="index.php?view=tome&id=' . $dataTome["prev"] .'" ><button type="button" class="btn btn-secondary btn-lg btn-block disable">Tome précédents</button></a></div>';
		   if($dataTome["next"]) echo '<div class="col"><a href="index.php?view=tome&id=' . $dataTome["next"] .'" ><button type="button" class="btn btn-secondary btn-lg btn-block disable">Tome suivant</button></a></div>'
		?>
    </div>
	<br />
</div>

<div class="container">
	<h2>Les reviews : </h2> 
	<?php
		foreach($listReview as $dataReview){
			echo(mkReview($dataReview));
		}
	?>
</div>

<div class="container">
	<h2>Les commentaires :</h2> 
	<?php
		$dataComment = getComments($idTome, 'tome');
		foreach($dataComment as $dataOneComment){
			$comment = mkComment($dataOneComment);
			echo($comment);
		}
	?>
</div>

