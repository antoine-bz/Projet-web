<?php

// Si la page est appelée directement par son adresse, on redirige en passant par la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
  header("Location:../index.php");
  die("");
}

?>

<h2>Bienvenue sur 2i'ndeed</h2>



<?php

// TODO

?>
