<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=series");
	die("");
}

$dataSeries = ["title"=>"Spice and wolf",
			   "id" =>"1",
			   "status"=>0,
			   "cover" => "1.jpg"
];

?>


<div class="mv-manga container">
	<div class="row">
		<?=mkSearchSeries($dataSeries)?>
		<?=mkSearchSeries($dataSeries)?>
	</div>
</div>