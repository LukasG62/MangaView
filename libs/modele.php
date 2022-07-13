<?php


include_once "config.php";
include_once "LibMangaview.php";

//// FONCTIONS METIERS LIÉE A UN UTILISATEUR ////

function getUser($idUser) {
    // Fonction retournant toutes les information d'un utilisateur
    // Params : idUser, l'id de l'utilisateur
    $db = Config::getDatabase();
    $params = [$idUser];
    
    $sql = "SELECT users.*, grades.label AS gradeLabel
            FROM users JOIN grades ON grades.id = users.grade
            WHERE users.id = ?";

    return Database::parcoursRs($db->SQLSelect($sql, $params));
    
} //Retourne un tableau associatif 

function deleteUser($idUser) {
    // Fonction supprime toutes les informations de l'utilisateur via son id
    // Params : idUser, l'id de l'utilisateur
    $db = Config::getDatabase();
    return 0;
    
} // Retourne 1 ou 0 


function getGrade($idUser) {
    // Fonction retournant la valeur numérique du grade d'un utilisateur
    $db = Config::getDatabase();
    $params = [$idUser];
    $sql = "SELECT grades.id
            FROM users JOIN grades ON users.grade = grades.id
            WHERE users.id = ?;";
    
    
    return $db->SQLGetChamp($sql, $params);

} // retourne un nombre 

function isUserConnected($idUser) {
    // Fonction retournant vrai si l'utilisateur est connectés
    $db = Config::getDatabase();
    $params = [$idUser];
    $sql = "SELECT connected 
            FROM users
            WHERE id = ?;";
    
    return $db->SQLGetChamp($sql, $params);
} // retourne 0 ou 1

function getUserCredentials($pseudo) {
    // Fonction qui récupère l'id le login et le mot de passe de l'utilisateur portant le pseudo $pseudo 
    $db = Config::getDatabase();
    $params = [$pseudo];
    $sql = "SELECT id, pseudo, password
            FROM users
            WHERE pseudo = ?;";
    
    return Database::parcoursRs($db->SQLSelect($sql, [$pseudo]));
}

function createUser($pseudo,$password, $bio = "",$grade=0, $avatar="") {
    // Fonction qui inserer un utilisateur dans la bdd
    $db = Config::getDatabase();
    
    if($avatar == "") {
        $sql = "INSERT INTO users(grade,pseudo,password,bio, avatarValided) VALUES (?,?,?,?, 0);";
        return $db->SQLInsert($sql, [$grade, $pseudo, $password, $bio]);
    
    }
    $sql = "INSERT INTO users(grade,pseudo,password,bio,avatar, avatarValided) VALUES (?, ?, ?, ?, ?, 0);";
    return $db->SQLInsert($sql,[$grade, $pseudo, $password, $bio, $avatar]);
} // retourne 1 ou 0

function getLastUserId() {
    $db = Config::getDatabase();
    $sql = "SELECT MAX(id) AS last_id FROM users";

    return $db->SQLGetChamp($sql);
}

function changeUserPseudo($idUser, $newPseudo){
    // Fonction qui change le pseudo de l'utilisateur
    $db = Config::getDatabase();
    $params = [$newPseudo, $idUser];
    $sql = "UPDATE users 
            SET pseudo = ?
            WHERE id = ?;";

    
    return $db->SQLUpdate($sql, $params);
} // retourne 1 ou 0

function changeUserPassword($idUser, $newPassword){
    // Fonction qui change le mot de passe de l'utilisateur
    $db = Config::getDatabase();
    $params = [$newPassword, $idUser];
    $sql = "UPDATE users 
            SET password = ?
            WHERE id = ?;";
    
    return $db->SQLUpdate($sql, $params);
}

function changeUserAvatarPath($idUser, $newAvatar){
    // Fonction qui change le pseudo de l'utilisateur
    // La fonction met egallement 0 à avatarValided 
    $db = Config::getDatabase();
    $params = [$idUser, $newAvatar, $idUser];
    $sql = "UPDATE users 
            SET avatar = ?
            WHERE id = ?;
            
            UPDATE users 
            SET avatarValided = 0
            WHERE id = ?;";
    
    return $db->SQLUpdate($sql, $params);
} 

