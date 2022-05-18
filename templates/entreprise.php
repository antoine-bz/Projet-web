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
<link rel="stylesheet" type="text/css" href="css/styleentrep.css">
<main>
    <h1>Inscrivez vous avec un compte entreprise</h1><br/>
    <p class="fs-5 col-md-8">Vous pouvez créer votre compte entreprise afin de poster des offres de stage qui seront visible par les etudiants, par la suite vous pourrez consulter et étudier les CV des étudiants qui ont choisis une de vos annonces puis par la suite vous jugerez si ce CV est à la hauteur de vos attentes en retournant à l'étudiant une réponse positive ou négative.</p><br/>

    <div class="mb-5">
      <a href="index.php?view=inscription&entreprise=1" class="btn btn-secondary btn-lg px-4">S'inscrire en tant qu'entreprise</a>
    </div>

    <hr class="col-3 col-md-2 mb-5">

    <div class="row g-5">
      <div class="col-md-6">
        <h2>Commencer à publier vos annonces !</h2>
        <p>En créant votre compte entreprise, vous pourrez directement publier vos premières annonces !</p>
      </div>

      <div class="col-md-6">
        <h2>Répondez aux annonces</h2>
        <p>En recevant les CV des étudiants vous pouvez répondre positivement ou négativement à leur demande.</p>
      </div>
    </div>
  </main>