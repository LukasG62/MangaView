<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=myprofile");
	die("");
}
$idUser = valider("idUser", "GET");
$pseudo = getUserPseudo($idUser);
$rank = getGradeLabel($idUser);
$bio = getUserBio($idUser);

?>


<img class="photoProfil" src="'. $uploadInfo["USERSPATH"] . getUserAvatar($idUser) .'" alt="User avatar"/>
    <h3><?php echo($pseudo);?></h3>
    <p>Rank : <?php echo($rank);?> </p>
    <div class="bio">
        <p><?php echo($bio);?></p>
    </div>
    <br>
    <h4 class="floatLeft">Ma collection</h4>
    <br>
    <select name="Choix" id="choixTriCollection">
        <option value="">--Please choose an  option</option>
        <option value="Tomes">Tomes</option>
        <option value="Manga">Manga</option>
    </select>
<br><br>
    <table class="collection">
        <tr>
            <td>
                <table>
                    <tr>
                        <td><img src="/Images/couverture1" alt="couverture 1" class="couverture"></td>
                    </tr>
                    <tr>
                        <td>Assassination Classroom 1</td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                        <td><img src="/Images/co" alt="couverture 2" class="couverture"></td>
                    </tr>
                    <tr>
                        <td>Assassination Classroom 2</td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                        <td><img src="/Images/couverture3" alt="couverture 3" class="couverture"></td>
                    </tr>
                    <tr>
                        <td>Assassination Classroom 3</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <h4 class="floatLeft">Mes Favoris</h4>
    <br>
    <select name="Choix" id="choixTriCollection">
        <option value="">--Please choose an  option</option>
        <option value="Tomes">Tomes</option>
        <option value="Manga">Manga</option>
    </select>
<br><br>
    <table class="favori">
        <tr>
            <td>
                <table>
                    <tr>
                        <td><img src="/Images/couverture1" alt="couverture 1" class="couverture"></td>
                    </tr>
                    <tr>
                        <td>Assassination Classroom 1</td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                        <td><img src="/Images/co" alt="couverture 2" class="couverture"></td>
                    </tr>
                    <tr>
                        <td>Assassination Classroom 2</td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                        <td><img src="/Images/couverture3" alt="couverture 3" class="couverture"></td>
                    </tr>
                    <tr>
                        <td>Assassination Classroom 3</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <h4>Mes Reviews</h4>

	<?php 
		$tabReviewUser = getListReviewByUser($idUser);
		foreach($tabReviewUser as $dataReview)
		{
			echo mkReview($dataReview);
		}
	?>
