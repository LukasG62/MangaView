<?php
//
//
// TODO :
// -> adapter avec les fonctions de modele.php
// -> Formulaire de recherche
// -> Menu déroulant de trie
// -> Zone de case à cocher représentant chaque case
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

$sortsAvailable = [["id"=>"date", "label"=>"date"], ["id"=>"title", "label"=>"titre"]];
$seriesList = [$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries];
$partionedSeriesList  = array_chunk($seriesList, NBSERIESBYPAGE);
$nbPages =  count($partionedSeriesList);

if(!($page = valider("page")) || $page >= $nbPages || $page < 0) $page = 0;

?>

<div class="mv-manga container">
  <?=mkForm()?>
  <div class="row">
    <div class = "col">
      <div class="input-group mb-3">
        <?=mkInput("text", "search", "", "placeholder=\"Rechercher une séries\"class=\"form-control\"")?>
        <div class="input-group-append">
          <?=mkButton("submit","action", "Search","Rechercher","class=\"btn btn-outline-dark\"")?>
        </div>
      </div>
    </div>
    <div class = "col-2">
      <div class="input-group mb-3">
        <?=mkSelect("sortby",$sortsAvailable, "id", "label", "class=\"\"", "[\"title\"]")?>
        <?=mkButton("submit","action", "Sort","Trier","class=\"btn btn-outline-dark\"")?>

      </div>
    </div>
  </div>
  <?=endForm()?>
	<?=mkSearchPage($partionedSeriesList, $page, $nbPages)?>

</div>