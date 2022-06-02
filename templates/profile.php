<?php

if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=myprofile");
	die("");
}

$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
if(!($idUser = valider("id"))) rediriger($url,["view"=>"accueil"]);
if(!$pseudo = getUserPseudo($idUser)) rediriger($url,["view"=>"accueil"]);

$rank = getGradeLabel($idUser);
$bio = bbcodeparser(htmlspecialchars(getUserBio($idUser)));
$imgPath = $uploadInfo["USERSPATH"];
$imgPath .= getUserAvatar($idUser);
$myprofile = ($idUser == valider("idUser","SESSION"));
$collectionRaw = getCollection($idUser);
$collectionRawFav = getCollection($idUser, 1);

$collectionBySeries = groupby($collectionRaw, "mid");
$collectionBySeriesFav = groupby($collectionRawFav, "mid");

?>

<div class="container mv-pagebase">
	<div class="row">
	<div class="col-0">
		<img src="<?=$imgPath?>" alt="User avatar" class="photoProfil">
	</div>
	<div class="col">
		<h3><?php echo($pseudo);?></h3>
		<p>Rank : <?php echo($rank);?> </p>
		<div class="bio">
			<p><?php echo($bio);?></p>
		</div>
	</div>

	<div>
		<h4 id="titre-col" class="">Ma collection</h4>
		<br>
		<?php if($collectionRaw) echo mkCollection($collectionBySeries, $myprofile)?>
		<h4 class="col-2">Mes Favoris</h4>
		<?php if($collectionRawFav) echo mkCollection($collectionBySeriesFav, $myprofile)?>

		<br/>
		<h4 id="titre-rev">Mes Reviews</h4>

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
</div>