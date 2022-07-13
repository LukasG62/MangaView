<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=news");
	die("");
}
$isAdmin = valider("isAdmin", "SESSION");
$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
if(!($idNews = valider("id", "GET"))) rediriger($url,["view"=>"accueil"]);
	
if(!($dataNews = getNewsById($idNews)[0])) rediriger($url,["view"=>"accueil"]);

?>


<div class="container mv-pagebase">
	<?= mkNews($dataNews, "", "")?>
<div>

<br />
<div class="container mv-pagebase">
	
	<?php
		if(valider("connecte", "SESSION")) {
			echo '<div class="mv-postcomment">';
			echo mkForm();
			echo '<div class="form-group">';
			echo '<label for="exampleFormControlTextarea1">Poster un commentaire :</label>';
			echo '<textarea placeholder="[spoiler] [/spoiler] : Pour les spoil \ [size=...][/size] : Pour modifier la taille \ [color=...][/color] : Pour modiifer la couleur \ [center][/center] : Pour centrer  \ [underline] [/underline] : Pour souligner" name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>';
			echo mkButton("submit","action","writeComment", "Poster", "class=\"btn btn-primary form-control\"");
			echo mkInput("hidden", "type", "news");
			echo mkInput("hidden", "id", $idNews);
		  	echo '</div>';
			echo endForm();
			echo '<div class="mv-postcomment">';
		}
	
	?>
	<h2>Les commentaires :</h2> 
	<?php
		$dataComment = getComments($idNews, 'news');
		foreach($dataComment as $dataOneComment){
			$comment = mkComment($dataOneComment,($idUser == $dataOneComment["uid"]),$isAdmin, "news");;
			echo($comment);
		}
	?>
</div>

