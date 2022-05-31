<?php


include_once "maLibSQL.pdo.php";
include_once "LibMangaview.php";

//// FONCTIONS METIERS LIÉE A UN UTILISATEUR ////

function getUser($idUser) {
    // Fonction retournant toutes les information d'un utilisateur
    // Params : idUser, l'id de l'utilisateur
    $PHP = "SELECT *
            FROM users
            WHERE id = $idUser";
    return parcoursRs(SQLSelect($PHP));
    
} //Retourne un tableau associatif 

function deleteUser($idUser) {
    // Fonction supprime toutes les informations de l'utilisateur via son id
    // Params : idUser, l'id de l'utilisateur

    $PHP = "DELETE *
            FROM comments_v 
            WHERE uid = $idUser ;

            DELETE *
            FROM reviews 
            WHERE uid = $idUser ;

            DELETE *
            FROM collections 
            WHERE uid = $idUser ;

            DELETE *
            FROM comment_n 
            WHERE uid = $idUser ;

            DELETE *
            FROM comment_n
            WHERE nid IN 
                SELECT id
                FROM news
                WHERE uid = $idUser ;

            DELETE *
            FROM comment_m 
            WHERE uid = $idUser ;";
    return SQLDelete($PHP);
    
} // Retourne 1 ou 0 

function getGradeLabel($idUser) {
    // Fonction retournant le titre du grade d'un utilisateur
    // Params : idUser

    $PHP = "SELECT label
            FROM users JOIN grades ON users.grade = grades.id
            WHERE users.id = $idUser;";
    return SQLGetChamp($PHP);

} //Retourne un tableau associatif 

function getGrade($idUser) {
    // Fonction retournant la valeur numérique du grade d'un utilisateur

    $PHP = "SELECT grades.id
            FROM users JOIN grades ON users.grade = grades.id
            WHERE users.id = $idUser;";
    return SQLGetChamp($PHP);

} // retourne un nombre 

function isUserConnected($idUser) {
    // Fonction retournant vrai si l'utilisateur est connectés

    $PHP = "SELECT connected 
            FROM users
            WHERE id = $idUser;";
    return SQLGetChamp($PHP);
} // retourne 0 ou 1

function getUserAvatar($idUser) {
    // Fonction retournant le chemin de l'avatar ou default.png si l'avatar n'a pas été autorisé ou nul
    $PHP = "SELECT avatar FROM users WHERE id = $idUser AND avatarValided=1;";
    if($res = SQLGetChamp($PHP))
        return $res;
    else
        return "default.png";

} // retourne un chemin dans un tableau


function getUserBio($idUser) {
    // Fonction retournant la bio de l'utilisateur
    $PHP = "SELECT bio 
            FROM users
            WHERE id = $idUser;";
    return SQLGetChamp($PHP);
} // retourne un tableau 

function getUserPseudo($idUser) {
    // Fonction retournant la bio de l'utilisateur
    $PHP = "SELECT pseudo
            FROM users
            WHERE id = $idUser;";
    return SQLGetChamp($PHP);
}

function getUserCredentials($pseudo) {
    // Fonction qui récupère l'id le login et le mot de passe de l'utilisateur portant le pseudo $pseudo 

    $PHP = "SELECT id, pseudo, password
            FROM users
            WHERE pseudo = '$pseudo';";
    
    return parcoursRs(SQLSelect($PHP));
}

function createUser($pseudo,$password, $bio = "",$grade=0, $avatar="") {
    // Fonction qui inserer un utilisateur dans la bdd

    $PHP = "INSERT INTO users (grade,pseudo,password,bio,avatar) 
            VALUES ($grade,$pseudo,$password,$bio,$avatar);";
    return SQLInsert($PHP);
} // retourne 1 ou 0

function changeUserPseudo($idUser, $newPseudo){
    // Fonction qui change le pseudo de l'utilisateur

    $PHP = "UPDATE users 
            SET pseudo = $newPseudo
            WHERE id = $idUser;";
    return SQLUpdate($PHP);
} // retourne 1 ou 0

function changeUserPassword($idUser, $newPassword){
    // Fonction qui change le mot de passe de l'utilisateur
    $PHP = "UPDATE users 
            SET password = $newPassword
            WHERE id = $idUser;";
    SQLUpdate($PHP);
    $PHP = "SELECT *
            FROM users
            WHERE id = $idUser;";
    return (parcoursRs($PHP));
} //Retourne un tableau associatif contenant les nouvelles informations 

