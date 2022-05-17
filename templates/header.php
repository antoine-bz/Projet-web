<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php");
	die("");
}

// Pose qq soucis avec certains serveurs...
echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- **** H E A D **** -->
<head>	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>2i'ndeed</title>
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrapp.css">
	<link rel="stylesheet" type="text/css" href="css/styleheader.css">
  <script type="text/javascript" src="js/script.js">
	</script>
</head>
<!-- **** F I N **** H E A D **** -->


<!-- **** B O D Y **** -->
<body>
  <header class="p-3 bg-primary text-white">
  <a class="logo" href="index.php?view=accueil"><img src="ressources/logoweb.png" alt="Logo"></a>
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php?view=recherche" class="nav-link px-2 text-white">Rechercher</a></li>
          <li><a href="index.php?view=depot" class="nav-link px-2 text-white">Dépôt de CV</a></li>
          <li><a href="index.php?view=info" class="nav-link px-2 text-white">Qui sommes-nous ?</a></li>
          <li><a href="index.php?view=entreprise" class="nav-link px-2 text-white">Entreprise</a></li>
        </ul>
        <div class="collapse navbar-collapse">
      </div>
        <div class="text-end">
          <button type="button" class="btn btn-outline-light me-2" onclick="window.location='index.php?view=connexion';">Connexion</button>
          <button type="button" class="btn btn-secondary" onclick="window.location='index.php?view=inscription';">Inscription</button>
        </div>
      </div>
    </div>
  </header>

<?php
//TODO: Si l'utilisateur n'est pas connecte, on affiche un lien de connexion 
// if ( ! valider("connecte","SESSION")) {
// 	echo '<a href="index.php?view=connexion">Connexion</a>';
// } else {
// 	// INSUFFISANT POUR EMPECHER L'ACCES A LA PAGE DES CONVERSATIONS !!
// 	// NEVER TRUST USER INPUT 
// 	echo '<a href="index.php?view=conversations">Conversations</a>';
// }
?>
</div>






