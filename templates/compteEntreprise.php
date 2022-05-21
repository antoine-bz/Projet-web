
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

<u><h3>Informations de l'entreprise</h3></u>
<form action="controleur.php" method="GET">
<?php 
    $infoidEntreprise=getIdentreprises(valider("idUser","SESSION"));
    //echo json_encode($infoidEntreprise);
    $infosEntreprise=getEntreprise($infoidEntreprise);
    
    //$infoid2Entreprise=getId2entreprises(valider("idUser","SESSION"));
    //echo json_encode($infoid2Entreprise);
    $infosEntreprises=getconnexionEntreprise(valider("idUser","SESSION"));
    //echo json_encode($infosEntreprises);

if(!valider("modifier")){
    //echo json_encode($infosEntreprise); 
         echo "<br>".$infosEntreprise[0]["nom"];
         echo "<br>".$infosEntreprise[0]["adresse"];
         echo "<br>".$infosEntreprise[0]["telephone"];
    //echo json_encode($infosEntreprises); 
         echo "<br>".$infosEntreprises[0]["mail"];
         echo "<br>".$infosEntreprises[0]["password"];
         echo '<input id="modif" name="modif" type="hidden" value="0">';
}
else {
    echo '<input class="form-control form-control-lg" name="nom" value="'.$infosEntreprise[0]["nom"].'">';
    echo '<input class="form-control form-control-lg" name="adresse" value="'.$infosEntreprise[0]["adresse"].'">';
    echo '<input class="form-control form-control-lg" name="telephone" value="'.$infosEntreprise[0]["telephone"].'">';
    echo '<input class="form-control form-control-lg" name="mail" value="'.$infosEntreprises[0]["mail"].' ">';
    echo '<input class="form-control form-control-lg" name="password" value="'.$infosEntreprises[0]["password"].'">';
    echo '<input id="modif" name="modif" type="hidden" value="1">';

}
    //bouton
?>

    <input class="w-100 btn btn-lg btn-secondary" type="submit" id="Modifier" name="action" value="<?php 
        if (!valider("modifier")) echo 'Modifier"/>';
        else {
            echo 'Enregistrer"/>';
            echo "<a class=\"btn btn-outline-secondary\" href=\"index.php?view=compteEntreprise\" type=\"button\">Annuler</a>";
        }
    ?>
</form>