function changeUserAvatarPath($idUser, $newAvatar){
    // Fonction qui change le pseudo de l'utilisateur
    // La fonction met egallement 0 à avatarValided 
    $PHP = "UPDATE users 
            SET avatar = $newAvatar
            WHERE id = $idUser;
            
            UPDATE users 
            SET avatarValided = 0
            WHERE id = $idUser;";
    SQLUpdate($PHP);
    $PHP = "SELECT *
            FROM users
            WHERE id = $idUser;";
    
    return (parcoursRs(SQLSelect($PHP)));
} //Retourne un tableau associatif contenant les nouvelles informations 

function changeUserBio($idUser, $newBio) {
    // Fonction qui change la bio de l'utilisateur
    $PHP = "UPDATE users 
            SET bio = $newBio
            WHERE id = $idUser;";
    SQLUpdate($PHP);
    $PHP = "SELECT *
            FROM users
            WHERE id = $idUser;";
    return (parcoursRs(SQLSelect($PHP)));
    
} //Retourne un tableau associatif contenant les nouvelles informations 

//// FONCTIONS METIERS LIÉE A UN TOME ////

function getVolume($idVolume){
  // Retourne toute les info d'un tome

    $PHP = "SELECT *
            FROM volumes 
            WHERE id = $idVolume;";
    return (parcoursRs(SQLSelect($PHP)));

} //Retourne un tableau associatif

function addToCollection($idUser, $idVolume) {
    // Ajoute un volume à la collection de utilisateur

    $PHP = "INSERT INTO collections (uid,vid,fav)
            VALUES ($idUser,$idVolume,0);";
    return SQLUpdate($PHP);
} // retourne 0 ou 1

function getReview($idVolume){
    // liste les reviews d'un volume
    $PHP = "SELECT *
            FROM reviews 
            WHERE vid = $idVolume;";
    return (parcoursRs(SQLSelect($PHP)));
} // retourne un tableau contenant toutes les infos d'une reviews

function getAllReview(){
    // liste les reviews d'un volume
    $PHP = "SELECT *
            FROM reviews";
    return (parcoursRs(SQLSelect($PHP)));
} // retourne un tableau contenant les infos d'une review

function getCollection($idUser) {
    // Récupère la collection d'un utilisateur et renvoie les informations de la collection

    $PHP = "SELECT *
            FROM  collections  
            WHERE uid = $idUser;";
    return (parcoursRs(SQLSelect($PHP)));

} //Retourne un tableau associatif


function getPrev($idVolume){
    // donne l'id du tome précédent s'il existe

    $PHP = "SELECT prev
            FROM  volumes 
            WHERE id = $idVolume;";
    return (parcoursRs(SQLSelect($PHP)));

} // retourne un int 


function getNext($idVolume){
    // donne l'id du tome suivant s'il existe

    $PHP = "SELECT next
            FROM  volumes 
            WHERE id = $idVolume;";
    return (parcoursRs(SQLSelect($PHP)));

} // retourne un int


//// FONCTIONS METIERS LIÉE A UNE SERIE ////

function getVolumes($idManga) {
    // Donne la liste de tous les tome d'une série

    $PHP = "SELECT * 
            FROM  volumes 
            WHERE mid = $idManga
            ORDER BY id ASC;";
    return (parcoursRs(SQLSelect($PHP)));

} // retourne un tableau associatif

function getTome($idManga, $idTome) {
    // Donne la liste de tous les tome d'une série

    $PHP = "SELECT * 
            FROM volumes 
            WHERE mid='$idManga' AND id='$idTome';";
    return parcoursRs(SQLSelect($PHP));

} // retourne un tableau associatif

function getSerie($idManga) {
    // Donne la liste de toutes les séries

    $PHP = "SELECT *
            FROM  mangas
            WHERE id = '$idManga' ;";
    return (parcoursRs(SQLSelect($PHP)));

} // retourne un tableau associatif

function getSeriesWithLastVolumeCover() {
    // donne la listes de mangas avec la couverture du dernier tome

    $PHP = "SELECT mangas.*, volumes.cover
            FROM  mangas JOIN volumes ON mangas.id = volumes.mid
            WHERE volumes.next IS NULL";
            //HAVING volumes.next = 0 ;";
    return (parcoursRs(SQLSelect($PHP)));

}
function searchSeries($keyword, $listtags, $order){
    // donne la liste des series par theme et par mot clé avec la couverture du dernier tome
    $a = "%";

    switch($order) {
        case "date":
            $orderby = "ORDER BY mangas.year DESC;";
        break;

        case "title":
            $orderby = "ORDER BY mangas.title ASC;";
        
        default:
            $orderby = ";";
    }


    if($nb = count($listtags)) {
        $chaineTags = "IN (" . implode(",", $listtags) . ")";
        $groupby = "GROUP BY mangas.id HAVING COUNT(*) = $nb ";
    }
    else {
        $chaineTags = "";
        $groupby =  "";
    }

    
    $chaineTitre = $a . $keyword . $a;

    $PHP = "SELECT DISTINCT mangas.*, volumes.cover
            FROM  mangas JOIN tags ON mangas.id = tags.mid 
                         JOIN themes ON tags.tid = themes.id 
                         JOIN volumes ON volumes.mid = mangas.id
            WHERE themes.id $chaineTags AND (mangas.titre LIKE '$chaineTitre' AND volumes.next IS NULL) 
            $groupby 
            $orderby";
    
    return (parcoursRs(SQLSelect($PHP)));

} // retourne un tableau associatif

