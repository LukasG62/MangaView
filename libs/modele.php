<?php


include_once "maLibSQL.pdo.php";

//// FONCTIONS METIERS LIÉE A UN UTILISATEUR ////

function getUser($idUser) {
    // Fonction retournant toutes les information d'un utilisateur
    // Params : idUser, l'id de l'utilisateur
    
}

function getGradeLabel($idUser) {
    // Fonction retournant le titre du grade d'un utilisateur
    // Params : idUser

}

function getGrade($idUser) {
    // Fonction retournant la valeur numérique du grade d'un utilisateur

}

function isUserConnected($idUser) {
    // Fonction retournant vrai si l'utilisateur est connectés
}

function getAvatar($idUser) {
    // Fonction retournant le chemin de l'avatar ou default.png si l'avatar n'a pas été autorisé ou nul
}

function getUserBio($idUser) {
    // Fonction retournant la bio de l'utilisateur
}

function createUser($pseudo,$password, $bio = "",$grade=0, $avatar="") {
    // Fonction qui inserer un utilisateur dans la bdd
}

function changeUserPseudo($idUser, $newPseudo){
    // Fonction qui change le pseudo de l'utilisateur
}

function changeUserPassword($idUser, $newPseudo){
    // Fonction qui change le mot de passe de l'utilisateur
}

function changeUserAvatarPath($idUser, $newPseudo){
    // Fonction qui change le pseudo de l'utilisateur
}

function changeUserBio($idUser, $newBio) {
    // Fonction qui change la bio de l'utilisateur
}

//// FONCTIONS METIERS LIÉE A UN TOME ////

function getVolume($idVolume){
  // Retourne toute les info d'un tome
}

function addToCollection($idUser, $idVolume) {
    // Ajoute un volume à la collection de utilisateur
}

function listerReview($idVolume){
    // liste les reviews d'un volume
}


//// FONCTIONS METIERS LIÉE A UNE SERIE ////

function getVolumes($idManga) {
        // Donne la liste de tous les tome d'une série
}

function getComments($idManga) {
        // Donne la liste de tous les commentaire d'une série
}

function getSeries() {
    // Donne la liste de toutes les séries
 
}

function searchSeries($keyword, $listtags){
    // donne la liste des series par theme et par mot clé
}

function getSerieTags($idManga) {
   // retourne la liste des identifiant tags et le label pour une série
}



?>
