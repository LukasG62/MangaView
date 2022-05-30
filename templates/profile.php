<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=myprofile");
	die("");
}
global $uploadInfo;
$idUser = valider("id", "GET");
$pseudo = getUserPseudo($idUser);
$rank = getGradeLabel($idUser);
$bio = bbcodeparser(htmlspecialchars(getUserBio($idUser)));
$imgPath = $uploadInfo["USERSPATH"];
$imgPath .= getUserAvatar($idUser);
?>

<div class="container">
	<img src="<?=$imgPath?>" alt="User avatar" class="photoProfil">
		<h3><?php echo($pseudo);?></h3>
		<p>Rank : <?php echo($rank);?> </p>
		<div class="bio">
			<p><?php echo($bio);?></p>
		</div>
		<br>
		<div class="row">

			<h4 class="col-2">Ma collection</h4>
			<div class="col">
			<select name="Choix" id="choixTriCollection">
				<option value="">--Please choose an  option</option>
				<option value="Tomes">Tomes</option>
				<option value="Manga">Manga</option>
			</select>
			</div>
		</div>
		<br><br>

		<div class="row">
			<h4 class="col-2">Mes Favoris</h4>
			<div class="col">
				<select name="Choix" id="choixTriCollection">
					<option value="">--Please choose an  option</option>
					<option value="Tomes">Tomes</option>
					<option value="Manga">Manga</option>
				</select>
			</div>
		</div>
		<br />
		<h4>Mes Reviews</h4>

		<?php 
			$tabReviewUser = getAllReview();
			foreach($tabReviewUser as $dataReview)
			{
				if ($dataReview['uid'] == $idUser)
				{
					echo mkReview($dataReview);
				}
			}
		?>

</div>