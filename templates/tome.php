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
echo "<div class='container mv-volumes-pagebase'>";
echo "<div class='container'><img class='banner' src='".$uploadInfo["SERIESPATH"].$_manga[0]["banner"]."'/></img></div>";
echo "<div class='container tome'><h1>" . $_tome[0]["title"]." </h1>
      	<br> 
	  	<div class=\"mv-tome-info container\">
	  		<div class=\"row\">
			  <div class=\"mv-tome-cover col-md-2\">
			    <img width='150' height='200' alt=\"couverture du tome\"src='".$uploadInfo["VOLUMESPATH"].$_tome[0]["cover"]."'/>
			  </div>
			  <div class=\"mv-tome-text col\">
			  	<p><b>Synopsis :</b></p><p>".$_tome[0]["synopsis"]."</p>
			  	<p><b>Date de sortie : </b>". date_format(date_create($_tome[0]["releaseDate"]), "d/m/Y")."</p>
			  </div> 
			</div>
			<br/>
			<div class=\"row\">
				<div class=\"col\">
					<a><button type=\"button\" class=\"btn btn-secondary btn-lg btn-block\">Tome précédents</button></a>
				</div>
					<div class=\"col\">
					<a><button type=\"button\" class=\"btn btn-secondary btn-lg btn-block\">Tome suivant</button></a>
				</div>
			</div>
		</div>
	</div>";

echo "<h2>Les reviews sur le tome</h2>";
echo "</br>";
echo "<div class='container fixxxxeee'>";
foreach ($_review as $rev)
	echo mkReview($rev);
echo "</div>";
echo "<h2>Les commentaire sur le tome</h2>";
echo "</div>";

?>
