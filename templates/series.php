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



$sortsAvailable = [["id"=>"date", "label"=>"date"], ["id"=>"title", "label"=>"titre"]];
//$seriesList = [$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries];
$seriesList = searchSeries("", []);

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
          <?=mkInput("submit","action", "Rechercher","class=\"btn btn-outline-dark\"")?>
        </div>
      </div>
    </div>
    <div class = "col-2">
      <div class="input-group mb-3">
        <?=mkSelect("sortby",$sortsAvailable, "id", "label", "class=\"\"", "[\"title\"]")?>
        <?=mkInput("submit","action", "Trier","class=\"btn btn-outline-dark\"")?>

      </div>
    </div>
  </div>
  <div id="tags">
    <div class="card">
      <div class="card-header" id="TagsHeader">
        <h5 class="mb-0">
          <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseTags" aria-expanded="true" aria-controls="collapseTags">Rechercher par themes :</button>
        </h5>
      </div>
      <div id="collapseTags" class="collapse show" aria-labelledby="TagsHeader" data-parent="#tags">
        <div class="card-body">
          TAGS GOES HERE !
        </div>
      </div>
    </div>
  </div>

  <?=endForm()?>
	<?=mkSearchPage($partionedSeriesList, $page, $nbPages)?>

</div>