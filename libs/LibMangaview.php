<?php

include_once "modele.php";

$uploadInfo = [ "USERPATH" => "ressources/img/users",
                "NEWSPATH" => "ressources/img/news",
                "VOLUMESPATH" => "ressources/img/volumes",
                "SERIESPATH" => "ressources/img/mangas",
              ];


function isUserAdmin($idUser) {
    // Fonction retournant vrai si le grade utilisateur >= 20
    
}

function isUserBlacklist($idUser) {
    // Fonction retournant vrai si le grade utilisateur == -1
    
}

function isUserReviewer($idUser) {
    // Fonction retournant vrai si le grade utilisateur > 10
}

function uploadUserAvatar($filename, $uploadInfo) {
   // Fonction permettant l'upload des avatar des utilisateur

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
        "~\[center\](.*?)\[/center\]~si",
        "~\[right\](.*?)\[/right\]~si",
        "~\[left\](.*?)\[/left\]~si",
        "~\[quote\](.*?)\[/quote\]~si",
        "~\[size=(.*?)\](.*?)\[/size\]~si",
        "~\[color=(.*?)\](.*?)\[/color\]~si",
        "~\[url\]((?:ftp|https?)://.*?)\[/url\]~si",
        "~\[img\](https?://.*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]~si",
        "~\\n~s",
        "~\[spoiler\](.*?)\[/spoiler\]~si"
    );
    // dans ce tableau on peut y trouver $1, $2 ... $n
    // Cela indique que l'on récupère le contenu de la n-eme parenthèse
    $htmltags = array(
        '<b>$1</b>',
        '<i>$1</i>',
        '<span style="text-decoration:underline;">$1</span>',
        '<span style="text-align: right">$1</span>',
        '<span style="text-align: left";">$1</span>',
        '<span style="text-align: center";">$1</span>',
        '<pre>$1</'.'pre>',
        '<span style="font-size:$1px;">$2</span>',
        '<span style="color:$1;">$2</span>',
        '<a href="$1">$1</a>',
        '<img src="$1" alt="" />',
        '<br />',
        '<span class="spoiler-hidden" onclick="toggle_spoiler(this)">$1</span>'
    );
    
    // Fonction qui permet de remplacer un pattern par un autre
    return preg_replace($bbcode,$htmltags,$text);
}

?>
