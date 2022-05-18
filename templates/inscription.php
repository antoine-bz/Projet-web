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
<link rel="stylesheet" type="text/css" href="css/styleinscri.css">
<div id="formSignin">
<?php
if ($msg) {
	echo "<h3 style=\"color:red;\">" . $msg ."</h3>";
}
?>
<main class="form-signin w-100 m-auto">
<form action="controleur.php" method="GET">
    <h1 class="h3 mb-3 fw-normal">Inscription</h1>
    <input type="radio" name="main-categories" id="signinetudiant" value="1" onchange="showSignInEtudiantForm();"
	<?php if(!$login = valider("entreprise")) echo "checked";?>/>
	<label for="signinetudiant">Etudiant</label>

	<input type="radio" name="main-categories" id="signinentreprise" value="2"  onchange="showSignInEntrepriseForm();"
	<?php if($login = valider("entreprise")) echo "checked";?>/>
	<label for="signinentreprise">Entreprise</label><br/><br/>
    <div class="form-floating">
      <input type="email" class="form-control" name="mail" id="floatingInput mail" placeholder="name@example.com">
      <label for="floatingInput">Adresse email</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password" id="floatingPassword password" placeholder="Password" >
      <label for="floatingPassword">Mot de passe</label>
    </div>
    <div id="signinetudiantform"<?php if($login = valider("entreprise")) echo "style=\"display: none;\""?>>
    	<div class="form-floating">
      		<input type="nom" class="form-control" id="floatingInput nomEtudiant" name="nomEtudiant" placeholder="name@example.com">
      		<label for="floatingInput">Nom</label>
    	</div>
    	<div class="form-floating">
      		<input type="prenom" class="form-control" id="floatingPassword prenomEtudiant" name="prenomEtudiant" placeholder="Password">
      		<label for="floatingPassword">Prenom</label>
    	</div>
	</div>
	<div id="signinentrepriseform"<?php if($login = valider("entreprise")) echo "style=\"display: block;\""?>>
			<div class="form-floating">
				<input type="nomEntreprise" class="form-control" id="floatingInput nomEntreprise" name="nomEntreprise" placeholder="nom entreprise">
				<label for="floatingInput">Nom de l'entreprise</label>
			</div><br/>
			<label for="secteurAct"> Secteur d'activité :  </label>
			<?php
			$carac= getSecteurs();
			mkSelect("secteurAct", $carac, "idSecteur", "nom");
			?>
	</div>
    <br/><input class="w-100 btn btn-lg btn-secondary" type="submit" id="inscription" name="action" value="S'inscrire" />
  </form>
</div>
</main>

