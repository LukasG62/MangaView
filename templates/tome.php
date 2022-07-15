<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=manga");
	die("");
}
$idUser = valider("idUser", "SESSION");
$isAdmin = valider("isAdmin", "SESSION");
$isReviewer = valider("isReviewer", "SESSION");


$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";

if(!($idTome = valider("id", "GET"))) rediriger($url,["view"=>"accueil"]);

if(!($dataTome = getVolume($idTome)[0])) rediriger($url,["view"=>"accueil"]);

$listReview = getReviews($idTome);
$imgPath = $uploadInfo["SERIESPATH"] . $dataTome['mangaBanner'];
?>

<div class="container mv-pagebase" >
	<br>
	<h1 class="text_centre"> <?php echo $dataTome['title'] ?></h1>
	<div class="row volume-banner-container">
		<img src="<?= $imgPath ?>" alt="banner" class="banner">
	</div>

	<?php
		$imgPath = $uploadInfo["VOLUMESPATH"] . $dataTome['cover'];
	?>

	<div class="row tome-info">
		<div class="col-0">
			<img src="<?= $imgPath ?>" alt="First Tome's cover" class="couverturedeu" >
		</div>
		
		<div class="col">
			<?php
			$showForm = 0;
			if ($idUser) {
				if (!inCollection($idUser, $idTome)) {
					$showForm = 1;
				}
				else
				{
					echo mkInfo("Vous possédez déjà ce tome");
				}

			}
			?>
			<div class="description" >
				<p class="synopsis"><?php echo($dataTome['synopsis']) ?></p>
				<p><b>Date de parution : </b><?php echo(date_format(date_create($dataTome["releaseDate"]), "d/m/Y")) ?></p>
			<?php
				if($showForm) {
					echo mkForm("controleur.php", "get", "class=\"form-inline\"");
					echo "<div id='form-add' style=\"display: inherit;\">";
					echo mkButton("button", "", "", "", "class=\"addFavBtn\" onclick=\"toggle_fav(this)\"");
					echo mkButton("submit", "action", "AddToCollection", "+", "class=\"addBtn\"");
					echo "</div>";
					echo mkInput("hidden", "fav", "0", "id=\"favValue\"");
					echo mkInput("hidden", "id", $idTome);
					echo endForm();
				}
			?>
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

<div class="container mv-pagebase">
	<?php
		if($isReviewer) {
				echo '<div class="mv-postcomment">';
				echo mkForm();
				echo '<div class="form-group">';
				echo '<label for="poster-review">Poster une review :</label>';
				echo '<textarea placeholder="[spoiler] [/spoiler] : Pour les spoil \n [size=...][/size] : Pour modifier la taille \n [color=...][/color] : Pour modiifer la couleur \n [center][/center] : Pour centrer  \n [underline] [/underline] : Pour souligner" name="content" class="form-control" id="poster-review" rows="3"></textarea>';
				echo '<label for="poster-review">Note du tome </label>';
				echo '<br />';
				echo '<div class="row"><div class="col">';
				echo mkInput("number", "note", "", "min=\"0\" max=\"10\"");
				echo '</div><div class="col">';
				echo mkButton("submit","action","writeReview", "Poster", "class=\"btn btn-primary form-control\"");
				echo '</div>';
				echo mkInput("hidden", "vid", $idTome);
				echo '</div>';
				echo endForm();
				echo '<div class="mv-postcomment">';
		}
	?>
	<h2>Les reviews : </h2>
	<?php
			foreach($listReview as $dataReview){
				echo mkReview($dataReview,($idUser == $dataReview["uid"]),$isAdmin);
			}
	?> 
</div>

<div class="container mv-pagebase">
	<?php
		//on l'affiche pour un users blacklisté ?
		if(valider("connecte", "SESSION")) {
			echo '<div class="mv-postcomment">';
			echo mkForm();
			echo '<div class="form-group">';
			echo '<label for="poster-comment">Poster un commentaire :</label>';
			echo '<textarea placeholder="[spoiler] [/spoiler] : Pour les spoil \ [size=...][/size] : Pour modifier la taille \ [color=...][/color] : Pour modiifer la couleur \ [center][/center] : Pour centrer  \ [underline] [/underline] : Pour souligner" name="comment" class="form-control" id="poster-comment" rows="3"></textarea>';
			echo mkButton("submit","action","writeComment", "Poster", "class=\"btn btn-primary form-control\"");
			echo mkInput("hidden", "type", "tome");
			echo mkInput("hidden", "id", $idTome);
		  	echo '</div>';
			echo endForm();
			echo '<div class="mv-postcomment">';
		}
	
	?>
	<h2>Les commentaires :</h2> 
	<?php
		$dataComment = getComments($idTome, 'tome');
		foreach($dataComment as $dataOneComment){
			$comment = mkComment($dataOneComment,($idUser == $dataOneComment["uid"]),$isAdmin, "tome");;
			echo($comment);
		}
	?>
</div>