function changeUserBio($idUser, $newBio) {
    // Fonction qui change la bio de l'utilisateur
    $db = Config::getDatabase();
    $params = [$newBio, $idUser];
    $sql = "UPDATE users 
            SET bio = ?
            WHERE id = ?;";
    return $db->SQLUpdate($sql);;
    
} 

//// FONCTIONS METIERS LIÉE A UN TOME ////

function getVolume($idVolume){
    // Retourne toute les info d'un tome
    $db = Config::getDatabase();
    $sql = "SELECT volumes.*, mangas.banner AS mangaBanner
            FROM volumes JOIN mangas ON mangas.id = volumes.mid 
            WHERE volumes.id = ?;";

    return Database::parcoursRs($db->SQLSelect($sql, [$idVolume]));

} //Retourne un tableau associatif

function addToCollection($idUser, $idVolume,$fav) {
    // Ajoute un volume à la collection de utilisateur
    $db = Config::getDatabase();
    $params = [$idUser, $idVolume, $fav];
    $sql = "INSERT INTO collections (uid,vid,fav)
            VALUES (?, ?, ?);";
    return $db->SQLUpdate($sql, $params);
} // retourne 0 ou 1

function inCollection($idUser, $idVolume) {
    // Cherche un volume dans une collection : retourne faux si aucun trouvé
    $db = Config::getDatabase();
    $params = [$idUser, $idVolume];
    $sql = "SELECT *
            FROM collections 
            WHERE uid = ? 
            AND vid = ?";
    return $db->SQLGetChamp($sql, $params) ;
} // retourne 0 ou 1

function getReviews($idVolume){
    // liste les reviews d'un volume
    $db = Config::getDatabase();
    $sql = "SELECT reviews.*, users.avatar AS userAvatar, users.pseudo AS userPseudo, users.avatarValided
            FROM reviews JOIN users ON users.id = reviews.uid 
            WHERE reviews.vid = ?;";

    return Database::parcoursRs($db->SQLSelect($sql, [$idVolume]));
} // retourne un tableau contenant toutes les infos d'une reviews

function getUserReviews($idUser){
    // liste les reviews d'un volume
    $db = Config::getDatabase();
    $sql = "SELECT reviews.*, users.avatar AS userAvatar, users.pseudo AS userPseudo, users.avatarValided
            FROM reviews JOIN users ON users.id = reviews.uid
            WHERE users.id=?;";
    
    return Database::parcoursRs($db->SQLSelect($sql, [$idUser]));
} // retourne un tableau contenant les infos d'une review

function getCollection($idUser,$fav = 0) {
    // Récupère la collection d'un utilisateur et renvoie les informations de la collection
    $db = Config::getDatabase();
    $chainefav = "";
    if($fav) {
        $chainefav = "AND fav = 1";
    }

    $sql = "SELECT mangas.banner, volumes.mid, volumes.id, volumes.title, volumes.cover
            FROM collections JOIN volumes ON collections.vid = volumes.id
                     JOIN users ON collections.uid = users.id
                     JOIN mangas ON mangas.id = volumes.mid
            WHERE users.id = ? $chainefav
            ORDER BY mangas.id ASC, volumes.num ASC ";
    
    return Database::parcoursRs($db->SQLSelect($sql, [$idUser]));

} //Retourne un tableau associatif


function getPrev($idVolume){
    // donne l'id du tome précédent s'il existe
    $db = Config::getDatabase();
    $sql = "SELECT prev
            FROM  volumes 
            WHERE id = $idVolume;";
    
    return Database::parcoursRs($db->SQLSelect($sql, [$idVolume]));

} // retourne un int 


