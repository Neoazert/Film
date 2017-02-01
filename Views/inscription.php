<?php
	$title = 'Inscription';
	ob_start();
	
	echo '<h1> Inscription </h1>';
	echo '<form action="index.php?action=inscription" method="post">
			Pseudo: <input type="text" name="user" value=""><br>
			Password: <input type="password" name="pswd" value=""><br>
			Name: <input type="text" name="name" value=""><br>
			E-mail: <input type="text" name="mail" value=""><br>
			<input type="submit" value="Valider">
			</form>';
	if(isset($_SESSION['inscriValide']) && $_SESSION['inscriValide'] == false){
		echo '<h2> Inscription non valide : </h2>';
		foreach ($_SESSION['inscriTabErreur'] as $value)
			echo '<p>'.$value.'</p>';
			
		$_SESSION['inscriValide'] = true;
	}
	
			
	$contenu = ob_get_clean();
	require("Views/layout.php");