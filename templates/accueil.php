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

<link rel="stylesheet" type="text/css" href="css/styleacc.css">
<div id="corps">

<h1>Bienvenue sur 2i'ndeed !</h1>
<br/>
<h5>Rechercher votre stage :</h5>
<br/>
<form action="controleur.php" method="GET">
	<input type="text" id="ou" name="ou" placeholder="Ville ou code postal"/><br/>
	<input type="text" id="quoi" name="quoi" placeholder="Métier, entreprise"/><br/>
	<input type="submit" id="rechercher" name="action" value="Rechercher"/>
</form>
<br/>
<br/>
<u><h3>Dernières annonces :</h3></u>
<br/>

</div>