function getNext($idVolume){
    // donne l'id du tome suivant s'il existe
    $db = Config::getDatabase();
    $sql = "SELECT next
            FROM  volumes 
            WHERE id = $idVolume;";
    return Database::parcoursRs($db->SQLSelect($sql, [$idVolume]));

} // retourne un int


//// FONCTIONS METIERS LIÉE A UNE SERIE ////

function getVolumes($idManga) {
    // Donne la liste de tous les tomes d'une série
    $db = Config::getDatabase();
    $sql = "SELECT * 
            FROM  volumes 
            WHERE mid = ?
            ORDER BY id ASC;";
    return Database::parcoursRs($db->SQLSelect($sql, [$idManga]));

} // retourne un tableau associatif


function searchSeries($keyword, $listtags, $order){
    // donne la liste des series par theme et par mot clé avec la couverture du dernier tome
    $db = Config::getDatabase();
    $chaineTitre = "%" . $keyword . "%"; // TODO supprimer les wild cards dans keyword

    switch($order) {
        case "date":
            $orderby = "ORDER BY mangas.year DESC;";
        break;

        case "title":
            $orderby = "ORDER BY mangas.titre ASC;";
        
        default:
            $orderby = "ORDER BY mangas.titre ASC;";
    }


    if($nb = count($listtags)) {
        $chaineTags = "IN (" . implode(",", $listtags) . ")";
        $groupby = "GROUP BY mangas.id HAVING COUNT(*) = $nb ";
    }
    else {
        $chaineTags = "";
        $groupby =  "";
    }

    $sql = "SELECT DISTINCT mangas.*, volumes.cover
            FROM  mangas JOIN tags ON mangas.id = tags.mid 
                         JOIN themes ON tags.tid = themes.id 
                         JOIN volumes ON volumes.mid = mangas.id
            WHERE themes.id $chaineTags AND (mangas.titre LIKE ? AND volumes.next IS NULL) 
            $groupby 
            $orderby";

    return Database::parcoursRs($db->SQLSelect($sql, [$chaineTitre]));

} // retourne un tableau associatif

function getSerieTags($idManga) {
   // retourne la liste des identifiant tags et le label pour une série
    $db = Config::getDatabase();
    $sql = "SELECT DISTINCT tags.tid , themes.label
            FROM  mangas JOIN tags ON mangas.id = tags.mid JOIN themes ON tags.tid = themes.id 
            WHERE mangas.id = ?;";
    return Database::parcoursRs($db->SQLSelect($sql, [$idManga]));

} // retourne un tableau associatif 

function getSerieInfos($idManga) {
    // donne les infos relatives a un manga sous forme de tableau associatif
    $db = Config::getDatabase();
    $sql = "SELECT *
            FROM mangas
            WHERE id = ?;";
    return Database::parcoursRs($db->SQLSelect($sql,[$idManga]));
}

function getFirstTomeSerie($idManga) {
    // donne les infos relatives au premier tome d'un manga sous forme de tableau associatif
    $db = Config::getDatabase();
    $sql = "SELECT *
            FROM volumes
            WHERE ((mid = ?) AND (num = 1));";
    return Database::parcoursRs($db->SQLSelect($sql, [$idManga]));
}

//// FONCTIONS METIERS LIEE A UNE NEWS ////

function getNews(){
    // liste toutes les informations nécessaires pour l'affichage de toutes les news ( sur carroussel ou page de news ).
    $db = Config::getDatabase();
    $sql = "SELECT news.*, users.pseudo AS userPseudo
            FROM news JOIN users ON users.id = news.uid
            ORDER BY date DESC;";
    return Database::parcoursRs($db->SQLSelect($sql));
    
} // retourne un tableau associatif 

function getNewsById($idNews) {
    $db = Config::getDatabase();
    $sql = "SELECT news.*, users.pseudo AS userPseudo
            FROM news JOIN users ON news.uid = users.id
            WHERE news.id=?";

    return Database::parcoursRs($db->SQLSelect($sql, [$idNews]));
}

//// Fonction générale ////

