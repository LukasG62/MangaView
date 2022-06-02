<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=newshistory");
	die("");
}

$tabNews = getNewsDecroi();
?>

<div class="container mv-pagebase" >
	<?php 
		foreach($tabNews as $dataNews)
		{
			echo mkNews($dataNews,"active","");
			echo "<br/>";
		}
	?>
</div>
