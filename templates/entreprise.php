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
<div class="para">
	<p> Avec 2i'ndeed,
		vous pouvez créer votre compte entreprise et vous ajouter des étudiants à votre liste d'étudiants.
		Vous pourrez ainsi poster des offres<br/> de stage qui seront visible par les etudiants
		Consulter les cv des etudiant et contactez les.
	</p>
</div>
<div class="inscrire">
	<a href="index.php?view=inscription&entreprise=1" class="nav-link px-2">S'inscrire</a>
</div>