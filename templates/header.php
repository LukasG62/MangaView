<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=header");
	die("");
}

// Pose qq soucis avec certains serveurs...
echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";

include_once "libs/maLibBootstrap.php";
include_once "libs/LibMangaview.php"; 
include_once "libs/maLibUtils.php";
include_once "libs/maLibForms.php";

$view = valider("view");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/script.js"></script>
  <title>MangaView</title>
</head>

<body onload="init()">
  <div class="mv-header">
     <!-- TITRE DU HEADER ! TODO !!-->
    <div class="mv-header-title">
      <div class="row">
        <div class="col-md-0">
          <div class="header-waifu">
            <a href="index.php?view=accueil"><img width="150" height="150" src="ressources/img/header_waifu.png" /></a>
          </div>
        </div>
        <div class="col-md-8">
          <h1>MangaView</h1>
          <h2><small>Share mangas with us !</small></h2>
        </div>
      </div>
    </div>
    <!-- BARRE DE NAVIGATION -->
    <div class="mv-navbar bg-dark">
      <div class="container">
        <div class="row">
          <nav class="col navbar navbar-expand-lg navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarContent" class="collapse navbar-collapse">
              <ul class="navbar-nav">
                <?=mkHeadLink("Accueil", "accueil", $view, "", "bi bi-house-door-fill")?>
                <?=mkHeadLink("Liste des mangas", "series", $view, "")?>
                
                <?php
                  if(valider("connecte", "SESSION"))
                  if($idUser = valider("idUser", "SESSION"))
                  echo mkHeadLink("Les news","newshistory",$view);
                
                ?>
              </ul>
              <ul class="navbar-nav ml-auto">
                <?php 
                  if(valider("connecte", "SESSION")) {
                    echo mkHeadLink("Mon Profil", "profile&id=$idUser", $view,"", "bi bi-person-fill");
                    echo mkHeadLink("Modifier mon profil", "myprofile", $view);
                    echo "<li class=\"nav-item\"> <a class=\"nav-link\" href=\"controleur.php?action=Logout\">Se déconnecter</a></li>";
                  }
                  else {
                    echo mkHeadLink("Inscription", "signup", $view, "", "bi bi-person-plus-fill");
                    echo mkHeadLink("Se connecter", "login", $view, "", "bi bi-box-arrow-in-right");
                  }
                ?>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
</div>
