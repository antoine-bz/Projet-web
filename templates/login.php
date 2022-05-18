<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=login");
	die("");
}

// recup message 
$msg = valider("msg"); 

// Chargement eventuel des données en cookies
$login = valider("login", "COOKIE");
$passe = valider("passe", "COOKIE"); 
if ($checked = valider("remember", "COOKIE")) $checked = "checked"; 

?>

<div id="corps">

<?php
	if ($msg) {
		echo "<h3 style=\"color:red;\">" . $msg ."</h3>";
	}
	// Chargement eventuel des données en cookies
	$login = valider("login", "COOKIE");
	$passe = valider("passe", "COOKIE"); 
	if ($checked = valider("remember", "COOKIE")) $checked = "checked"; 
?>
<link rel="stylesheet" type="text/css" href="css/stylelog.css">

<main class="form-signin w-30 m-auto">
<div class="formLogin">
<form action="controleur.php" method="GET">
	<h1 class="h3 mb-3 fw-normal">Connexion</h1>
	<div class="form-floating">
      <input type="email" class="form-control" name="login" id="floatingInput login" placeholder="name@example.com" value="<?php echo $login;?>" />
      <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="passe" id="floatingPassword passe" placeholder="Password" value="<?php echo $passe;?>"/>
      <label for="floatingPassword">Mot de passe</label>
    </div>
		<label class="form-check-label" for="remember">Se souvenir de moi&nbsp;&nbsp; </label><input type="checkbox" class="form-check-input" <?php echo $checked;?> name="remember" id="remember" value="ok"/> <br/><br/>
		<input class="w-100 btn btn-lg btn-secondary" type="submit" name="action" id="connexion" value="Connexion" />
</main>
</form>
</div>



</div>
