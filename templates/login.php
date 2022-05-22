<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=login");
	die("");
}
?>

<div class="mv-login-form">
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="card-wrapper">
        <div class="card fat">
          <div class="card-body">
            <h4 class="card-title">Login</h4>
            <form action ="controleur.php" method="GET">
              <div class="form-group">
                <label for="username">Username :</label>
                <input id="text-username" type="text" class="form-control" name="username" value="">
              </div>
              <div class="form-group">
                <label for="password">Password : </label>
                <input id="text-password" type="password" class="form-control" name="password">
              </div>
              <div class="form-group m-0">
                <button name="action" value="Login" type="submit" class="btn btn-primary btn-block">Login</button>
              </div>
              <div class="mt-4 text-center">
                <a href="register.html">Première connexion ?</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
