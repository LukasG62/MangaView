<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=tome");
	die("");
}
?>

<?php
$_tome = getVolumes(1) ;
$_manga = getSerie($_tome[0]["mid"]);
$_review = getReview(2);
echo "<div class='container container-fluid'><img class='banner' src='".$uploadInfo[SERIESPATH].$_manga[0][banner]."'/></img></div>";
echo "<div class='container tome'> <h1>".$_tome[0]["title"]."</h1> <br> <img width='150' height='200' src='".$uploadInfo[VOLUMESPATH].$_tome[0][cover]."'/><br> <p>".$_tome[0][synopsis]."<br> Date de sortie : ".$_tome[0][releaseDate]."</div> ";

echo "<div class='container fixxxxeee'>";
foreach ($_review as $rev)
	echo mkReview($rev);
echo "</div>";
?>
