
// Fonction qui permet de cacher ou d'afficher un spoiler
var a;

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


function toggle_edit(refEdit, idComment, type, qsId) {
	if(refEdit.tagName == "BUTTON") 
		comment = refEdit.parentElement.parentElement
	else 
		comment = refEdit.parentElement.nextElementSibling
	a = refEdit
	if(comment.className != "mv-edit-comment-form") {
		// Creation des différents tags html
		newDiv = document.createElement("div")
		newForm = document.createElement("form")
		newTextarea = document.createElement("textarea")
		newSubmitButton = document.createElement("button")
		newCancelButton = document.createElement("button")
		newInputIdComment = document.createElement("input")
		newInputCommentType = document.createElement("input")
		newInputQsId = document.createElement("input")

		// Modification du tags form
		newForm.setAttribute("action", "controleur.php")
		newForm.setAttribute("method", "GET")

		// Modification du tags textarea (ajout du texte du commentaire)
		newTextarea.value = comment.innerHTML
		newTextarea.innerHTML = comment.innerHTML
		newTextarea.setAttribute("name","comment")

		// Modification du bouton de soumission
		newSubmitButton.setAttribute("type", "submit")
		newSubmitButton.setAttribute("name", "action")
		newSubmitButton.setAttribute("value", "editComment")
		newSubmitButton.innerHTML = "Modifier"

		// Modification du bouton d'annulation
		newCancelButton.setAttribute("type", "button")
		newCancelButton.setAttribute("name", "Annuler")
		newCancelButton.setAttribute("value", "0")
		newCancelButton.innerHTML = "Annuler"
		newCancelButton.setAttribute("onclick", "toggle_edit(this," + idComment + ")")


		// Modification des champs cachés
		newInputIdComment.setAttribute("name", "idComment")
		newInputIdComment.setAttribute("value", idComment)
		newInputIdComment.setAttribute("type", "hidden")
		newInputCommentType.setAttribute("name","type")
		newInputCommentType.setAttribute("value", type)
		newInputCommentType.setAttribute("type","hidden")
		newInputQsId.setAttribute("name", "id")
		newInputQsId.setAttribute("value", qsId)
		newInputQsId.setAttribute("type", "hidden")
		// Creation des liens de parenté entre tous les éléments
		newForm.appendChild(newTextarea)
		newForm.appendChild(newCancelButton)
		newForm.appendChild(newSubmitButton)

		newForm.appendChild(newInputIdComment)
		newForm.appendChild(newInputCommentType)
		newForm.appendChild(newInputQsId)
		newDiv.appendChild(newForm)

		// Modification de la div
		newDiv.setAttribute("class", "mv-edit-comment-form")

		comment.parentElement.replaceChild(newDiv, comment)

		a = newCancelButton

	}
	else {
		newP = document.createElement("p")

		
		newP.classList.add("m-b-5")
		newP.classList.add("m-t-10")
		newP.innerHTML = comment.firstElementChild.firstElementChild.innerHTML

		comment.parentElement.replaceChild(newP, comment)

	}


}