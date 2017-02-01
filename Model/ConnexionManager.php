<?php
	class ConnexionManager extends Model{

		// Objet PDO d'accès à la BD
		private static $bdd;

		// Exécute une requête SQL éventuellement paramétrée
		protected function ConnexionModel() {
			$bdd = $this->getBdd();
		}
		public function isLoginCorrect($user, $pswd){
			
				$sql = 'select Login from Utilisateur where Login = :user AND Pass = :pswd';
				$req = $this->executerRequete($sql, array (':user' => $user, ':pswd' => $pswd));
				$data=$req->fetchAll(PDO::FETCH_ASSOC);
				$req->closeCursor();	
				if (count($data) == 1) return true;
				else return false;
				
		}
		public function connexion($user,$psw){
			if ($this->isLoginCorrect($_POST['user'], $_POST['pswd'])) {
				
				$_SESSION['isConnected'] = true;
				$_SESSION['user'] = $_POST['user'];	
			
			}
			else{
				throw new Exception('Erreur connexion.');
			}
			
		}
	}
?>