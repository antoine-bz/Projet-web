<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php");
	die("");
}

?>

<?php
//TODO:  Si l'utilisateur est connecte, on affiche un lien de deconnexion 
// tprint($_SESSION);

if (valider("connecte","SESSION")) {
	echo "User " . $_SESSION["pseudo"] ; 
	if ($_SESSION["isAdmin"]) echo " (admin) "; 
	echo " connecte depuis "
			. $_SESSION["heureConnexion"] . " "; 
	echo '<a href="controleur.php?action=logout">Me déconnecter</a>'; 
}
?>

<br>
<div class="container">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <p class="col-md-4 mb-0 text-muted">&copy; 2022 Company, Inc</p>

    <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
    </a>

    <ul class="nav col-md-4 justify-content-end">
      <li class="nav-item"><a href="index.php?view=accueil" class="nav-link px-2 text-muted">Accueil</a></li>
      <li class="nav-item"><a href="index.php?view=depot" class="nav-link px-2 text-muted">Dépôt de CV</a></li>
      <li class="nav-item"><a href="index.php?view=info" class="nav-link px-2 text-muted">Qui sommes-nous ?</a></li>
      <li class="nav-item"><a href="index.php?view=entreprise" class="nav-link px-2 text-muted">Entreprise</a></li>
    </ul>
  </footer>
</div>

</body>
</html>



