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
	header("Location:../index.php?view=publication");
	die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");
include_once("libs/maLibForms.php");
$msg = valider("msg"); 
if ($msg) {
   echo "<div class=\"modal\" id=\"myModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalCenterTitle\" aria-hidden=\"true\">";
       echo "<div class=\"modal-dialog modal-dialog-centered\" role=\"document\">";
   echo "<div class=\"modal-content\">";
   echo "<div class=\"modal-header\">";
   echo "<h5 class=\"modal-title\" id=\"exampleModalCenterTitle\">Publication</h5>";
   echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">";
   echo "<span aria-hidden=\"true\">&times;</span>";
   echo "</button></div>";
   echo "<div class=\"modal-body\">" . $msg . "</div>";
   echo "<div class=\"modal-footer\">";
   echo "<button type=\"button\" class=\"btn btn-secondary\" class=\"close\" data-dismiss=\"modal\">Fermer</button></div></div></div></div>";
   echo "<script type=\"text/javascript\">$(document).ready(function(){";
   echo "$('#myModal').modal('show');});</script>";
}
?>
<link rel="stylesheet" type="text/css" href="css/styleComptepub.css">
<br/>
<form class="pubform" action="controleur.php" method="GET">
   <h1 class="h3 mb-3 fw-normal">Publier une nouvelle annonce</h1>
<div class="form-floating">
   <input type="text" class="form-control" name="nom" id="floatingInput" placeholder="Nom de l'annonce">
   <label for="floatingInput">Nom de l'annonce</label>
</div>
<br>
<div class="form-floating">
   <input type="text" class="form-control" name="duree" id="floatingInput" placeholder="Durée">
   <label for="floatingInput">Durée</label>
</div>
<br>
<div class="form-check form-switch">
   <input class="form-check-input checkbox" type="checkbox" name="remuneration" id="flexCheckDefault remuneration">
   <label class="form-check-label" for="remuneration">
   Rémunération
   </label>
</div>
<br>
<div class="form-floating">
   <input type="text" class="form-control" name="type" id="floatingInput" placeholder="Type">
   <label for="floatingInput">Type</label>
</div>
<br>
<textarea class="form-control" type="textarea" placeholder="Description de votre annonce" maxlength="255" name="description"></textarea>
<br>
<input type="hidden"  name="action"  value="publierannonce">
<input type="hidden" name="date" value="<?php echo date("Y-m-d"); ?>">
<input class="w-45 btn btn-lg btn-secondary" type="submit" id="publier" value="Publier" />
</form>