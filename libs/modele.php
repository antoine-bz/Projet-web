<?php

/*
Dans ce fichier, on définit diverses fonctions permettant de récupérer des données utiles pour notre TP d'identification. Deux parties sont à compléter, en suivant les indications données dans le support de TP
*/


/********* PARTIE 1 : prise en main de la base de données *********/


// inclure ici la librairie faciliant les requêtes SQL
include("maLibSQL.pdo.php");


function listerUtilisateurs($classe = "both")
{
	// Cette fonction liste les utilisateurs de la base de données 
	// et renvoie un tableau d'enregistrements. 
	// Chaque enregistrement est un tableau associatif contenant les champs 
	// id,pseudo,blacklist,connecte,couleur

	// Lorsque la variable $classe vaut "both", elle renvoie tous les utilisateurs
	// Lorsqu'elle vaut "bl", elle ne renvoie que les utilisateurs blacklistés
	// Lorsqu'elle vaut "nbl", elle ne renvoie que les utilisateurs non blacklistés

}

function verifUserBdd($login,$passe)
{
	// Vérifie l'identité d'un utilisateur 
	// dont les identifiants sont passes en paramètre
	// renvoie faux si user inconnu
	// renvoie l'id de l'utilisateur si succès

	$SQL="SELECT idConnexion FROM connexion WHERE mail='$login' AND password='$passe'";

	return SQLGetChamp($SQL);
	// si on avait besoin de plus d'un champ
	// on aurait du utiliser SQLSelect
}


function isAdmin($idUser)
{
	// vérifie si l'utilisateur est un administrateur
	$SQL ="SELECT admin FROM connexion WHERE idConnexion='$idUser'";
	return SQLGetChamp($SQL); 
}




function getIduser($password,$mail)
{
	$SQL ="SELECT idConnexion FROM connexion WHERE password='$password' AND mail='$mail'";
	if(SQLGetChamp($SQL)==NULL) return 0;
	else return 1; 
}

function isEntreprise($idUser)
{
	// vérifie si l'utilisateur est un entreprise
	$SQL ="SELECT idEntreprises FROM connexion WHERE idConnexion='$idUser'";
	if(SQLGetChamp($SQL)==NULL) return 0;
	else return 1; 
}

function isEtudiant($idUser)
{
	// vérifie si l'utilisateur est un etudiant
	$SQL ="SELECT idEtudiants FROM connexion WHERE idConnexion='$idUser'";
	return SQLGetChamp($SQL);
}


###########CREER COMPTE############

function creerEntreprise($nom,$idsecteur,$adresse = NULL,$telephone = NULL)
{
	// Cette fonction crée une nouvelle entreprise et renvoie l'identifiant de l'entreprise créée
	$SQL ="INSERT INTO entreprises (nom,idSecteur,adresse,telephone) VALUES ('$nom',$idsecteur,'$adresse','$telephone')";
	return SQLInsert($SQL);
}

function creerEtudiant($prenom,$nom)
{
	// Cette fonction crée un nouvel étudiant et renvoie l'identifiant de l'étudiant créé
	$SQL ="INSERT INTO etudiants (idEtudiants,prenom,nom,adresse,telephone,age,CV) VALUES (NULL,'$prenom','$nom',NULL,NULL,NULL,NULL)";
	return SQLInsert($SQL);
}


function creerConnexionEtudiant($idEtudiants,$password,$mail)
{
	// Cette fonction crée une nouvelle connexion et renvoie l'identifiant de la connexion créée
	$SQL ="INSERT INTO connexion(idConnexion,idEtudiants,idEntreprises,password,mail,admin) VALUES (NULL,$idEtudiants,NULL,'$password','$mail',0)";
	return SQLInsert($SQL);
}
function creerConnexionEntreprise($idEntreprises,$password,$mail)
{
	// Cette fonction crée une nouvelle connexion et renvoie l'identifiant de la connexion créée
	$SQL ="INSERT INTO connexion(idConnexion,idEtudiants,idEntreprises,password,mail,admin) VALUES (NULL,NULL,$idEntreprises,'$password','$mail',0)";
	return SQLInsert($SQL);
}



###########GET############


function getconnexionEntreprise($idEntreprises){ //renvoie les infos de connexion de l'entreprise
	$SQL ="SELECT mail,password FROM connexion WHERE idConnexion='".$idEntreprises."'";
	return parcoursRs(SQLSelect($SQL));
}

function getIdentreprises($idUser){
	$SQL = "SELECT idEntreprises FROM connexion WHERE idConnexion='".$idUser."'";
	return SQLGetChamp($SQL);
}
function getIdEtudiant($idUser){
	$SQL = "SELECT IdEtudiants FROM connexion WHERE idConnexion='".$idUser."'";
	return SQLGetChamp($SQL);
}


###########UPDATE############
function UpdateEntreprise($idEntreprises,$nom,$adresse,$telephone){
	$SQL = "UPDATE `entreprises` SET `nom` = '".$nom."', `adresse` = '".$adresse."', `telephone` = '".$telephone."' WHERE `entreprises`.`idEntreprises` = '".$idEntreprises."'";
	SQLUpdate($SQL);

}
function UpdateConnexion($idConnexion,$mail,$password){
	$SQL = "UPDATE `connexion` SET `mail` = '".$mail."', `password` = '".$password."' WHERE `connexion`.`idConnexion` = '".$idConnexion."'";
	SQLUpdate($SQL);

}


###########Entreprise############
function getIdEntreprise($idAnnonce){ //renvoie l'id de l'entreprise qui a créé l'annonce
	$SQL ="SELECT idEntreprises FROM annonces WHERE idAnnonces='$idAnnonce'";
	return SQLGetChamp($SQL);
}


