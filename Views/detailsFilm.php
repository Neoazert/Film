<?php
	$title = 'Détails du film';
	
	ob_start();
	
	echo '<h1> <strong> Détail du film : '.$dataFilm[0]['Titre'].'</strong> </h1>';
			
	
	echo '<h2> <strong> Informations sur le film </strong> </h2>';
	
			
	echo '<ul> <li> année de tournage: '.$dataFilm[0]['Année'].'</li>';
	echo '<li> score du film: '.$dataFilm[0]['Score'].'</li>';
	echo '<li> nombre de vote: '.$dataFilm[0]['Vote'].'</li> </ul> ';
	
	
	
	echo '<h2> Votez </h2>';
	
	if(!$_SESSION['isConnected']) 
		echo '<p> Vous devez être connecté pour pouvoir voter ! </p>';
	
	else if ($_SESSION['isVoted'])
		echo '<p> Vous avez déja voté pour ce film ! </p>';
	
	else 
		echo '<form action="index.php?action=vote" method="POST"> 
				 <input type="hidden" name="filmIdent" value='.$id.' />
				<input type="submit" name="Voter" value="Votez"> 
	
			</form>';
	
			
	
	
	echo '<h2> <strong> Casting du film : </strong> </h2>';
			
	echo 'Nom';
			
	foreach($dataAct as $i) echo '<p>'.$i['Ordinal'].' '.$i['Nom'].'</p>';
	
	$contenu = ob_get_clean();
	require("Views/layout.php");
?>
