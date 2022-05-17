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
	header("Location:../index.php?view=accueil");
	die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");
include_once("libs/maLibForms.php");
$msg = valider("msg"); 

?>
<link rel="stylesheet" type="text/css" href="css/styleinscr.css">
<div id="formSignin">
<h1>Inscription</h1>
<?php
if ($msg) {
	echo "<h3 style=\"color:red;\">" . $msg ."</h3>";
}
?>
	<form action="controleur.php" method="GET">
	<input type="radio" name="main-categories" id="signinetudiant" value="1" onchange="showSignInEtudiantForm();"
	<?php if(!$login = valider("entreprise")) echo "checked";?>/>
	<label for="signinetudiant">Etudiant</label>

	<input type="radio" name="main-categories" id="signinentreprise" value="2"  onchange="showSignInEntrepriseForm();"
	<?php if($login = valider("entreprise")) echo "checked";?>/>
	<label for="signinentreprise">Entreprise</label>
	
		</br>
		<label for="login"> Adresse mail : </label><input type="text" id="mail" name="mail" /><br />
		<label for="password">Mot de passe : </label><input type="password" id="password" name="password" /><br />


		<div id="signinetudiantform"<?php if($login = valider("entreprise")) echo "style=\"display: none;\""?>>
			<label for="nomEtudiant"> Nom :  </label><input type="text" id="nomEtudiant" name="nomEtudiant" /><br />
			<label for="prenomEtudiant"> Prenom :  </label><input type="text" id="prenomEtudiant" name="prenomEtudiant" /><br />
		</div>

		<div id="signinentrepriseform"<?php if($login = valider("entreprise")) echo "style=\"display: block;\""?>>

			<label for="nomEntreprise"> Nom de l'entreprise :  </label><input type="text" id="nomEntreprise" name="nomEntreprise" /><br />
			<label for="secteurAct"> Secteur d'activité :  </label>
			<?php
			$carac= getSecteurs();
			mkSelect("secteurAct", $carac, "idSecteur", "nom");
			?>

		</div>
	
		<input type="submit" id="inscription" name="action" value="Inscription" />
	</form>
</div>