function getEntreprise($idEntreprises){ //renvoie les infos de l'entreprise
	$SQL ="SELECT * FROM entreprises WHERE idEntreprises='".$idEntreprises."'";
	return parcoursRs(SQLSelect($SQL));
}


###########Annonce############
function getAnnonce($idAnnonce){
	$SQL ="SELECT * FROM annonces WHERE idAnnonces='$idAnnonce'";
	return parcoursRs(SQLSelect($SQL)); 
}

function getLastAnnonce(){
	$SQL ="SELECT idAnnonces FROM annonces ORDER BY date DESC LIMIT 4";
	return parcoursRs(SQLSelect($SQL)); 
}

function getTypeAnnonce(){ 
	$SQL ="SELECT DISTINCT type FROM annonces";
	return parcoursRs(SQLSelect($SQL)); 
}
function getInterets(){ 
	$SQL ="SELECT DISTINCT type FROM annonces";
	return parcoursRs(SQLSelect($SQL)); 
}
###########Secteurs############
function getSecteurs()
{
	$SQL ="SELECT idSecteur,nom FROM secteur";
	return parcoursRs(SQLSelect($SQL)); 
}
###########Recherche############

function rechercheAnnonce($Ville=NULL,$Secteur=NULL){
	$SQL ="SELECT annonces.* FROM annonces";
	if($Ville || $Secteur)$SQL = $SQL ." JOIN entreprises ON annonces.idEntreprises=entreprises.idEntreprises JOIN secteur ON secteur.idSecteur=entreprises.idSecteur";
	if($Ville && !$Secteur)  $SQL = $SQL . " WHERE entreprises.adresse LIKE '%$Ville%'";
	if(!$Ville && $Secteur)  $SQL = $SQL ." WHERE annonces.nom LIKE '%$Secteur%' OR annonces.description LIKE '%$Secteur%' OR secteur.nom LIKE '%$Secteur%' OR secteur.interet1 LIKE '%$Secteur%' OR secteur.interet2 LIKE '%$Secteur%'" ;
	if($Ville && $Secteur)  $SQL = $SQL ." WHERE (annonces.nom LIKE '%$Secteur%' OR annonces.description LIKE '%$Secteur%' OR secteur.nom LIKE '%$Secteur%' OR secteur.interet1 LIKE '%$Secteur%' OR secteur.interet2 LIKE '%$Secteur%') AND entreprises.adresse LIKE '%$Ville%'" ;
    //echo $SQL;
	return parcoursRs(SQLSelect($SQL)); 
}

function filtrerAnnonce($Ville=NULL,$Secteur=NULL,$Remuneration=NULL,$Activité=NULL,$Dureemin=NULL, $Publiee=NULL,$Type=NULL,$Dureemax=NULL){
	$SQL ="SELECT annonces.* FROM annonces";
	if($Ville || $Secteur){
		$SQL = $SQL ." JOIN entreprises ON annonces.idEntreprises=entreprises.idEntreprises JOIN secteur ON secteur.idSecteur=entreprises.idSecteur";
		if($Ville && !$Secteur)  $SQL = $SQL . " WHERE entreprises.adresse LIKE '%$Ville%'";
		if(!$Ville && $Secteur)  $SQL = $SQL ." WHERE annonces.nom LIKE '%$Secteur%' OR annonces.description LIKE '%$Secteur%' OR secteur.nom LIKE '%$Secteur%' OR secteur.interet1 LIKE '%$Secteur%' OR secteur.interet2 LIKE '%$Secteur%'" ;
		if($Ville && $Secteur)  $SQL = $SQL ." WHERE (annonces.nom LIKE '%$Secteur%' OR annonces.description LIKE '%$Secteur%' OR secteur.nom LIKE '%$Secteur%' OR secteur.interet1 LIKE '%$Secteur%' OR secteur.interet2 LIKE '%$Secteur%') AND entreprises.adresse LIKE '%$Ville%'" ;
		$SQL = $SQL ." AND annonces.date>'$Publiee' AND annonces.duree > '$Dureemin'"; 
		if ($Remuneration) $SQL = $SQL . " AND annonces.remuneration='1'";
		if ($Type!="Tous") $SQL = $SQL . " AND annonces.type LIKE '$Type'";
		if ($Activité!="Tous") $SQL = $SQL . " AND entreprises.idSecteur='$Activité'";
		if ($Dureemax!="Tous") $SQL = $SQL . " AND annonces.duree < '$Dureemax'";
	}
	else {
		$SQL = $SQL ." JOIN entreprises ON annonces.idEntreprises=entreprises.idEntreprises JOIN secteur ON secteur.idSecteur=entreprises.idSecteur";
		$SQL = $SQL ." WHERE annonces.date>'$Publiee' AND annonces.duree > '$Dureemin'"; 
		if ($Remuneration) $SQL = $SQL . " AND annonces.remuneration='1'";
		if ($Type!="Tous") $SQL = $SQL . " AND annonces.type='$Type'";
		if ($Activité!="Tous") $SQL = $SQL . " AND entreprises.idSecteur='$Activité'";
		if ($Dureemax) $SQL = $SQL . " AND annonces.duree < '$Dureemax'";
	}
	//echo $SQL;
	return parcoursRs(SQLSelect($SQL));  
}



function getReponseEtudiant($idEtudiant){ 
    $SQL ="SELECT * FROM reponses WHERE reponses.idEtudiants='$idEtudiant'";
    return parcoursRs(SQLSelect($SQL));
}
?>














