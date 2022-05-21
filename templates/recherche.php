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
	header("Location:../index.php?view=recherche");
	die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");
include_once("libs/maLibForms.php");

$today = date("Y-m-d");
$time=sscanf($today,"%d-%d-%d");

$def=sprintf( "%04d-%02d-%02d", $time[0]-2000, $time[1], $time[2]);
$ajourdhui=sprintf( "%04d-%02d-%02d", $time[0], $time[1], $time[2]-1);
$tjour=sprintf( "%04d-%02d-%02d", $time[0], $time[1], $time[2]-7);
$sjour=sprintf( "%04d-%02d-%02d", $time[0], $time[1]-3, $time[2]);
$mois=sprintf( "%04d-%02d-%02d", $time[0], $time[1]-1, $time[2]);
$tmois=sprintf( "%04d-%02d-%02d", $time[0], $time[1]-3, $time[2]);
$annee=sprintf( "%04d-%02d-%02d", $time[0]-1, $time[1], $time[2]);


$filtreTime=[["label"=>"Date de publication","value"=>$def],
["label"=>"Il y a moins d'un jours","value"=>$ajourdhui],
["label"=>"Il y a moins de 3 jours","value"=>$tjour],
["label"=>"Il y a moins de 7 jours","value"=>$sjour],
["label"=>"Il y a moins de 1 mois","value"=>$mois],
["label"=>"Il y a moins de 3 mois","value"=>$tmois],
["label"=>"Il y a moins d'un ans","value"=>$annee]];




?>
<form action="controleur.php" method="GET">
		<h5 class="h3 mb-3 fw-normal">Rechercher votre stage :</h5>
		<input class="form-control form-control-lg" name="Ville" id="Ville" type="text" placeholder="Ville">
		<input class="form-control form-control-lg" name="Secteur" id="Secteur" type="text" placeholder="Secteur">
		<input type="submit" id="btn_recherche" class="w-100 btn btn-lg btn-secondary" name="action" value="Rechercher"/>
	
		<label for="interet"> Durée minimal (mois):  </label>
	<input class="form-control form-control-lg" name="DuréeMin" id="DuréeMin" type="text" placeholder="durée minimal (mois)">
	<label for="interet"> Durée maximum (mois):  </label>
	<input class="form-control form-control-lg" name="DuréeMax" id="DuréeMax" type="text" placeholder="durée maximum (mois)">
	<label for="Rémunération"> Rémunération :  </label>
	<input type="checkbox" id="Remuneration" name="Remuneration" class="checkbox" /><br/>
	<?php
	$carac= getSecteurs();
	echo "<select class=\"form-control\" id=\"secteurAct\" name=\"secteurAct\">\n";
	echo "<option value=\"Tous\">Secteur d'activité</option>\n";
	foreach($carac as $type)
	{
		echo "<option value=\"".$type["idSecteur"]."\">".$type["nom"]."</option>\n";
	}
	echo "</select>\n";
	?>
	<?php
	mkSelect("FiltrePubli", $filtreTime, "value", "label");
	?>
	<?php
	$TypeAnnonce=getTypeAnnonce();
	//echo json_encode($TypeAnnonce);
	echo "<select class=\"form-control\" id=\"TypeStage\" name=\"TypeStage\">\n";
	echo "<option value=\"Tous\">Type de stage</option>\n";
	foreach($TypeAnnonce as $type)
	{
		echo "<option value=\"".$type["type"]."\">".$type["type"]."</option>\n";
	}
	echo "</select>\n";
	?>
	<input type="submit" id="btn_recherche" class="w-100 btn btn-lg btn-secondary" name="action" value="Filtrer"/>

</form>
<?php
	if($type =valider("type")){
		$Ville =valider("ville");
		$Secteur =valider("secteur");
		if ($type == 'r')
		$result=rechercheAnnonce($Ville,$Secteur);
		else if ($type == 'f'){
			$Remuneration =valider("Remuneration");
			$Activité =valider("Activité");
			$DureeMin =valider("DureeMin");
			$Publiee =valider("Publiee");
			$TypeStage =valider("TypeStage");
			$DureeMax =valider("DureeMax");
			$result=filtrerAnnonce($Ville,$Secteur,$Remuneration,$Activité,$DureeMin, $Publiee,$TypeStage,$DureeMax);
		}
	}
	else {
		$result=rechercheAnnonce();
	}
	foreach($result as $annonce)
	{
		mkAnnoncePreview($annonce["idAnnonces"],"previewAnnonce");
	}
?>