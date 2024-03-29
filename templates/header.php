<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php");
	die("");
}

include_once "libs/modele.php";
include_once "libs/maLib2indeed.php";

// Pose qq soucis avec certains serveurs...
echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- **** H E A D **** -->
<head>	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="icon" href="ressources/logonglet.png" />
	<title>2i'ndeed</title>
  <script src=https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js></script>
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/stylehead.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>


</head>
<!-- **** F I N **** H E A D **** -->


<!-- **** B O D Y **** -->
<body>
  <header class="p-1 bg-primary text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>
         <a class="logo" href="index.php?view=accueil"><img src="ressources/logoweb.png" alt="Logo"></a>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <?php
          if (valider("connecte","SESSION")) {
              $idUser=valider("idUser","SESSION");
              if(isEtudiant($idUser)){
                echo "<li><a href=\"index.php?view=recherche\" class=\"nav-link px-1 text-white\">Rechercher</a></li>";
                echo "<li><a href=\"index.php?view=depot\" class=\"nav-link px-1 text-white\">Dépôt de CV</a></li>";
                echo "<li><a href=\"index.php?view=compteEtudiant\" class=\"nav-link px-2 text-white\">Mon compte</a></li>";
              }
              if(isEntreprise($idUser)){
                echo "<li><a href=\"index.php?view=myannonces\" class=\"nav-link px-1 text-white\">Mes annonces</a></li>";
                echo "<li><a href=\"index.php?view=publication\" class=\"nav-link px-1 text-white\">Publier</a></li>";
                echo "<li><a href=\"index.php?view=compteEntreprise\" class=\"nav-link px-2 text-white\">Mon compte</a></li>";
              }
          } 
          else{
            echo "<li><a href=\"index.php?view=recherche\" class=\"nav-link px-1 text-white\">Rechercher</a></li>";
            echo "<li><a href=\"index.php?view=depot\" class=\"nav-link px-1 text-white\">Dépôt de CV</a></li>";
            echo "<li><a href=\"index.php?view=info\" class=\"nav-link px-2 text-white\">Qui sommes-nous ?</a></li>";
            echo "<li><a href=\"index.php?view=entreprise\" class=\"nav-link px-2 text-white\">Entreprise</a></li>";

          }
          ?>
        </ul>
        <div class="collapse navbar-collapse">
      </div>
        <div class="text-end">
          <?php
            if ( ! valider("connecte","SESSION")) {
               echo '<button type="button" class="btn btn-outline-light me-2" onclick="window.location=\'index.php?view=connexion\';">Connexion</button>';
              echo '<button type="button" class="btn btn-secondary" onclick="window.location=\'index.php?view=inscription\';">Inscription</button>';
            } else {
              echo '<button type="button" class="btn btn-outline-light me-2" onclick="window.location=\'controleur.php?action=logout\';">Déconnexion</button>';
 }
?>
        </div>
      </div>
    </div>
  </header>
</div>




