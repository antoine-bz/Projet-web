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
//voici des idées pour faire la partie login
// 1. login
// 2. inscription


