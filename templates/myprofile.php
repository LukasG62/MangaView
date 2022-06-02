<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=myprofile");
	die("");
}

$msg = valider("msg");
$success = valider("success");

$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
if(!$idUser =valider("idUser", "SESSION")) rediriger($url,["view"=>"accueil"]);

if($idUser <= 0 && $idUser > getLastUserId()) rediriger($url,["view"=>"accueil"]);
$username = getUserPseudo($idUser);
$bio = getUserBio($idUser);

?>


<div class="mv-login-form">
  <div class="container mv-pagebase">
  <?php if($msg) echo mkError($msg)?>
  <?php if($success) echo mkSuccess($success)?>

   <form action ="controleur.php" enctype="multipart/form-data" method="POST">
       <div class="row justify-content-md-center">
			<div class="col-6 card-wrapper">
				<div class="card fat">
					<div class="card-body">
						<h4 class="card-title">Modifier mes informations de connexion</h4>
						<h5>Modifier mon pseudo :</h5>
						<div class="form-group">
							<label for="text-username">Username :</label>
							<input id="text-username" type="text" class="form-control" name="username" value="<?=$username?>">
							<small id="text-username-help" class="form-text text-muted">Pseudo entre 3 et 20 caractères</small>
						</div>
						<h5>Modifier mon mot de passe :</h5>
						<div class="form-group">
							<label for="text-password">Ancien mot de passe : </label>
							<input id="text-password" type="password" class="form-control" name="oldpassword">
						</div>
						<div class="form-group">
							<label for="text-new-password">Nouveau mot de passe : </label>
							<input id="text-new-password" type="password" class="form-control" name="newpassword">
						</div>
						<h5>Modifier mon avatar</h5>
						<div class="form-group">
							<label for="file-upload">Avatar : </label>
							<input id="file-upload" type="file" class="form-control" name="fileToUpload">
							<small id="textarea-help" class="form-text text-muted">fichier .png .jpg .gif de taille 250x250</small>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6 card-wrapper">
				<div class="card fat">
					<div class="card-body">
						<h4 class="card-title">Modifier ma biographie</h4>
						<div class="form-group">
							<label for="textarea-bio">Biographie : </label><br />
							<textarea id="textarea-bio"name="bio"rows="6" cols="25"><?=$bio?></textarea>
							<small id="textarea-help" class="form-text text-muted">Vous pouvez utiliser le BBcode pour donner du style</small>
						</div>
					</div>
				</div>
			</div>

			
			<?=mkInput("submit","action","Modifier", "class=\"btn btn-primary\"")?>

		</form>
	</div>
</div>