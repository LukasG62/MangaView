<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=news");
	die("");
}

$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
if(!($idNews = valider("id", "GET"))) rediriger($url,["view"=>"accueil"]);
	
if(!($dataNews = getNewsById($idNews)[0])) rediriger($url,["view"=>"accueil"]);

?>


<div class="container mv-pagebase">
	<?= mkNews($dataNews, "", "")?>
<div>

<br />
<div class="container mv-pagebase">
	<h2>Les commentaires :</h2> 
	<?php
		$dataComment = getComments($idNews, 'news');
		foreach($dataComment as $dataOneComment){
			$comment = mkComment($dataOneComment);
			echo($comment);
		}
	?>
</div>

