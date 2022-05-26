
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
	header("Location:../index.php?view=comptentreprise");
	die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");
include_once("libs/maLibForms.php");


?>
<link rel="stylesheet" type="text/css" href="css/styleCompteEntre.css">
<br/>
<form action="controleur.php" method="GET">
<?php 
    $infoidEntreprise=getIdentreprises(valider("idUser","SESSION"));
    //echo json_encode($infoidEntreprise);
    $infosEntreprise=getEntreprise($infoidEntreprise);
    
    //$infoid2Entreprise=getId2entreprises(valider("idUser","SESSION"));
    //echo json_encode($infoid2Entreprise);
    $infosEntreprises=getconnexionEntreprise(valider("idUser","SESSION"));
    //echo json_encode($infosEntreprises);

    $value="/>";
   if (!valider("modifier")) $value=  'Modifier"/>';
   else {
   $value= "Enregistrer\"/>&nbsp;&nbsp;<a class=\"btn btn-outline-secondary\" href=\"index.php?view=compteEntreprise\" type=\"button\">Annuler</a>";
   }

   $nomDestination="PPs/PP_de_".$idUser.".png";
   if (file_exists($nomDestination))
   $linkPhoto=$nomDestination;
   else $linkPhoto="PPs/default.png";

if(!valider("modifier")){
         echo '<input id="modif" name="modif" type="hidden" value="0">';

        echo "<div class=\"container\"><div class=\"main-body\"><div class=\"row gutters-sm\"><div class=\"col-md-4 mb-3\"><div class=\"card\"><div class=\"card-body\"><div class=\"d-flex flex-column align-items-center text-center\">";
        echo "<img src=\"".$linkPhoto."\" alt=\"Profil\" class=\"rounded-circle\" width=\"100\">";
        echo "<div class=\"mt-3\"><h4>".$infosEntreprise[0]["nom"]."</h4><p class=\"text-secondary mb-1\">Entreprise</p><p class=\"text-muted font-size-sm\">".$infosEntreprise[0]["adresse"]."</p>";
        echo "</div></div></div></div></div>";
        echo "<div class=\"col-md-8\"><div class=\"card mb-3\"><div class=\"card-body\"><div class=\"row\"><div class=\"col-sm-3\"><h6 class=\"mb-0\">Nom</h6></div>";
        echo "<div class=\"col-sm-9 text-secondary\">".$infosEntreprise[0]["nom"]."</div></div><hr>";
        echo "<div class=\"row\"><div class=\"col-sm-3\"><h6 class=\"mb-0\">Adresse</h6></div>";
        echo "<div class=\"col-sm-9 text-secondary\">".$infosEntreprise[0]["adresse"]."</div></div><hr>";
        echo "<div class=\"row\"><div class=\"col-sm-3\"><h6 class=\"mb-0\">Téléphone</h6></div>";
        echo "<div class=\"col-sm-9 text-secondary\">".$infosEntreprise[0]["telephone"]."</div></div><hr>";
        echo "<div class=\"row\"><div class=\"col-sm-3\"><h6 class=\"mb-0\">Email</h6></div><div class=\"col-sm-9 text-secondary\">".$infosEntreprises[0]["mail"]."</div></div><hr>";
        echo "<div class=\"row\"><div class=\"col-sm-3\"><h6 class=\"mb-0\">Mot de passe</h6></div>";
        echo "<div class=\"col-sm-9 text-secondary\">".$infosEntreprises[0]["password"]."</div></div><hr>";
        echo '<input class="btn btn-secondary" type="submit" id="Modifier" name="action" value="'.$value;
        echo "</div></div></div></div></div></div></div></div></form>";
}
else {
  echo '<div class="row g-3">';
   echo '<h4 class="mb-3">Modifier mes informations</h4>';
   echo '<div class="col-12">';
   echo '<div class="form-floating">';
   echo '<input class="form-control form-control-lg" id="floatingInput" name="nom" value="'.$infosEntreprise[0]["nom"].'">';
   echo '<label for="floatingInput">Nom</label>';
   echo '</div></div><br/>';
   echo '<div class="col-12">';
   echo '<div class="form-floating">';
   echo '<input class="form-control form-control-lg" id="floatingInput" name="adresse" value="'.$infosEntreprise[0]["adresse"].'">';
   echo '<label for="floatingInput">Adresse</label>';
   echo '</div></div><br/>';
   echo '<div class="col-12">';
   echo '<div class="form-floating">';
   echo '<input class="form-control form-control-lg" id="floatingInput" name="telephone" value="'.$infosEntreprise[0]["telephone"].'">';
   echo '<label for="floatingInput">Téléphone</label>';
   echo '</div></div><br/>';
   echo '<div class="col-12">';
   echo '<div class="form-floating">';
   echo '<input class="form-control form-control-lg" id="floatingInput" name="mail" value="'.$infosEntreprises[0]["mail"].' ">';
   echo '<label for="floatingInput">Email</label>';
   echo '</div></div><br/>';
   echo '<div class="col-12">';
   echo '<div class="form-floating">';
   echo '<input class="form-control form-control-lg" id="floatingInput" name="password" value="'.$infosEntreprises[0]["password"].'">';
   echo '<label for="floatingInput">Mot de passe</label>';
   echo '</div></div><br/>';
   echo '<input id="modif" name="modif" type="hidden" value="1">';
   echo '<input class="btn btn-secondary" type="submit" id="Modifier" name="action" value="'.$value;
   echo '</div></form>';



   //PHOTO DE PROFILE
   echo ("<h3>Changer de Photo de profile</h3>");
   echo '<form action="upload.php" method="post" enctype="multipart/form-data">';
   echo 'Selectionner votre Photo de profile en format jpeg, jpg ou png: </br><input type="file" name="fileToUpload" id="fileToUpload">';
   echo '<input name="location" type="hidden" value="compteEntreprise"></br>';
   echo '<input name="file" type="hidden" value="profile">';
   echo '<input name="idUser" type="hidden" value="'.valider("idUser","SESSION").'">';
   echo '<input type="submit" value="Changer de Photo de profil" name="submit"></form>';


   if(file_exists($nomDestination)){
      echo "<a class=\"btn btn-secondary\" href=\"".$nomDestination."\" target=\"_blank\">Voir la photo de profile</a>";

      echo '<form action="upload.php" method="GET">';
      echo '<input name="dest" type="hidden" value="'.$nomDestination.'">';
      echo '<input name="file" type="hidden" value="profile">';
      echo '<input name="action" type="hidden" value="supprimerEnt">';
      echo '<input class="btn btn-secondary" type="submit" value="Supprimer la photo de profile" name="submit">';
      echo '</form>';
   }

}
    //bouton
?>

