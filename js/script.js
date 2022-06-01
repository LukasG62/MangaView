
// Fonction qui permet de cacher ou d'afficher un spoiler
function toggle_spoiler(ref) {

    if(ref.className == "spoiler-hidden") ref.className = "spoiler-shown"
    else ref.className = "spoiler-hidden"
}

function init() {

}


function toggle_fav(ref) {
	console.log(ref.style.backgroundImage);
	refFavValue = document.getElementById("favValue");
	
	if(ref.style.backgroundImage == "url(\"ressources/img/star_empty.png\")" || ref.style.backgroundImage == "url(\"ressources/img/star_empty.png\")") {
		ref.style.backgroundImage = "urL(\"ressources/img/star_fill.png\")"
		refFavValue.value = 1
		
	}
	else {
		ref.style.backgroundImage = "urL(\"ressources/img/star_empty.png\")"
		refFavValue.value = 0
	}
}