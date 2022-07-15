
var editComments = {} // Garde une trace des commentaires édités

var editReviews = {} // la même pour les reviews édités 

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


function toggle_edit_comment(refEdit, idComment, type, qsId, content) {
	// TODO : changer la façon de récup les element pas viable en cas de changement de structure html

	if(refEdit.tagName == "BUTTON") 
		comment = refEdit.parentElement.parentElement
	else 
		comment = refEdit.parentElement.nextElementSibling
	
	if(!comment.classList.contains("mv-edit-comment-form")) {
		// Creation des différents tags html
		editComments[idComment] = comment.innerHTML
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
		newTextarea.value = content
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
		newCancelButton.setAttribute("onclick", "toggle_edit_comment(this," + idComment + ")")


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

	}
	else {
		newCommentContent = document.createElement("div")

		
		newCommentContent.classList.add("m-b-5")
		newCommentContent.classList.add("m-t-10")
		newCommentContent.innerHTML = editComments[idComment]

		comment.parentElement.replaceChild(newCommentContent, comment)

	}


}

// TODO trouver un autre moyen pour recupérer les données (list objet json)
function toggle_edit_review(refEdit, idVolume,idReview, content, note) {

	// TODO : changer la façon de récup les element pas viable en cas de changement de structure html
	refReviewContainer = document.getElementById("review-" + idReview);
	refNote = document.getElementById("review-note-" + idReview)
	refReview = document.getElementById("review-content-" + idReview)

	if(!refReviewContainer.classList.contains("mv-edit-review-form")) {
		editReviews[idReview] = refReview.innerHTML
		// Creation des éléments html
		newDiv = document.createElement("div")
		newForm = document.createElement("form")
		newTextarea = document.createElement("textarea")
		newSubmitButton = document.createElement("button")
		newCancelButton = document.createElement("button")
		newNumInput = document.createElement("input")
		newInputIdReivew = document.createElement("input")
		newInputIdVolume = document.createElement("input")


		// Modification de la balise de formulaire
		newForm.setAttribute("action", "controleur.php")
		newForm.setAttribute("method", "GET")
		newForm.innerHTML = refReview.innerHTML
		newForm.classList.add("mv-review")
		newForm.classList.add("container")
		newForm.classList.add("mv-edit-review-form")
		newForm.id = "review-" + idReview

		// Modification de la balise textarea
		newTextarea.innerHTML = content
		newTextarea.setAttribute("name","content")

		// Modification du bouton de soumission
		newSubmitButton.setAttribute("type", "submit")
		newSubmitButton.setAttribute("name", "action")
		newSubmitButton.setAttribute("value", "editReview")
		newSubmitButton.innerHTML = "Modifier"

		// Modification du bouton d'annulation
		newCancelButton.setAttribute("type", "button")
		newCancelButton.setAttribute("name", "Annuler")
		newCancelButton.setAttribute("value", "0")
		newCancelButton.innerHTML = "Annuler"
		newCancelButton.setAttribute("onclick", "toggle_edit_review(this," + idReview + "," + idVolume + ",'" + JSON.stringify(content) + "'," + note + ")")


		// Modification de l'entrée numérique
		newNumInput.setAttribute("type", "number")
		newNumInput.setAttribute("min", 0)
		newNumInput.setAttribute("max", 10)
		newNumInput.setAttribute("name", "note")
		newNumInput.setAttribute("value", note)
		newNumInput.id = "review-note-" + idReview

		// Modification de l'entrée caché contenant l'id de la review
		newInputIdReivew.setAttribute("name", "id")
		newInputIdReivew.setAttribute("value", idReview)
		newInputIdReivew.setAttribute("type", "hidden")

		// Modification de l'entrée caché contenant l'id de la review
		newInputIdVolume.setAttribute("name", "vid")
		newInputIdVolume.setAttribute("value", idVolume)
		newInputIdVolume.setAttribute("type", "hidden")
		
		// Creation des liens de parentés entre les balises
		newDiv.appendChild(newTextarea)
		newDiv.appendChild(newCancelButton)
		newDiv.appendChild(newSubmitButton)
		newDiv.appendChild(newInputIdReivew)
		newDiv.appendChild(newInputIdVolume)

		// Modification de la div
		newDiv.id = "review-content-" + idReview

		refNote.parentElement.replaceChild(newNumInput, refNote)
		refReview.parentElement.replaceChild(newDiv, refReview)

		newForm.innerHTML = refReviewContainer.innerHTML

		refReviewContainer.parentElement.replaceChild(newForm, refReviewContainer)

	}
	else {
		// Creation des balises html
		newReviewContent = document.createElement("div");
		newH5 = document.createElement("h5")
		newReviewContainerDiv = document.createElement("div")

		// Modification des balise HTML
		newReviewContent.innerHTML = editReviews[idReview]
		newReviewContent.id = "review-content-"+ idReview
		
		newReviewContainerDiv.classList.add("mv-review")
		newReviewContainerDiv.classList.add("container")
		newReviewContainerDiv.id = "review-" + idReview

		newH5.innerHTML = note + "/10"
		newH5.id = "review-note-" + idReview
		
		color = "green"
		if(note == 5) $color = "darkorange"
		else if(note < 5) $color = "red"

		newH5.style.color = color


		refNote.parentElement.replaceChild(newH5, refNote);
		refReview.parentElement.replaceChild(newReviewContent, refReview)
		newReviewContainerDiv.innerHTML = refReviewContainer.innerHTML

		refReviewContainer.parentElement.replaceChild(newReviewContainerDiv, refReviewContainer)


	}





}