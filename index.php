<?php

	session_name ('p1503046');
	session_start();
	
	if (!isset($_SESSION['isConnected'])){
		
		$_SESSION['isConnected'] = false;
	}
	
	require('Model/Model.php');
	require('Model/FilmManager.php');
	require('Model/ConnexionManager.php');
	require('Model/VoteManager.php');
	require('Model/CompteManager.php');
	
	
	$Film = new FilmManager();

	//DETAILS FILMS
	if (isset($_GET['movieid'])){
		$id = (int)$_GET['movieid'];
		$dataAct = $Film->getCasting($id);
		$dataFilm = $Film->getDetailsFilm($id);
		if($id <= 0 || count($dataFilm) == 0) require("Views/error.php");
		else{
			$vote = new VoteManager();
			if (isset($_SESSION['user'])) $_SESSION['isVoted'] = $vote->hasBeenVoted($_SESSION['user'],$id);
			require("Views/detailsFilm.php");
			}
	}
		
	//CONNEXION
	else if (isset($_GET['action']) && $_GET['action'] == 'connexion'){
		$co = new ConnexionManager();
		try{
		$co->connexion($_POST['user'],$_POST['pswd']);
		header('Location: index.php');	
		}
		catch (Exception $e) {
			$_SESSION['erreur_co'] = true;
			header('Location: index.php?action=pageco');	
		}
	}
	
	//PAGE CONNEXION
	else if (isset($_GET['action']) && $_GET['action'] == 'pageco') require("Views/Connexion.php");
	
	//BOUTON DECONNEXION
	else if (isset($_GET['action']) && $_GET['action'] == 'deco'){
		$_SESSION = array();
		header('Location: index.php');	
		exit(0);
	}
	
	//BOUTON VOTE
	else if(isset($_GET['action']) && $_GET['action'] == 'vote'){
		$vote = new VoteManager();
		
		$vote->voter($_POST['filmIdent'], $_SESSION['user']);
		header('Location: index.php?movieid='.$_POST['filmIdent']);	
		
	}
	
	//PAGE INSCRIPTION
	else if(isset($_GET['action']) && $_GET['action'] == 'inscri') require('Views/inscription.php');
	
	//INSCRIPTION
	else if(isset($_GET['action']) && $_GET['action'] == 'inscription'){
		$_SESSION['inscriValide'] = true;
		$_SESSION['inscriTabErreur'] = array();
		
		$co = new CompteManager();
		
		if($_POST['user'] == ""){
			$_SESSION['inscriValide'] = false;
			array_push($_SESSION['inscriTabErreur'], 'Le champ pseudo est vide !');
		}
		else{
			if($co->isUserAvailable($_POST['user']) == 1){
				$_SESSION['inscriValide'] = false;
				array_push($_SESSION['inscriTabErreur'], 'Le pseudo est déja utilisé !');
			}
		}
		
		if($_POST['pswd'] == ""){
			$_SESSION['inscriValide'] = false;
			array_push($_SESSION['inscriTabErreur'], 'Le champ Password est vide !');
		}
		
		if($_POST['name'] == ""){
			$_SESSION['inscriValide'] = false;
			array_push($_SESSION['inscriTabErreur'], 'Le champ Name est vide !');
		}
		
		if($_POST['mail'] == ""){
			$_SESSION['inscriValide'] = false;
			array_push($_SESSION['inscriTabErreur'], 'Le champ Mail est vide !');
		}
		else{
			if($co->isMailAvailable($_POST['mail']) == 1){
				$_SESSION['inscriValide'] = false;
				array_push($_SESSION['inscriTabErreur'], 'Le mail est déja utilisé !');
			}
		}
		
		if ($_SESSION['inscriValide'] == true){
				$co->inscription($_POST['user'], $_POST['pswd'], $_POST['name'], $_POST['mail']);
				header('Location: index.php?action=pageco');	
				
		}
		else 
			require('Views/inscription.php');
		
		
	}
	
	
	
	//DEFAULT
	else{
		$data = $Film->getFilm();
		$count = count($data);
		require("Views/films.php");
	}
?>



