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


?>
<link rel="stylesheet" type="text/css" href="css/styleentreprise.css">
<h1>Inscrivez vous avec un compte entreprise</h1>
<br/>
<div class="para">
	<p> Avec 2i'ndeed,
		vous pouvez créer votre compte entreprise afin de poster des offres de stage qui seront visible par les etudiants, par la suite vous pourrez<br/> consulter et étudier les CV des étudiants qui ont choisis une de vos annonces puis par la suite vous jugerez si ce CV est à la hauteur de vos attentes en<br/> retournant à l'étudiant une réponse positive ou négative.
	</p>
</div>
<br/>
<div class="inscrire">
	<a href="index.php?view=inscription&entreprise=1" class="nav-link px-2">S'inscrire</a>
</div>