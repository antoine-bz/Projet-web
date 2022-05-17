<?php
session_start();

	include_once "libs/maLibUtils.php";	
	include_once "libs/modele.php"; 
	include_once "libs/maLibSecurisation.php"; 
	// cf. injection de dépendances 


	$qs = "";

	if ($action = valider("action"))
	{
		ob_start ();
		echo "Action = '$action' <br />";
		// ATTENTION : le codage des caractères peut poser PB si on utilise des actions comportant des accents... 
		// A EVITER si on ne maitrise pas ce type de problématiques

		/* TODO: A REVOIR !!
		// Dans tous les cas, il faut etre logue... 
		// Sauf si on veut se connecter (action == Connexion)

		if ($action != "Connexion") 
			securiser("login");
		*/

		// Un paramètre action a été soumis, on fait le boulot...
		switch($action)
		{
			
			
			// Connexion //////////////////////////////////////////////////
			case 'Connexion' :
				// On verifie la presence des champs login et passe
				if ($login = valider("login"))
				if ($passe = valider("passe"))
				{
					// On verifie l'utilisateur, 
					// et on crée des variables de session si tout est OK
					// Cf. maLibSecurisation
					if (verifUser($login,$passe)) {
						// tout s'est bien passé, doit-on se souvenir de la personne ? 
						if (valider("remember")) {
							setcookie("login",$login , time()+60*60*24*30);
							setcookie("passe",$password, time()+60*60*24*30);
							setcookie("remember",true, time()+60*60*24*30);
						} else {
							setcookie("login","", time()-3600);
							setcookie("passe","", time()-3600);
							setcookie("remember",false, time()-3600);
						}
					}
				}

				// On redirigera vers la page index automatiquement
			break;

			case 'Logout' :
			case 'logout' :
				// traitement métier
				session_destroy(); // 1) traitement 
				// 2) choisir la vue suivante 
				$qs = "?view=login";
			break;

			case 'Autoriser' : 
			break;

			case 'Interdire' :  
			break; 
			
			
			case 'Activer' :
			if ($idConv = valider("idConv"))  
			if (valider("connecte","SESSION"))
			if (valider("isAdmin","SESSION"))
			{
				reactiverConversation($idConv);
			}
			// On veut envoyer l'identifiant de la conversation manipulée à la vue 
			// pour que cette conversation soit automatiquement sélectionnée 
			// dans le menu déroulant
			// Sol 1 : on renvoie l'id sous forme de QS dans l'URL de redirection
			// Sol 2 : on pourrait sauvegarder l'identifiant 
			// dans une variable de session créée dans le controleur 
			// et relue dans la vue conversation
			// Ce n'est pas une bonne pratique : on sauvegarde dans les variables 
			// de session des données pérennes 
			$qs = "?view=conversations&idConv=$idConv";
			break; 
			
			case 'Archiver' :
			if ($idConv = valider("idConv"))  
			if (valider("connecte","SESSION"))
			if (valider("isAdmin","SESSION")){
				archiverConversation($idConv);
			}  
			$qs = "?view=conversations&idConv=$idConv";
			break; 
			
			case 'Supprimer Conversation' : 
			if ($idConv = valider("idConv"))  
			if (valider("connecte","SESSION"))
			if (valider("isAdmin","SESSION")){
				supprimerConversation($idConv) ;
			}
			$qs = "?view=conversations";
			break; 
			
			case 'Ajouter Conversation' :  
			$idConv = false;
			if ($theme = valider("theme"))  
			if (valider("connecte","SESSION"))
			if (valider("isAdmin","SESSION")){
					$idConv = creerConversation($theme) ;
			}
			$qs = "?view=conversations&idConv=$idConv";
			break; 
			
			case 'Poster' : 		
			
			// Données reçues : contenu=... & idConv...
			// Un message ne peut être posté que par un utilisateur NON blacklisté 
			// ET dans une conversation active 	 
			if ($idConv = valider("idConv")) 
			if ($contenu = valider("contenu"))
			if (valider("connecte","SESSION"))
			if (! valider("isBlacklisted","SESSION")) {
				$dataConv = getConversation($idConv);
				if (count($dataConv) > 0)
				if ($dataConv["active"]) {
					enregistrerMessage($idConv, valider("idUser","SESSION"), $contenu);
				}
			}
			$qs = "?view=chat&idConv=$idConv";
			break;


		}

	}

	// On redirige toujours vers la page index, mais on ne connait pas le répertoire de base
	// On l'extrait donc du chemin du script courant : $_SERVER["PHP_SELF"]
	// Par exemple, si $_SERVER["PHP_SELF"] vaut /chat/data.php, dirname($_SERVER["PHP_SELF"]) contient /chat

	$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
	// On redirige vers la page index avec les bons arguments

	header("Location:" . $urlBase . $qs);

	// On écrit seulement après cette entête
	ob_end_flush();
	
?>










