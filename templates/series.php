<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=series");
	die("");
}

$dataSeries = ["title"=>"Spy x Family",
			   "id" =>"1",
			   "status"=>1,
			   "cover" => "1.jpg"
];


$seriesList = [$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries];
$partionedSeriesList  = array_chunk($seriesList, 9);
$nbPages =  count($partionedSeriesList);

if(!($page = valider("page")) || $page >= $nbPages || $page < 0) $page = 0;

?>

<br />
<br />

<div class="mv-manga container">
	<?=mkSearchPage($partionedSeriesList, $page, $nbPages)?>

</div>