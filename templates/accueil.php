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

<link rel="stylesheet" type="text/css" href="css/styleaccueil.css">
<div id="corps">

<h1>Bienvenue sur 2i'ndeed !</h1>
<main class="form-signin w-30 m-auto">
<form action="controleur.php" method="GET">
    <h5 class="h3 mb-3 fw-normal">Rechercher votre stage :</h5>
    <input class="form-control form-control-lg" id="Ville" type="text" placeholder="Ville">
    <input class="form-control form-control-lg" id="Secteur" type="text" placeholder="Secteur"><br/>
    <input type="submit" id="btn_recherche" class="w-100 btn btn-lg btn-secondary" name="action" value="Rechercher"/>
</form>
</main>
<br/>
<br/>
<u><h3>Dernières annonces</h3></u>
<br/>
<div id="lastannonces">
    <?php
        $lastannonces=getLastAnnonce();
        //echo json_encode($lastannonces);
        foreach($lastannonces as $annonce)
        {
            mkAnnoncePreview($annonce["idAnnonces"],"previewAnnonce");
        }
    ?>
</div>

</div>
