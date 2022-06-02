<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=login");
	die("");
}

$msg = valider("msg");
$success = valider("success")

?>

<div class="mv-login-form">
  <div class="container">
    <?php if($msg) echo mkError($msg)?>
    <?php if($success) echo mkSuccess($success)?>
    <div class="row justify-content-md-center">
      <div class="col-6 card-wrapper">
        <div class="card fat">
          <div class="card-body">
            <h4 class="card-title">Login</h4>
            <form action ="controleur.php" method="GET">
              <div class="form-group">
                <label for="text-username">Username :</label>
                <input id="text-username" type="text" class="form-control" name="username" value="" required>
              </div>
              <div class="form-group">
                <label for="text-password">Password : </label>
                <input id="text-password" type="password" class="form-control" name="password" required>
              </div>
              <div class="form-group m-0">
                <button name="action" value="Login" type="submit" class="btn btn-primary btn-block">Login</button>
              </div>
              <div class="mt-4 text-center">
                <a href="index.php?view=signup">Première connexion ?</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
