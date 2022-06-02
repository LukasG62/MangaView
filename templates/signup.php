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
                <label for="text-username">Username :</label>
                <input id="text-username" type="text" class="form-control" name="username" value="">
              </div>
              <div class="form-group">
                <label for="text-password">Mot de passe : </label>
                <input id="text-password" type="password" class="form-control" name="password">
                <div class="invalid-feedback">
                </div>
              </div>
			  <div class="form-group">
                <label for="text-confirmpassword">Confirmer votre mot de passe : </label>
                <input oninput="password_verify(this)" id="text-confirmpassword" type="password" class="form-control" name="confirmpassword">
                <div class="invalid-feedback">
                    Les mots de passes sont différents  
                </div>
              </div>
			  <div class="form-group">
                <label for="pdp">Avatar : </label>
                <input id="file-upload" type="file" class="form-control" name="fileToUpload">
                <small id="Avatarhelp" class="form-text text-muted">fichier .png .jpg .gif de taille 250x250</small>
              </div>
              <div class="form-group m-0">
                <button id="signupButton" name="action" value="Signup" type="submit" class="btn-primary btn-block">Créer mon compte</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>