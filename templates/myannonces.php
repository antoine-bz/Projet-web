<link rel="stylesheet" type="text/css" href="css/stylemyannonc.css">
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
	header("Location:../index.php?view=myannonces");
	die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");
include_once("libs/maLibForms.php");

?>

<?php
echo '<br/>';
echo '<a class="btn btn-secondary publier" href="index.php?view=publication">Publier une nouvelle annonce</a><br/>';
echo '<u><h3 class="h3 mb-3 fw-normal mt-3">Mes annonces</h3></u>';
$idEntreprise=getIdentreprises(valider("idUser","SESSION"));
$Annonces=getAnnoncesFromEntreprise($idEntreprise);
//echo json_encode($Annonces);
foreach($Annonces as $annonce)
{
    mkAnnoncePreview($annonce["idAnnonces"],"Entrepannonce2");
}

?>