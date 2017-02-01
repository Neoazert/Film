<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
        <link rel="stylesheet" href="css.css" />
        <title><?php echo $title; ?></title>
	</head>
	
	<body>
		<ul id='menu'>
		
		<li><form action="index.php?action=accueil"> <input class="bouton" type="submit" value="Accueil"> </form></li>
		
		<?php 
				
		if(!$_SESSION['isConnected']) 
			echo '<li><form action="index.php?action=pageco" method="POST"> <input class="bouton" type="submit" value="Connexion"> </form></li>';
		else
			echo '<li><form action="index.php?action=deco" method="POST"> <input class="bouton" type="submit" value="Deconnexion"> </form></li>';
		
		if(isset($_SESSION['user'])) echo '<p id ="nomCO"> Vous êtes connecté en tant que '.$_SESSION['user'].'</p>';
		else echo '<li><form action="index.php?action=inscri" method="POST"> <input class="bouton" id="inscri" type="submit" value="Inscrivez vous !"> </form></li>';
		
		echo "</ul>";
		
		
		echo "<div id='corps'>";
		
		echo $contenu; 
		
		echo "</div>";
		?>
	</body>
</html>
	
	