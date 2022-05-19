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
<link rel="stylesheet" type="text/css" href="css/styleinfo.css">
<main>
    <h1>Qui sommes-nous ?</h1><br/>
    <p class="fs-5 col-md-8">Nous sommes des jeunes étudiants en école d'ingénieur informatique. Etant étudiant nous connaissons la difficulté de trouver des stages, nous avons donc pour but avec notre site de facilité la recherche d'un stage pour les étudiants et également faciliter la publication d'annonces pour les entreprises. Nous avons pensé et designé notre site afin que celui sois le plus simple possible pour faciliter l'accès à nos utilisateurs.</p><br/>
    <hr class="col-3 col-md-2 mb-5">

    <div class="row align-items-md-stretch">
      <div class="col-md-5">
        <div class="h-100 p-5 text-white bg-primary rounded-3">
          <h2>Commencer à trouver un stage</h2>
          <p>Vous pouvez dès à présent commencer à chercher un stage grâce à notre site qui répertorie toutes les annonces des entreprises qui se sont enregistés sur notre site.</p>
          <a class="btn btn-outline-light" href="index.php?view=recherche" type="button">Rechercher un stage</a>
        </div>
      </div>
      <div class="col-md-5">
        <div class="h-100 p-5 bg-light border rounded-3">
          <h2>Vous êtes une entreprise ?</h2>
          <p>Si vous êtes une entreprise, vous pouvez visiter notre page entreprise pour avoir plus d'information concernant notre site.</p>
          <a class="btn btn-outline-secondary" href="index.php?view=entreprise" type="button">Plus d'informations</a>
        </div>
      </div>
    </div>
  </main>
