<?php
//session_start();

if (basename($_SERVER["PHP_SELF"]) != "upload.php")
{
	header("Location:../index.php?view=depot");
	die("");
}

include_once("libs/modele.php");

include_once("libs/maLibUtils.php");
include_once("libs/maLibForms.php");


if (!valider("connecte","SESSION")){
	$idUser=valider("idUser","POST");
	$idEtudiant= getIdEtudiant($idUser);
	$nomDestinationCV = "CV_de_".$idEtudiant.".pdf";
	
	$nomDestinationProfile = "PP_de_".$idUser.".png";
	$extensionsAutorisees = array("jpeg", "jpg", "png");

	if(isset($_GET["submit"])) {
		$file=valider('file');
		switch ($file) {
			case 'CV':
				$action=valider('action');
				$qs = "?view=depot";
				switch($action)
				{
					case "supprimer" :
						$dest = valider("dest");
						unlink($dest);
						$qs = "?view=depot&msg=".urlencode("Le CV a été supprimer avec succès");
						break;
				}
				break;
			case 'profile':
				echo "switch";
				$action=valider('action');
				$qs = "?view=accueil";
				
				switch($action)
				{
					
					case "supprimerEtu" :
						$dest = valider("dest");
						echo $dest;
						unlink($dest);
						$qs = "?view=compteEtudiant&msg=".urlencode("La photo de profile a été supprimer avec succès");
						break;
					case "supprimerEnt" :
						$dest = valider("dest");
						unlink($dest);
						$qs = "?view=compteEntreprise&msg=".urlencode("La photo de profile a été supprimer avec succès");
						break;
				}
				break;
				break;
		}
		
		$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
		header("Location:" . $urlBase . $qs);
		die("");
	}


	if(isset($_POST["submit"])) {

		if ($_FILES["fileToUpload"]["size"] > 5000000) {
			header("Location:".dirname($_SERVER["PHP_SELF"]) ."/index.php?view=depot&msg=".urlencode("Fichier trop gros"));
			die("");
		}
		$file=valider('file','POST');
		
		echo $file;
		switch ($file) {
			case 'CV':
				
				
				if (pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION)!='pdf'){
					header("Location:".dirname($_SERVER["PHP_SELF"]) ."/index.php?view=depot&msg=".urlencode("Mauvais format"));
					die("");
				}
				if (!file_exists($nomDestinationCV)){
					move_uploaded_file($_FILES['fileToUpload']['tmp_name'], 'CVs/'.$nomDestinationCV);
				}
				else{
					unlink('CVs/'.$nomDestinationCV);

					move_uploaded_file($_FILES['fileToUpload']['tmp_name'], 'CVs/'.$nomDestinationCV);
				}
			break;


			case 'profile':
				if (!(in_array(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION), $extensionsAutorisees))){
					header("Location:".dirname($_SERVER["PHP_SELF"]) ."/index.php?view=".$redirect."&msg=".urlencode("Mauvais format"));
					die("");
				}
				if (!file_exists($nomDestinationProfile)){
					move_uploaded_file($_FILES['fileToUpload']['tmp_name'], 'PPs/'.$nomDestinationProfile);
				}
				else{
					unlink('PPs/'.$nomDestinationProfile);

					move_uploaded_file($_FILES['fileToUpload']['tmp_name'], 'PPs/'.$nomDestinationProfile);
					
				}
				break;
				
		
			}
			$redirect=valider("location","POST");
			$qs='?view='.$redirect.'&msg='.urlencode("Le fichier a été téléchargé avec succès");
			$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
			header("Location:" . $urlBase . $qs);
			die("");
	}
}
else{
	header("Location:".dirname($_SERVER["PHP_SELF"]) ."/index.php?view=inscription&msg=".urlencode("Connectez-vous !!"));
	die("");
}

?>
<br><br><br>upload

<?php
//ob_end_flush();
?>