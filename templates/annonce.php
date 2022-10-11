<link rel="stylesheet" type="text/css" href="css/styleann.css">
<?php

include_once("libs/modele.php");




if (!$idAnnonce=valider("id")) {
    rediriger("index.php?view=recherche");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");
include_once("libs/maLibForms.php");

$msg = valider("msg"); 
if ($msg) {
	echo "<h3 style=\"color:red;\">" . $msg ."</h3>";
}



$idUser=valider("idUser","SESSION");

$idEntreprise=getIdEntreprise($idAnnonce);

$idUserAnnonce=getIduserFromEntreprise($idEntreprise);
$nomDestination="PPs/PP_de_".$idUserAnnonce.".png";
if (file_exists($nomDestination))
$linkPhoto=$nomDestination;
else $linkPhoto="PPs/default.png";


$entreprise=getEntreprise($idEntreprise);

$nomEntreprise=$entreprise[0]["nom"];
$adresse=$entreprise[0]["adresse"];


$Annonce=getAnnonce($idAnnonce);
$nom=$Annonce[0]["nom"];
$type=$Annonce[0]["type"];
$publication=$Annonce[0]["date"];

echo '<br/>';
echo '<br/>';
echo '<section class="section about-section gray-bg" id="about">';
echo '<div class="row g-0 border rounded overflow-hidden flex-md-row shadow-sm h-md-250">';
echo '<div class="col p-4 d-flex flex-column">';
echo '<div class="container"><div class="row align-items-center flex-row-reverse">';
echo '<div class="col-lg-6"><div class="about-text go-to"><h3 class="dark-color">'.$nomEntreprise.'</h3>';
echo '<h6 class="theme-color lead text-primary">'.$nom.'</h6>';
echo '<p>Type : '.$type.'</p><div class="row about-list">';
echo '<div class="media">';
echo '<label>Description</label><p class="theme-color lead">'.$Annonce[0]["description"].'</p></div>';
echo '<div class="col-md-6"><div class="media"><label>Date de publication</label><p class="theme-color lead">'.$publication.'</p></div>';
echo '<div class="media"><label>Adresse</label><p class="theme-color lead">'.$adresse.'</p></div>';
echo '</div><div class="col-md-6">';
echo '<div class="media"><label>Durée du stage</label><p class="theme-color lead">'.$Annonce[0]["duree"].' mois</p>';
echo '</div>';
echo '<div class="media"><label>Rémunération</label><p class="theme-color lead">';
if ($Annonce[0]["remuneration"]) echo "oui";
else echo "non";
echo '</p>';
echo '</div>';
echo '</div></div></div></div><div class="col-lg-5">';
echo '<div class="about-avatar">';
echo '<img src="'.$linkPhoto.'" alt="logo entreprise" class="rounded-circle" width="200">';
echo '</div></div></div></div></div></section>';



if($idEntreprise == (getIdentreprises($idUser))){
    mkform("controleur.php");
    mkInput("hidden","action","supprimerannonce");
    mkInput("hidden","idannonce",$idAnnonce);
    echo '<br/>';
    echo '<input class="w-30 btn btn-lg btn-secondary annonce" type="submit" value="Supprimer" />';
    endForm();
    $rep=getReponseAnnonce($idAnnonce);

    if(count($rep)>0){
    echo '<br/>';    
    echo '<u><h3 class="h3 mb-3 fw-normal">Réponses positives</h3></u>';
    $i=0;
    foreach($rep as $annonce)
     {
        if ($annonce["rep"]=="yes"){
            mkReponsesPreview($annonce,$i);
              }
        $i=$i+1;
     }
 echo '<u><h3 class="h3 mb-3 fw-normal">En attente de réponse</h3></u>';
    foreach($rep as $annonce)
     {
        if ($annonce["rep"]==""){
            mkReponsesPreview($annonce);
              }
       
     } 
    }
}
if( isetudiant($idUser)){
    $idetudiant=getIdetudiant($idUser);
    if ($repEtudiant=aRepondu($idetudiant ,$idAnnonce)){
        //echo json_encode($repEtudiant);
        if(!$repEtudiant[0]["rep"]){
            echo '<h3 class="h3 mb-3 fw-normal">En attente de réponse</h3>';
            mkform("controleur.php");
            mkInput("hidden","action","SupprimerReponse");
            mkInput("hidden","idannonce",$idAnnonce);
            mkInput("hidden","idetudiant",$idetudiant);
            echo '<input class="w-30 btn btn-lg btn-secondary annonce" type="submit" value="Supprimer la reponse" />';
            endForm();
            echo '<br/>';
        }
        else{
            echo '<br/>';
            echo '<h3 class="h3 mb-3 fw-normal">Vous avez déjà postulé pour ce stage !</h3>';
            if ($repEtudiant[0]["rep"]=="yes"){
                echo '<h3 class="h3 mb-3 fw-normal">Félicitations ! Réponse positive</h3>';
            }
            mkform("controleur.php");
            mkInput("hidden","action","SupprimerReponse");
            mkInput("hidden","idannonce",$idAnnonce);
            mkInput("hidden","idetudiant",$idetudiant);
            echo '<input class="w-30 btn btn-lg btn-secondary annonce" type="submit" value="Supprimer la reponse" />';
            endForm();
            echo '<br/>';

            //affichage d'un bouton pour afficher le contact de l'entreprise
          
            if ($repEtudiant[0]["rep"]=="yes"){
                //affichage d'un bouton pour afficher le contact de l'entreprise
                echo '<a id="contactme" class="btn btn-lg btn-secondary annonce">Contactez l\'entreprise</a>';
    
                $idEntreprise=getIdEntreprise($idAnnonce);
                $infoEntreprise=getEntreprise($idEntreprise);
                $connexionentreprise=getConnexionEntreprise($idEntreprise);
                echo "<div class=\"modal\" id=\"myModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalCenterTitle\" aria-hidden=\"true\">";
                echo "<div class=\"modal-dialog modal-dialog-centered\" role=\"document\">";
                echo "<div class=\"modal-content\">";
                echo "<div class=\"modal-header\">";
                echo "<h5 class=\"modal-title\" id=\"exampleModalCenterTitle\">Contact</h5>";
                echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">";
                echo "<span aria-hidden=\"true\">&times;</span>";
                echo "</button></div>";
                echo "<div class=\"modal-body\">";
    
                echo "<h5>".$infoEntreprise[0]["nom"]."</h5>";
                echo "Mail: <a href=\"mailto:". $connexionentreprise[0]['mail']."\">";
                echo $connexionentreprise[0]["mail"]."<br/></a>";
                echo "Telephone: <a href=\"tel:".  $infoEntreprise[0]['telephone']."\">";
                echo $infoEntreprise[0]['telephone']."<br/></a>";
    
                echo "</div>";
                echo "<div class=\"modal-footer\">";
                echo "<button type=\"button\" class=\"btn btn-secondary\" class=\"close\" data-dismiss=\"modal\">Fermer</button></div></div></div></div>";
                echo "<script type=\"text/javascript\"> document.getElementById(\"contactme\").onclick=function(){";
                echo "$('#myModal').modal('show');};</script>";
                }
        }
    }
    else{
        mkform("controleur.php");
        mkInput("hidden","action","PostulerAnnonce");
        mkInput("hidden","idannonce",$idAnnonce);
        mkInput("hidden","idetudiant",$idetudiant);
        echo '<br/>';
        echo '<textarea name="message" class="form-control" type="textarea" placeholder="Envoyez un message pour postuler" maxlength="255" name="message"></textarea>';
        echo '<br/>';
        echo '<input class="w-30 btn btn-lg btn-secondary annonce" type="submit"value="Postuler" />';
        endForm();
        
    }
    if(estFav($idetudiant,$idAnnonce)){
        mkform("controleur.php");
        mkInput("hidden","action","supprimerfavEtudiant");
        mkInput("hidden","idannonce",$idAnnonce);
        mkInput("hidden","idetudiant",$idetudiant);
        echo '<br/>';
        echo '<input class="w-30 btn btn-lg btn-secondary annonce" type="submit" value="Supprimer des favoris" />';
        endForm();
    }
    else{
        mkform("controleur.php");
        mkInput("hidden","action","ajouterfavEtudiant");
        mkInput("hidden","idannonce",$idAnnonce);
        mkInput("hidden","idetudiant",$idetudiant);
        echo '<br/>';
        echo '<input class="w-30 btn btn-lg btn-secondary annonce" type="submit" value="Ajouter aux favoris" />';
        endForm();
    }
    
}
?>