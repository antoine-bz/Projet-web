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
//voici des idées pour faire la partie users
// gestion du compte (changer le mot de passe, modifier les informations personnelles)
// deconnexion
// changement de mot de passe
// changement de nom d'utilisateur
// changement de description


//voici des idées pour faire la partie etudiants
// 1. voir les favoris 
// 2. voir les réponses aux annonces 
// 3. messagerie avec les entreprises si réponse positive

//voici des idées pour faire la partie entreprises
// 1. voir les annonces postées
// 2. gerer les annonces (supprimer, modifier, etc)
// 3. voir et répondre aux candidatures
// 4. gerer les candidatures

?>
