<link rel="stylesheet" type="text/css" href="css/styleDepot.css">
<?php

//C'est la propriété php_self qui nous l'indique : 
// Quand on vient de index : 
// [PHP_SELF] => /chatISIG/index.php 
// Quand on vient directement par le répertoire templates
// [PHP_SELF] => /chatISIG/templates/accueil.php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
// Pas de soucis de bufferisation, puisque c'est dans le cas où on appelle directement la page sans son contexte
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=depot");
	die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");
include_once("libs/maLibForms.php");

$msg = valider("msg"); 
if ($msg) {
	echo "<h3 style=\"color:red;\">" . $msg ."</h3>";
}
if (valider("connecte","SESSION")){
	echo ("<h3>Deposer un CV</h3>");
	echo '<form action="upload.php" method="post" enctype="multipart/form-data">';
	echo 'Selectionner votre CV en format pdf: </br><input type="file" name="fileToUpload" id="fileToUpload">';
	echo '<input name="location" type="hidden" value="depot"></br>';
	echo '<input name="file" type="hidden" value="CV">';
	echo '<input name="idUser" type="hidden" value="'.valider("idUser","SESSION").'">';
	echo '<input type="submit" value="Deposer le CV" name="submit"></form>';

	$idEtudiant= getIdEtudiant(valider("idUser","SESSION"));
	$nomDestination = "CVs/CV_de_".$idEtudiant.".pdf";
	if(file_exists($nomDestination)){
		echo ("<h3>CV déjà déposé</h3>");
		echo "<a class=\"btn btn-secondary\" href=\"".$nomDestination."\" target=\"_blank\">Voir le CV</a>";

		echo '<form action="upload.php" method="GET">';
		echo '<input name="dest" type="hidden" value="'.$nomDestination.'">';
		echo '<input name="file" type="hidden" value="CV">';
		echo '<input name="action" type="hidden" value="supprimer">';
		echo '<input class="btn btn-secondary" type="submit" value="Supprimer le CV" name="submit">';
		echo '</form>';
	}
}
else {
	echo '<h1 class="mb-3">Vous n\'êtes pas connecté</h1>';
	echo '<p>Pour pouvoir deposer un CV, vous devez <a class="connecter" href="index.php?view=connexion">vous connecter</a> ou <a class="connecter" href="index.php?view=inscription">vous inscrire</a></p>';
}
?>

