<?php
// Ce fichier permet de tester les fonctions développées dans le fichier bdd.php (première partie)

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) == "users.php")
{
	header("Location:../index.php?view=users");
	die("");
}


include_once("libs/modele.php");
include_once("libs/maLibUtils.php"); 
include_once("libs/maLibForms.php"); 




//////////  TODO    /////////////
//voici des idées pour faire la partie admin
// 1. Afficher les utilisateurs
// 2. Afficher les entreprises
// 3. Gerer les droits d'acces
// 4. Afficher les annonces
// 5. Gerer les annonces




// j'ai copié le code du TNE










// Interface de gestion des utilisateurs 
// Cette interface ne doit pas etre offerte aux utilisateurs non connectés

if (!valider("connecte","SESSION")) {
	//header("Location:?view=login&msg=" . urlencode("Il faut vous connecter !!")); 
	// déclenche une erreur headers already sent 
	// car les entetes HTTP de réponse ont déjà envoyées
	// car la page header envoie un résultat HTML au client 
	// ET que le serveur ne bufferise pas 
	
	// On choisit de charger la vue de login 
	$_REQUEST["msg"] = "Il faut vous connecter !!"; 
	include("templates/login.php");
} else {

// la partie administration ne doit pas etre offerte aux utilisateurs connectés qui ne sont pas administrateurs



// Côté serveur, les opérations d'administration ne doivent pas etre déclenchées si l'utilisateur n'est pas administrateur 


/* 
?>

<div class="page-header">
      <h1>Administration du site</h1>
    </div>

    <p class="lead"> 

			<h2>Liste des utilisateurs de la base </h2>
			<?php
			echo "liste des utilisateurs autorises de la base :"; 
			$users = listerUtilisateurs("nbl");
			// tprint($users);	// préférer un appel à 
			mkTable($users,array("id","pseudo","admin","couleur"));

			echo "<hr />";
			echo "liste des utilisateurs non autorises de la base :"; 
			$users = listerUtilisateurs("bl");
			//tprint($users);	// préférer un appel à mkTable($users);
			mkTable($users,array("id","pseudo","admin","couleur"));
			?>
			<hr />
			
<?php
*/



// la partie administration ne doit pas etre offerte aux utilisateurs connectés qui ne sont pas administrateurs
		
//if (valider("isAdmin","SESSION")) {
if (isAdmin($_SESSION["idUser"])) {
?>			
			<h2>Gestion des utilisateurs</h2>
			
			
<?php
			mkForm("controleur.php");
			mkInput("hidden","entite","users");
			
			$users = listerUtilisateurs(); // produits par parcoursRs(recordset mysql)
			$lastIdUser = valider("lastIdUser");
			mkSelect("idUser",$users,"id","pseudo",$lastIdUser,"blacklist");
			mkInput("submit","action","Interdire");
			mkInput("submit","action","Autoriser");
			mkInput("submit","action","Supprimer");
			mkInput("submit","action","Retrograder");
			mkInput("submit","action","Promouvoir");


			mkInput("color","color","");
			mkInput("submit","action","Changer Couleur");
			
			endForm(); 	
			
			mkForm("controleur.php");	
			mkInput("text","pseudo","");
			mkInput("password","passe","");
			mkInput("submit","action","Creer Utilisateur");
			endForm();	
?>


<?php
}	// fin si user est admin 
?>

</p>

<?php
} // Fin si user non connecté
?>