function getSerieTags($idManga) {
   // retourne la liste des identifiant tags et le label pour une série

    $PHP = "SELECT DISTINCT tags.tid , themes.label
            FROM  mangas JOIN tags ON mangas.id = tags.mid JOIN themes ON tags.tid = themes.id 
            WHERE mangas.id = $idManga;";
    return (parcoursRs(SQLSelect($PHP)));

} // retourne un tableau associatif 

function getSerieInfos($idManga) {
    // donne les infos relatives a un manga sous forme de tableau associatif

    $PHP = "SELECT *
            FROM mangas
            WHERE id = $idManga;";
    return (parcoursRs(SQLSelect($PHP)));
}

function getFirstTomeSerie($idManga) {
    // donne les infos relatives au premier tome d'un manga sous forme de tableau associatif
    $PHP = "SELECT *
            FROM volumes
            WHERE ((mid = $idManga) AND (num = 1));";
    return (parcoursRs(SQLSelect($PHP)));
}

//// FONCTIONS METIERS LIEE A UNE NEWS ////

function getNews(){
    // liste toutes les informations nécessaires pour l'affichage de toutes les news ( sur carroussel ou page de news ).
    $PHP = "SELECT *
            FROM news;";
    return parcoursRs(SQLSelect($PHP));
    
} // retourne un tableau associatif 

function getNewsDecroi(){
    // liste toutes les informations nécessaires pour l'affichage de toutes les news dans l'ordre decroissant pouyr l'historique des news.
    $PHP = "SELECT *
            FROM news
            ORDER BY date DESC;";
    return parcoursRs(SQLSelect($PHP));
    
} // retourne un tableau associatif 

//// Fonction générale ////

function getComments($id, $typecomm){
    // liste les commentaires liés à une news, un tome ou une série via un champ caché récupéré dans typecomm
    // typecomm = {news,tome,serie}

    $PHP="SELECT * FROM ";
    switch ($typecomm) {
        case 'news':
            $PHP .= "comment_n WHERE nid=$id;";
            break;
        case 'tome':
            $PHP .= "comments_v WHERE vid=$id;";
            break;
        case 'serie':
            $PHP .= "comment_m WHERE mid=$id;";
            break;
        
        default:
            $PHP .= "comment_n WHERE nid=$id;";
            break;
    }
    return parcoursRs(SQLSelect($PHP));

} // retourne un tableau associatif

function addComment($uid, $content, $type, $id) {
    // Fonction qui insère un commentaire selon si c'est un commentaire de news, de tome, de séries
    // typecomm = {news,tome,serie}
    
    $PHP="INSERT INTO ";
    switch ($type) {
        case 'news':
            $PHP .= "comment_n (uid,nid,comment) ";
            break;
        case 'tome':
            $PHP .= "comments_v (uid,vid,comment) ";
            break;
        case 'serie':
            $PHP .= "comment_m (uid,mid,comment) ";
            break;
        
        default:
            $PHP .= "comment_n (uid,nid,comment) ";
            break;
    }
    $PHP .= "VALUES ($uid,$id,$content);";
    return SQLUpdate($PHP);
}


/* Fonction métiers liées aux themes */

function getTags() {
    $PHP = "SELECT themes.id, themes.label
            FROM themes;";

    return parcoursRS(SQLSelect($PHP));
}

function getListReviewByUser($idUser){
    // liste les reviews d'un volume
    $PHP = "SELECT id
            FROM reviews 
            WHERE uid = $idUser;";
    return (parcoursRs(SQLSelect($PHP)));
} // retourne un tableau contenant les id de review d'un utilisateur 


function sessionchange($idU,$num)
{
    if ($num == 0)
        $PHP = "UPDATE users 
                SET connected = 0 
                WHERE id = $idU;";
    else 
        $PHP = "UPDATE users 
        SET connected = 1 
        WHERE id = $idU ;" ;
    return SQLUpdate($PHP);   
}

?>
