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
<br/>
<h5>Rechercher votre stage :</h5>
<br/>
<form action="controleur.php" method="GET">
    <input class="form-control form-control-lg" id="Ville" type="text" placeholder="Ville"><br/>
    <input class="form-control form-control-lg" id="Secteur" type="text" placeholder="Secteur"><br/>
    <button type="submit" id="btn_recherche" class="btn btn-secondary mb-2">Rechercher</button>
</form>
<br/>
<br/>
<u><h3>Dernières annonces :</h3></u>
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
