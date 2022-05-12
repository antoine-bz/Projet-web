<?php


if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=accueil");
	die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php"); 
include_once("libs/maLibForms.php"); 




//////////  TODO    /////////////
//voici des idées pour faire la partie recherche
// 1. filrer les annonces
// 2. voir les annonces filtrées
// 3. voir les annonces filtrées par catégories
// 4. voir les annonces filtrées par ville etc
// 5. voir les annonces filtrées par mot clé (barre de recherche)




?>
