<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=login");
	die("");
}

$msg = valider("msg");

?>

<div class="mv-login-form">
  <div class="container">
    <?php if($msg) echo mkError($msg)?>
    <div class="row justify-content-md-center">
      <div class="col-6 card-wrapper">
        <div class="card fat">
          <div class="card-body">
            <h4 class="card-title">Inscrivez-vous dès maintenant</h4>
            <form action ="controleur.php" enctype="multipart/form-data" method="POST">
              <div class="form-group">
                <label for="username">Username :</label>
                <input id="text-username" type="text" class="form-control" name="username" value="">
              </div>
              <div class="form-group">
                <label for="password">Password : </label>
                <input id="text-password" type="password" class="form-control" name="password">
              </div>
			  <div class="form-group">
                <label for="password">Confirmmer votre password : </label>
                <input id="text-password" type="password" class="form-control" name="newpassword">
              </div>
			  <div class="form-group">
                <label for="pdp">Password : </label>
                <input id="text-password" type="file" class="form-control" name="fileToUpload">
              </div>
              <div class="form-group m-0">
                <button name="action" value="Signin" type="submit" class="btn btn-primary btn-block">Créer mon compte</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
