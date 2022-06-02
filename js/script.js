
// Fonction qui permet de cacher ou d'afficher un spoiler
function toggle_spoiler(ref) {

    if(ref.className == "spoiler-hidden") ref.className = "spoiler-shown"
    else ref.className = "spoiler-hidden"
}

function init() {
    refFavValue = document.getElementById("favValue");

	refPassword = document.getElementById("text-password")
	refSignUp = document.getElementById("signupButton")

}


function toggle_fav(ref) {
	console.log(ref.style.backgroundImage);
	
	if(ref.style.backgroundImage == "url(\"ressources/img/star_empty.png\")" || ref.style.backgroundImage == "") {
		ref.style.backgroundImage = "url(\"ressources/img/star_fill.png\")"
		refFavValue.value = 1
		
	}
	else {
		ref.style.backgroundImage = "url(\"ressources/img/star_empty.png\")"
		refFavValue.value = 0
	}
}


function password_verify(refConfirm) {
	// On compare les deux champs
	if(refConfirm.value != refPassword.value) {
		// Si il ne sont pas égale
		// on ajoute une classe qui affichera l'erreur
		refConfirm.classList.add("is-invalid")
		refPassword.classList.add("is-invalid")
		refSignUp.setAttribute("disabled", "") 
	}
	else {
		refConfirm.classList.remove("is-invalid")
		refPassword.classList.remove("is-invalid")
		refSignUp.removeAttribute("disabled", "")
	}
}