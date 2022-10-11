<?php
include_once "libs/modele.php";
include_once "libs/maLibForms.php";
/*
Ce fichier définit diverses fonctions permettant mettre en oeuvre les fonctionnalitées du site web
*/

function mkAnnoncePreview($idAnnonce,$type="",$classname = "previewAnnonce")
{

    $entreprise=getEntreprise(getIdEntreprise($idAnnonce));

    $nomEntreprise=$entreprise[0]["nom"];
    $adresse=$entreprise[0]["adresse"];


    $Annonce=getAnnonce($idAnnonce);
    $nom=$Annonce[0]["nom"];
    $typeStage=$Annonce[0]["type"];
    $publication=$Annonce[0]["date"];



    echo"<div class=\"row mb-1\">";
    echo"<div class=\"col-md-11\">";
    echo"<div class=\"row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative\">";
    echo"<div class=\"col p-4 d-flex flex-column position-static\">";
    echo"<strong class=\"d-inline-block mb-2 text-primary\">$nom</strong>";
    echo"<h4 class=\"mb-0\">$nomEntreprise</h4>";
    echo"<div class=\"mb-1 text-muted\">$publication</div>";
    echo"<a class=\"info\" href=\"index.php?view=annonce&id=$idAnnonce\"></a>";
    echo"<p>Stage : $typeStage <br/> Adresse : $adresse</p>";

    echo"<a href=\"index.php?view=annonce&id=$idAnnonce\" class=\"stretched-link\">Voir plus</a>";
    //mkform("controleur.php");
    /*switch($type){
        case "compteEtudiant": //reponses
             echo"<a href=\"index.php?view=annonce&id=$idAnnonce\" class=\"stretched-link\">Supprimer</a>";
        break;
        case "compteEtudiant2": //Favoris
            echo"<a href=\"index.php?view=annonce&id=$idAnnonce\" >Supprimer</a>";
            echo"<a href=\"index.php?view=annonce&id=$idAnnonce\" class=\"stretched-link\">Postuler</a>";
        break;
        case "Entrepannonce":
            echo"<a href=\"controleur.php?action=publierannonce&idannonce=$idAnnonce\">Supprimer</a>";
        break;
        case "Entrepannonce2": //suppr annonces
            echo '<input type="hidden"  name="action"  value="publierannonce">';
            echo '<input type="hidden"  name="idannonce"  value="publierannonce">';
            echo"<a href=\"controleur.php?action=publierannonce&idannonce=$idAnnonce\">Supprimer</a>";
        break;
    }*/
    //endform();
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}


function mkReponsesPreview($reponse,$rep=NULL)
{
    $etudiant= getEtudiant($reponse["idEtudiants"]);
    $nomEtudiant=$etudiant[0]["nom"]." ".$etudiant[0]["prenom"];
    $ageEtudiant=$etudiant[0]["age"]. " ans";  
    $idAnnonce=$reponse["idAnnonces"];
    $nomDestination="CVs/CV_de_".$reponse["idEtudiants"].".pdf";

    echo"<div class=\"row mb-1\">";
    echo"<div class=\"col-md-11\">";
    //echo"<div class=\"row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative\">";
    echo"<div class=\"col p-4 d-flex flex-column position-static\">";
    echo"<strong class=\"d-inline-block mb-2 text-primary nometud\">$nomEtudiant</strong>";
    echo"<div class=\"mb-1 text-muted ageetud\">$ageEtudiant</div>";
    echo "<p class=\"dropdown-item\">";
    if ($reponse["message"])
        echo "Message: ".$reponse["message"]."</p>";
    echo"<a class=\"btn btn-secondary info1\" href=\"index.php?view=profilEtudiant&id=".$reponse["idEtudiants"]."\" target=\"_blank\" class=\"stretched-link\">Profil</a>";
    if (file_exists($nomDestination)){
        echo "<a class=\"btn btn-secondary info2\" href=\"".$nomDestination."\" target=\"_blank\">Voir le CV</a></br>";
    }
    if(!$rep){
        mkform("controleur.php");
        mkInput("hidden","action","reponsePostuler");
        mkInput("hidden","idannonce",$idAnnonce);
        mkInput("hidden","idetudiant",$reponse["idEtudiants"]);
        echo '<input class="w-30 btn btn-lg btn-secondary rep1" type="submit" name="reponse" value="Accepter" />';
        echo '<input class="w-30 btn btn-lg btn-secondary rep2" type="submit" name="reponse" value="Refuser" />';
        endForm();
    }
    else echo '<br/><a id="contactme'.$rep.'" class="btn btn-lg btn-secondary contact">Contactez l\'etudiant</a>';
    echo "</div>";
   // echo "</div>";
    echo "</div>";
    echo "</div>";

    

    if($rep){
    $infoEtudiant=getEtudiant($reponse["idEtudiants"]);
    $connexionetudiant=getconnexionEtudiant($reponse["idEtudiants"]);
    echo "<div class=\"modal\" id=\"myModal$rep\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalCenterTitle\" aria-hidden=\"true\">";
    echo "<div class=\"modal-dialog modal-dialog-centered\" role=\"document\">";
    echo "<div class=\"modal-content\">";
    echo "<div class=\"modal-header\">";
    echo "<h5 class=\"modal-title\" id=\"exampleModalCenterTitle\">Contact</h5>";
    echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">";
    echo "<span aria-hidden=\"true\">&times;</span>";
    echo "</button></div>";
    echo "<div class=\"modal-body\">";

    echo "<h5>".$infoEtudiant[0]["prenom"]." ".$infoEtudiant[0]["nom"]."</h5>";
    echo "Mail: <a href=\"mailto:". $connexionetudiant[0]['mail']."\">";
    echo $connexionetudiant[0]["mail"]."<br/></a>";
    echo "Telephone: <a href=\"tel:".  $infoEtudiant[0]['telephone']."\">";
    echo $infoEtudiant[0]['telephone']."<br/></a>";

    echo "</div>";
    echo "<div class=\"modal-footer\">";
    echo "<button type=\"button\" class=\"btn btn-secondary\" class=\"close\" data-dismiss=\"modal\">Fermer</button></div></div></div></div>";
    echo "<script type=\"text/javascript\"> document.getElementById(\"contactme$rep\").onclick=function(){";
    echo "$('#myModal$rep').modal('show');};</script>";
    }
}

