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

    echo"<div class=\"previewAnnonce\">";
    echo"<a class=\"info\" href=\"index.php?view=annonce&id=$idAnnonce\">";
    echo $nom."</a><br/><br/> ".$type."<br>";
    echo $nomEntreprise.", ".$adresse."<br>";
    echo "Publiée le ".$publication."        ";

    echo"<a class=\"seemore\" href=\"index.php?view=annonce&id=$idAnnonce\">Voir plus </a><br><br>";
    echo "</div>";
}



    