<?php

include_once "modele.php";

$uploadInfo = [ "USERSPATH" => "ressources/img/users/",
                "NEWSPATH" => "ressources/img/news/",
                "VOLUMESPATH" => "ressources/img/tomes/",
                "SERIESPATH" => "ressources/img/mangas/",
              ];


function getStatusLabel($status) {
    // retourne la chaine correspondant à la valeur du status
    switch($status) {
        case 0:
            return "Annulé";

        case 1:
            return "En cours";

        case 2:
            return "Hiatus";
        
        case 3:
            return "Terminé";

        default :
            return "UNKNONW";
    }
}

function getStatusColor($status) {
    // Retourne la couleur du status
    switch($status) {
        case 0:
            return "color:red;";

        case 1:
            return "color:blue;";

        case 2:
            return "color:darkorange;";
        
        case 3:
            return "color:green;";

        default :
            return "color:black;";
    }
}

function isUserAdmin($idUser) {
    // Fonction retournant vrai si le grade utilisateur >= 20
    return getGrade($idUser) >= 20;
    
}

function isUserBlacklist($idUser) {
    // Fonction retournant vrai si le grade utilisateur == -1
    return getGrade($idUser) == -1;
    
}

function isUserReviewer($idUser) {
    // Fonction retournant vrai si le grade utilisateur > 10
    return getGrade($idUser) >= 10;
}

function uploadUserAvatar($filename, $uploadInfo) {
    // NOTE : VERIFIER AVANT APPELLE QUE $_FILES["fileToUpload"] existe avec la fonction valider
    // RETOURNE : 1 si succès
    // CODE ERREUR :
    // -1 type de fichier pas bon
    // -2 taile du fichier pas bon
    // -3 extension du fichier pas correct
    // -4 erreur survenu lors de l'upload
    
    $path = $uploadInfo["USERSPATH"]; // chemin des avatars
    

    $imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION)); // extension du fichier
    $file = $path . $filename . ".$imageFileType"; // le chemin du fichier
    $finfo = new finfo(FILEINFO_MIME_TYPE, null); // on déclare un objet finfo pour récupèrer le type du fichier uploadé

    $returnInfo["FILENAME"] = $filename . ".$imageFileType";

    // Vérification du type : on ne voudrais pas que l'utilisateur upload un fichier php par exemple
    $mine_type = explode("/", $finfo->file($_FILES["fileToUpload"]["tmp_name"]))[0]; // la méthode file retourne type/extension donc on garde le type pour vérifié si c une image
    if($mine_type != "image") {
        $returnInfo["CODE"] = -1;
        return $returnInfo;
    }
    // Vérification de la taille
    if ($_FILES["fileToUpload"]["size"] > 250*250) {// on récupère l'info de la taille dans la superglobale $_FILES
        $returnInfo["CODE"] = -2;
        return $returnInfo;
    }
    // Vérification de l'extension
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" ) {
        $returnInfo["CODE"] = -3;
        return $returnInfo;
    }

    // if everything is ok, try to upload file
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $file)) {
        $returnInfo["CODE"] = 1;
        return $returnInfo;

    }
    else {
        $returnInfo["CODE"] = -4;
        return $returnInfo;
    }
}

function bbcodeParser($text){ // TODO eviter cas du genre "[b][u][/b][u]"

    // Tout d'abords nous allons créer une table de conversion
    // Nous allons donc definir deux tableaux
    //        Un tableau pour le code bbcode
    //        Un tableau pour l'équivalent html du code
    // Pour le tableau bbcode nous allons y stocker des regex de type
    //         "~\[b\](.*?)\[/b\]~si",
    //         recherche de tous les pattern [b]<n'importe quel caractère>[\b]
    //         le tilde en début et fin de regex sont des delimiteurs pour la regex
    //         l'option s signifie que le "." remplace n'importe quel caractère y compris le retour à la ligne
    //         l'option i signifie que l'on ignore la casse (cela permet de reperer [b][/b] et [B][/B])
    //
    // Une fois les deux tables remplis, on peut utiliser la fonction php qui permet de remplacer des patternes par d'autres dans un texte
    
    $bbcode = array(
        "~\[b\](.*?)\[/b\]~si",
        "~\[i\](.*?)\[/i\]~si",
        "~\[u\](.*?)\[/u\]~si",
        "~\[right\](.*?)\[/right\]~si",
        "~\[left\](.*?)\[/left\]~si",
        "~\[center\](.*?)\[/center\]~si",
        "~\[quote\](.*?)\[/quote\]~si",
        "~\[size=(.*?)\](.*?)\[/size\]~si",
        "~\[color=(.*?)\](.*?)\[/color\]~si",
        "~\[url\]((?:ftp|https?)://.*?)\[/url\]~si",
        "~\[img\](https?://.*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]~si",
        "~\\n~s",
        "~\[spoiler\](.*?)\[/spoiler\]~si",
        "~\[url=((?:ftp|https?)://.*?)\](.*?)\[/url\]~si"
    );
    // dans ce tableau on peut y trouver $1, $2 ... $n
    // Cela indique que l'on récupère le contenu de la n-eme parenthèse
    $htmltags = array(
        '<b>$1</b>',
        '<i>$1</i>',
        '<span style="text-decoration:underline;">$1</span>',
        '<p style="text-align: right">$1</p>',
        '<p style="text-align: left";">$1</p>',
        '<p style="text-align: center";">$1</p>',
        '<pre>$1</'.'pre>',
        '<span style="font-size:$1px;">$2</span>',
        '<span style="color:$1;">$2</span>',
        '<a href="$1">$1</a>',
        '<img src="$1" alt="" />',
        '<br />',
        '<span class="spoiler-hidden" onclick="toggle_spoiler(this)">$1</span>',
        '<a href="$1">$2</a>'
    );
    
    // Fonction qui permet de remplacer un pattern par un autre
    return preg_replace($bbcode,$htmltags,$text);
}

function verifTagsArray($tab) {
    foreach($tab as $tags) {
        if(!intval($tags))
            return false;
    }
    return true;
}


function isCommentTypeValid($type) {
    switch($type){
        case "news":
            return "news";
        break;
    
        case "tome":
            return "tome";
        break;
    
        case "serie":
            return "manga";
        break;
        
        default:
            return false;
        break;
    }
}


function getCommentTableName($type) {
    switch ($type) {
        case 'news':
            return "comment_n ";
        break;
        
        case 'tome':
            return "comments_v ";
        break;
        
        case 'manga':
            return "comment_m ";
        break;
    }

}

function groupby($tab, $id){
    // Regourpe tout les tableaux associatifs de tab avec une même valeur de clé
    $res = array();
    // on parcours le tableau
    foreach($tab as $tabData) {
        // si on a aucun tableau à la clé id
        if(!isset($res[$tabData[$id]])){
            // on en crée un
            $res[$tabData[$id]] = array();
        }
        // on ajoute dans ce tableau l'enregistrement avec le même id
        array_push($res[$tabData[$id]], $tabData);
    }

    return $res;
}

?>
