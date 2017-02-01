<?php
	class VoteManager extends Model{

		// Objet PDO d'accès à la BD
		private static $bdd;

		// Exécute une requête SQL éventuellement paramétrée
		protected function VoteModel() {
			$bdd = $this->getBdd();
		}
		public function hasBeenVoted($user, $filmID){
				$sql = 'select Login from Votes where Login = :log AND MovieID = :id';
				$req = $this->executerRequete($sql, array (':log' => $user, ':id' => $filmID));
				$data=$req->fetchAll(PDO::FETCH_ASSOC);
				$req->closeCursor();
				$count=$req->rowCount();
				return $count;					
		}
		
		public function voter($filmID,$user){
			
			$sql = 'Update Movie set Vote = Vote +1 where MovieID = :id';
			$req = $this->executerRequete($sql, array (':id' => $filmID));
			$req->closeCursor();	
				
			$sql = 'Insert Into Votes Value(:id, :user)';
			$req = $this->executerRequete($sql, array(':id' => $filmID, ':user' => $user));
			$req->closeCursor();	
				
				
			
		}
		
	}
?>