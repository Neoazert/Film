<?php
	$title = 'Connexion';
	ob_start();
	echo '<h1> Connexion </h1>';
	echo '<form action="index.php?action=connexion" method="post">
			Pseudo: <input type="text" name="user" value=""><br>
			Password: <input type="password" name="pswd" value=""><br>
			<input type="submit" value="Se Connecter">
			</form>';
	if(isset($_SESSION['erreur_co']) && $_SESSION['erreur_co'] == true){
		echo "<p>Login ou mot de passe incorrect !</p>";
		$_SESSION['erreur_co'] = false;
	}
	$contenu = ob_get_clean();
	require("Views/layout.php");