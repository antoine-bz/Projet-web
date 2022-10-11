
<link rel="stylesheet" type="text/css" href="css/styleProfilEtud.css">
<?php
if (!$idEtudiants=valider("id")) {
    rediriger("index.php?view=recherche");
}
$idUser=getIduserFromEtudiant($idEtudiants);

$nomDestinationCV="CVs/CV_de_".$idEtudiants.".pdf";
$nomDestinationPP="PPs/PP_de_".$idUser.".png";
if (!file_exists($nomDestinationPP)) $nomDestinationPP="PPs/default.png";
$Etudiant= getEtudiant($idEtudiants);
$connexion=getconnexionEtudiant($idEtudiants);
echo '<br/>';
echo '<br/>';
echo '<section class="section about-section gray-bg" id="about">';
echo '<div class="row g-0 border rounded overflow-hidden flex-md-row shadow-sm h-md-250">';
echo '<div class="col p-4 d-flex flex-column">';
echo '<div class="container"><div class="row align-items-center flex-row-reverse">';
echo '<div class="col-lg-6"><div class="about-text go-to"><h3 class="dark-color">'.$Etudiant[0]["prenom"].'&nbsp;'.$Etudiant[0]["nom"].'</h3>';
echo '<div class="row about-list">';
echo '<div class="media">';
echo '<label>Email</label><p class="theme-color lead">'.$connexion[0]["mail"].'</p></div>';
echo '</div><div class="col-md-6">';
echo '<div class="media"><label>Âge</label><p class="theme-color lead">'.$Etudiant[0]["age"].'</p>';
echo '</div>';
echo '<div class="col-md-6"><div class="media"><label>Téléphone</label><p class="theme-color lead">'.$Etudiant[0]["telephone"].'</p></div>';
echo '<div class="media"><label>Adresse</label><p class="theme-color lead">'.$Etudiant[0]["adresse"].'</p></div>';
if (file_exists($nomDestinationCV)){
    echo "<a class=\"btn btn-secondary\" href=\"".$nomDestinationCV."\" target=\"_blank\">Voir le CV</a></br>";
}
echo '</p>';
echo '</div></div></div></div><div class="col-lg-5">';
echo '<div class="about-avatar">';
echo '<img src="'.$nomDestinationPP.'" alt="photo de profil" class="rounded-circle" width="200">';
echo '</div></div></div></div></div></section>';

?>