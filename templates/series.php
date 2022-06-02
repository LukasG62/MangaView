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

if($view = valider("view"))
  $tabQs["view"] = $view;

if($search = valider("search"))
  $tabQs["search"] = $search;
else
  $tabQs["search"] = "";


if($sortby = valider("sortby"))
  $tabQs["sortby"] = $sortby;
else
  $tabQs["sortby"] = "";

if(($tags = valider("tag")) && is_array($tags) && verifTagsArray($tags)) $tabQs["tag"] = $tags;

else 
  $tabQs["tag"] = [];

$sortsAvailable = [["id"=>"date", "label"=>"date"], ["id"=>"title", "label"=>"titre"]];
//$seriesList = [$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries,$dataSeries];
$seriesList = searchSeries($tabQs["search"], $tabQs["tag"], $tabQs["sortby"]);
$tagsList = getTags();

if(!count($seriesList) < 1) {
  $partionedSeriesList  = array_chunk($seriesList, NBSERIESBYPAGE);
  $nbPages =  count($partionedSeriesList);

  if(!($page = valider("page")) || $page >= $nbPages || $page < 0) $page = 0;
}
?>

<div class="mv-manga mv-pagebase container">
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
        <?php
          $partionedTagsList = array_chunk($tagsList, 10);
          foreach($partionedTagsList as $dataTagsList) {
            echo "<div class=\"container\">";
            foreach($dataTagsList as $dataTags) {
              echo "<div class=\"form-check form-check-inline\">";
              echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"tag[]\" id=\"checkbox$dataTags[id]\" value=\"$dataTags[id]\">";
              echo "<label class=\"form-check-label\" for=\"checkbox$dataTags[id]\">$dataTags[label]</label>";
              echo "</div>";
            }

            echo "</div>";
          }
        ?>
        </div>
      </div>
    </div>
  </div>

  <?=endForm()?>
	<?php if(!count($seriesList) < 1) echo mkSearchPage($partionedSeriesList, $page, $nbPages, $tabQs);
        else echo mkError("Aucun résultat trouvé !")
  ?>

</div>
