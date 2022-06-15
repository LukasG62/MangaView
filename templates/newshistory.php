<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=newshistory");
	die("");
}

$tabNews = getNews();
echo count($tabNews);
?>

<div class="container mv-pagebase" >
	<?php 
		echo count($tabNews);
		foreach($tabNews as $dataNews)
		{
			echo mkNews($dataNews, "", "");
			echo "<br/>";
		}
	?>
</div>
