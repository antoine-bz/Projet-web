<?php

// Si la page est appelée directement par son adresse, on redirige en passant par la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
  header("Location:../index.php");
  die("");
}

?>

<h2>Contenu du backlog</h2>

Romain nique tes morts

<?php

// TODO

?>

