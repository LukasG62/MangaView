<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=404");
	die("");
}

echo "<div class='container'><img height='500px' width='800px' src='ressources/404.png' alt='404 error'></img></div>";