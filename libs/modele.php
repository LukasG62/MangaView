<?php


include_once "maLibSQL.pdo.php";

//// FONCTIONS METIERS LIÉE A UN UTILISATEUR ////

function getUser($idUser) {
    // Fonction retournant toutes les information d'un utilisateur
    // Params : idUser, l'id de l'utilisateur
    
} //Retourne un tableau associatif 

function deleteUser($idUser) {
    // Fonction supprime toutes les informations de l'utilisateur via son id
    // Params : idUser, l'id de l'utilisateur
    
} // Retourne 1 ou 0 

function getGradeLabel($idUser) {
    // Fonction retournant le titre du grade d'un utilisateur
    // Params : idUser
} //Retourne un tableau associatif 

function getGrade($idUser) {
    // Fonction retournant la valeur numérique du grade d'un utilisateur

} // retourne un nombre 

function isUserConnected($idUser) {
    // Fonction retournant vrai si l'utilisateur est connectés
} // retourne 0 ou 1

function getAvatar($idUser) {
    // Fonction retournant le chemin de l'avatar ou default.png si l'avatar n'a pas été autorisé ou nul
} // retourne un chemin dans un tableau 

function getUserBio($idUser) {
    // Fonction retournant la bio de l'utilisateur
} // retourne un tableau 

function createUser($pseudo,$password, $bio = "",$grade=0, $avatar="") {
    // Fonction qui inserer un utilisateur dans la bdd
} // retourne 1 ou 0

function changeUserPseudo($idUser, $newPseudo){
    // Fonction qui change le pseudo de l'utilisateur
} // retourne 1 ou 0

function changeUserPassword($idUser, $newPseudo){
    // Fonction qui change le mot de passe de l'utilisateur
} //Retourne un tableau associatif contenant les nouvelles informations 

function changeUserAvatarPath($idUser, $newPseudo){
    // Fonction qui change le pseudo de l'utilisateur
} //Retourne un tableau associatif contenant les nouvelles informations 

function changeUserBio($idUser, $newBio) {
    // Fonction qui change la bio de l'utilisateur
} //Retourne un tableau associatif contenant les nouvelles informations 

//// FONCTIONS METIERS LIÉE A UN TOME ////

function getVolume($idVolume){
  // Retourne toute les info d'un tome
} //Retourne un tableau associatif

function addToCollection($idUser, $idVolume) {
    // Ajoute un volume à la collection de utilisateur
} // retourne 0 ou 1

function getReview($idVolume){
    // liste les reviews d'un volume
} // retourne un tableau contenant les id reviews

function getCollection($idUser) {
    // Récupère la collection d'un utilisateur et renvoie les informations de la collection
} //Retourne un tableau associatif


function getPrev($idVolume){
    // donne l'id du tome précédent s'il existe
} // retourne un int 


function getNext($idVolume){
    // donne l'id du tome suivant s'il existe
} // retourne un int


//// FONCTIONS METIERS LIÉE A UNE SERIE ////

function getVolumes($idManga) {
        // Donne la liste de tous les tome d'une série
} // retourne un tableau associatif


function getSeries() {
    // Donne la liste de toutes les séries
} // retourne un tableau associatif

function searchSeries($keyword, $listtags){
    // donne la liste des series par theme et par mot clé
} // retourne un tableau associatif

function getSerieTags($idManga) {
   // retourne la liste des identifiant tags et le label pour une série
} // retourne un tableau associatif 

//// FONCTIONS METIERS LIEE A UNE NEWS ////

function getNews($idNews, $number){
    // donne toutes les informations nécessaires pour l'affichage d'une news ( sur carroussel ou page de review ). On récupère $number news avec all (toutes les news)
} // retourne un tableau associatif 

//// Fonction générale ////

function getComments($id, $typecomm){
    // liste les commentaires liés à une news, un tome ou une série via un champ caché récupéré dans typecomm
} // retourne un tableau associatif

function addComment($uid, $content, $type) {
    // Fonction qui insère un commentaire selon si c'est un commentaire de news, de tome, de séries
}
?>
