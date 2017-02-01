<?php
	class CompteManager extends Model{

		// Objet PDO d'acc�s � la BD
		private static $bdd;

		// Ex�cute une requ�te SQL �ventuellement param�tr�e
		protected function CompteModel() {
			$bdd = $this->getBdd();
		}
		public function isUserAvailable($user){	
				$sql = 'SELECT Login from Utilisateur where Login = :user';
				$req = $this->executerRequete($sql, array(':user' => $user));
				return $req->rowCount();
		}
		
		public function isMailAvailable($email){	
				$sql = 'SELECT Mail from Utilisateur where Mail = :mail';
				$req = $this->executerRequete($sql, array(':mail' => $email));
				return $req->rowCount();
		}
		
		public function inscription($user, $pswd, $name, $email){		
			$sql = 'insert into Utilisateur values(:user, :pass, :name, :mail)';
			$req = $this->executerRequete($sql, array (':user' => $user, ':pass' => $pswd, ':name' => $name, ':mail' => $email));
			$req->closeCursor();
		}

	}
?>
