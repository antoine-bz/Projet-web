<?php
include_once "libs/modele.php";
/*
Ce fichier définit diverses fonctions permettant mettre en oeuvre les fonctionnalitées du site web
*/

function mkAnnoncePreview($idAnnonce,$classname = "previewAnnonce")
{

    $entreprise=getEntreprise(getIdEntreprise($idAnnonce));

    $nomEntreprise=$entreprise[0]["nom"];
    $adresse=$entreprise[0]["adresse"];


    $Annonce=getAnnonce($idAnnonce);
    $nom=$Annonce[0]["nom"];
    $type=$Annonce[0]["type"];
    $publication=$Annonce[0]["date"];



    echo"<div class=\"row mb-1\">";
    echo"<div class=\"col-md-2\">";
    echo"<div class=\"row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative\">";
    echo"<div class=\"col p-4 d-flex flex-column position-static\">";
    echo"<strong class=\"d-inline-block mb-2 text-primary\">$nom</strong>";
    echo"<h4 class=\"mb-0\">$nomEntreprise</h4>";
    echo"<div class=\"mb-1 text-muted\">$publication</div>";
    echo"<a class=\"info\" href=\"index.php?view=annonce&id=$idAnnonce\"></a>";
    echo"<p>Stage : $type <br/> Adresse : $adresse</p>";

    echo"<a href=\"index.php?view=annonce&id=$idAnnonce\" class=\"stretched-link\">Voir plus</a>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
