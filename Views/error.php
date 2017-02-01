<?php
	$title = 'Details du film';
	
	ob_start();
	echo "<h1> Liste des films </h1>";
	echo "<p> Une erreur est survenue : Identifiant de film requis. </p>";
	$contenu = ob_get_clean();
	require("Views/layout.php");
?>