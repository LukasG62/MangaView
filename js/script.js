
// Fonction qui permet de cacher ou d'afficher un spoiler
function toggle_spoiler(ref) {

    if(ref.className == "spoiler-hidden") ref.className = "spoiler-shown"
    else ref.className = "spoiler-hidden"
}

function init() {
    refFavValue = document.getElementById("favValue");

}


function toggle_fav(ref) {
	console.log(ref.style.backgroundImage);
	
	if(ref.style.backgroundImage == "url(\"ressources/img/star_empty.png\")" || ref.style.backgroundImage == "") {
		ref.style.backgroundImage = "urL(\"ressources/img/star_fill.png\")"
		refFavValue.value = 1
		
	}
	else {
		ref.style.backgroundImage = "urL(\"ressources/img/star_empty.png\")"
		refFavValue.value = 0
	}
}