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
/*
if (valider("connecte","SESSION")) {
	echo "User " . $_SESSION["pseudo"] ; 
	if ($_SESSION["isAdmin"]) echo " (admin) "; 
	echo " connecte depuis "
			. $_SESSION["heureConnexion"] . " "; 
	echo '<a href="controleur.php?action=logout">Me déconnecter</a>'; 
}*/
?>
<link rel="stylesheet" type="text/css" href="css/stylefooter.css">

</body>
</html>



