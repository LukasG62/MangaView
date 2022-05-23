<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=header");
	die("");
}

// Pose qq soucis avec certains serveurs...
echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/style.css">
  <title>MangaView</title>
</head>

<body>
  <!-- TITRE DU HEADER ! TODO !!-->
  <!-- BARRE DE NAVIGATION ! TODO : Rendre dynamique les elements de la navbar-->
  <div class="mv-navbar bg-dark">
    <div class="container">
      <div class="row">
        <nav class="col navbar navbar-expand-lg navbar-dark">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div id="navbarContent" class="collapse navbar-collapse">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="index.php?view=accueil">Accueil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?view=series">Liste des mangas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Ma collection</a>
              </li>
            </ul>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php?view=login">
                <i class="bi bi-box-arrow-in-right"></i></i> Se connecter
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Mon profil</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </div>
