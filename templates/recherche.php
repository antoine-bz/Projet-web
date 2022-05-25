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






$Ville =valider("ville");
$Secteur =valider("secteur");
$Remuneration =valider("Remuneration");
$Activité =valider("Activité");
$DureeMin =valider("DureeMin");
$Publiee =valider("Publiee");
$TypeStage =valider("TypeStage");
$DureeMax =valider("DureeMax");

?>

<link rel="stylesheet" type="text/css" href="css/stylerech.css">
<main class="form-signin w-30 m-auto">
	<div class="formLogin">
		<form action="controleur.php" method="GET">
			<h1 class="h3 mb-3 fw-normal">Rechercher votre stage :</h1>
			<div class="form-floating">
    			<input type="text" class="form-control" name="Ville" id="floatingInput Ville" placeholder="Ville" value="<?php echo $Ville; ?>"/>
      			<label for="floatingInput">Ville</label>
  			</div>
  			<div class="form-floating">
      			<input type="text" class="form-control" name="Secteur" id="floatingPassword Secteur" placeholder="Secteur" value="<?php echo $Secteur; ?>"/>
      			<label for="floatingInput">Secteur</label>
  			</div>
			<br/>
			<input class="w-100 btn btn-lg btn-secondary" type="submit" id="btn_recherche" name="action" value="Rechercher" />

			<div class="dropdown-menu dropdown-menu-dark d-block position-static border-0 pt-0 rounded-3 shadow overflow-hidden w-280px">
				<h1 class="h3 mb-3 fw-normal">Filtrage</h1>
				<form class="p-2 mb-2 bg-dark border-bottom border-dark">
    				<input type="search" class="form-control form-control-dark" name="DuréeMin" id="DuréeMin" autocomplete="false" placeholder="Durée minimale (mois)" value="<?php echo $DureeMin; ?>">
      				<input type="search" class="form-control form-control-dark" name="DuréeMax" id="DuréeMax" autocomplete="false" placeholder="Durée maximale (mois)" value="<?php echo $DureeMax; ?>">
    			</form>
				<div class="form-check">
  					<input class="form-check-input checkbox" type="checkbox" name="Remuneration" id="flexCheckDefault Remunération" <?php if($Remuneration) echo "checked"; ?>/>
  					<label class="form-check-label" for="flexCheckDefault">
    				Rémunération
  					</label>
  				</div>
    			<ul class="list-unstyled mb-0">
    				<?php
						$carac= getSecteurs();
						echo "<select class=\"form-select form-select-sm\" id=\"secteurAct\" name=\"secteurAct\">\n";
						echo "<option value=\"Tous\">Secteur d'activité</option>\n";
						foreach($carac as $type)
						{
							echo "<option value=\"".$type["idSecteur"]."\"";
							if($type["idSecteur"]==$Activité)echo " selected";
							echo ">".$type["nom"]."</option>\n";
						}
						echo "</select>\n";
					?>
					<?php
						mkSelect("FiltrePubli", $filtreTime, "value", "label");
					?>
					<?php
						$TypeAnnonce=getTypeAnnonce();
						//echo json_encode($TypeAnnonce);
						echo "<select class=\"form-select form-select-sm\" id=\"TypeStage\" name=\"TypeStage\">\n";
						echo "<option value=\"Tous\">Type de stage</option>\n";
						foreach($TypeAnnonce as $type)
						{	
							echo "<option value=\"".$type["type"]."\"";
							if ($type["type"]==$TypeStage) echo " selected";
							echo ">".$type["type"]."</option>\n";
						}
						echo "</select>\n";
					?>
					<input type="submit" id="btn_recherche" class="btn btn-primary filtre" name="action" value="Filtrer"/>
    			</ul>
    		</div>
		</form>
</main>
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