function getComments($id, $typecomm){
    // liste les commentaires liés à une news, un tome ou une série via un champ caché récupéré dans typecomm
    // typecomm = {news,tome,serie}
    $db = Config::getDatabase();

    $sql="SELECT comments.*, users.pseudo AS userPseudo, users.avatar AS userAvatar, users.avatarValided FROM ";
    $join = "JOIN users ON comments.uid = users.id";
    switch ($typecomm) {
        case 'news':
            $sql .= "comment_n AS comments $join WHERE nid=? ORDER BY id DESC;";
            break;
        case 'tome':
            $sql .= "comments_v AS comments $join WHERE vid=? ORDER BY id DESC;";
            break;
        case 'serie':
            $sql .= "comment_m AS comments $join WHERE mid=? ORDER BY id DESC;";
            break;

    }
    return Database::parcoursRs($db->SQLSelect($sql, [$id]));

} // retourne un tableau associatif

function addComment($uid, $content, $type, $id) {
    // Fonction qui insère un commentaire selon si c'est un commentaire de news, de tome, de séries
    // typecomm = {news,tome,serie}
    $db = Config::getDatabase();
    $sql="INSERT INTO ";
    switch ($type) {
        case 'news':
            $sql .= "comment_n (uid,nid,comment) ";
            break;
        case 'tome':
            $sql .= "comments_v (uid,vid,comment) ";
            break;
        case 'serie':
            $sql .= "comment_m (uid,mid,comment) ";
            break;
        
        default:
            $sql .= "comment_n (uid,nid,comment) ";
            break;
    }
    $sql .= "VALUES (?, ?, ?);";
    return $db->SQLUpdate($sql, [$uid, $id, $content]);
}

function addfav($uid,$id,$val){
    $db = Config::getDatabase();
    $params = [boolval($val),$uid, $id];
    var_dump($params);
    //die();
    $sql="UPDATE collections SET fav =? WHERE uid =? AND vid =?;";
    
    return $db->SQLUpdate($sql,$params);
}   

function isfav($uid,$id){
    $db = Config::getDatabase();

    $sql="SELECT fav 
          FROM collections 
          WHERE uid = ? AND vid = ? ;";
     return $db->SQLGetChamp($sql, [$uid, $id]);
}

function removecollec($uid,$id)
{
    $db = Config::getDatabase();
    $sql="DELETE FROM collections
          WHERE uid = ? 
          AND vid = ? ;";
    return $db->SQLDelete($sql, [$uid, $id]);
}

function addReview($uid, $content,$note,$vid) {
    // Fonction qui insère une review
    $db = Config::getDatabase();
    $sql="INSERT INTO reviews (uid,content,note,vid) VALUES (?, ?, ?, ?);";
    return $db->SQLUpdate($sql, [$uid, $content, $note, $vid]);
}


/* Fonction métiers liées aux themes */

function getTags() {
    $db = Config::getDatabase();
    $sql = "SELECT themes.id, themes.label
            FROM themes;";

    return Database::parcoursRS($db->SQLSelect($sql));
}

function sessionchange($idUser,$connected)
{
    $db = Config::getDatabase();

    if ($connected == 0)
        $sql = "UPDATE users 
                SET connected = 0 
                WHERE id = ?;";
    else 
        $sql = "UPDATE users 
        SET connected = 1 
        WHERE id = ? ;" ;
    return $db->SQLUpdate($sql, [$idUser]);   
}


function editComment($idUser, $cid, $type, $newComment) {
    $db = Config::getDatabase();

    $sql = "UPDATE " . getCommentTableName($type) . "SET comment = ? WHERE uid=? AND id=?;";
    return $db->SQLUpdate($sql, [$newComment, $idUser, $cid, ]);
}

function deleteComment($idComment, $uid, $isAdmin, $type) {
    $db = Config::getDatabase();
    $sql = "DELETE FROM " . getCommentTableName($type) . " WHERE id=? AND (uid=? OR ?);";


    return $db->SQLDelete($sql, [$idComment, $uid, $isAdmin]);
}

?>
