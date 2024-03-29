<?php

if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=myprofile");
	die("");
}

$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
if(!($idUser = valider("id"))) rediriger($url,["view"=>"accueil"]);
if(!$user = getUser($idUser)) rediriger($url,["view"=>"accueil"]);

$user = $user[0];
$pseudo = $user["pseudo"];
$connected = $user["connected"];
$rank = $user["gradeLabel"];
$bio = bbcodeparser(htmlspecialchars($user["bio"]));
$imgPath = $uploadInfo["USERSPATH"];
$imgPath .= ($user["avatarValided"] ? $user["avatar"] : "default.png");
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
			<h3><img src="ressources/img/p_con_<?=$connected?>.gif"> <?php echo($pseudo);?></h3>
			<p>Rank : <?php echo($rank);?> </p>
			<div class="bio">
				<p><?php echo($bio);?></p>
			</div>
		</div>
	</div>
	<div>
		<h4 id="titre-col" class="">Ma collection</h4>
		<br />
		<?php if($collectionRaw) echo mkCollection($collectionBySeries, $myprofile)?>
		<h4>Mes Favoris</h4>
		<br />
		<?php if($collectionRawFav) echo mkCollection($collectionBySeriesFav, $myprofile, 1)?>

		<br/>
		<h4 id="titre-rev">Mes Reviews</h4>

		<?php 
			$tabReviewUser = getUserReviews($idUser);
			foreach($tabReviewUser as $dataReview) echo mkReview($dataReview);
		?>
	</div>
</div>