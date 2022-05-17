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
				$qs = "?view=login&msg=" . urlencode("Login ou mot de passe manquant");
				if ($login = valider("login"))
				if ($passe = valider("passe"))
				{
					// On verifie l'utilisateur, 
					// et on crée des variables de session si tout est OK
					// Cf. maLibSecurisation
					if (verifUser($login,$passe)) {
						// tout s'est bien passé, doit-on se souvenir de la personne ? 
						if (valider("remember")) {
							setcookie("login",$login , time()-3600);
							setcookie("passe",$password, time()-3600);
							setcookie("remember",true, time()-3600);
						} else {
							setcookie("login","", time()-3600);
							setcookie("passe","", time()-3600);
							setcookie("remember",false, time()-3600);
						}
						$qs = "?view=accueil";
					}
					else $qs = "?view=login&msg=" . urlencode("Identifiants incorrects");
		
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

			case "Inscription" :
				
				if ($mail = valider("mail"))
				if ($password = valider("password")){
					$qs = "?view=inscription"; 
					switch (valider("main-categories")) {
						case '1':
							if ($nomEtudiant = valider("nomEtudiant"))
							if ($prenomEtudiant = valider("prenomEtudiant"))
							{
								$idEtudiants=creerEtudiant($prenomEtudiant,$nomEtudiant);
								$idEtud=intval($idEtudiants);
								creerConnexionEtudiant($idEtud,$password,$mail);
								$qs = "?view=inscription&msg=" . urlencode("Création réussie, connectez-vous"); 
							}
							else//Si les informations sont incorrectes
							$qs = "?view=inscription&msg=" . urlencode("Identifiants incorrects");
							break;
						case '2':
							if ($nomEntreprise = valider("nomEntreprise"))
							if ($secteurAct = valider("secteurAct"))	
							{
								$idEntreprises =creerEntreprise($nomEntreprise,$secteurAct);
								$idEnt=intval($idEntreprises);
								creerConnexionEntreprise($idEnt,$password,$mail);
								$qs = "?view=inscription&msg=" . urlencode("Création réussie, connectez-vous"); 
							}
							else //Si les informations sont incorrectes
							$qs = "?view=inscription&msg=" . urlencode("Identifiants incorrects");
							break;
						default:
							$qs = "?view=inscription&msg=" . urlencode("Identifiants incorrects case");
							break;
					}
				}

				// traitement métier
				// redirection vers la vue suivante
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










