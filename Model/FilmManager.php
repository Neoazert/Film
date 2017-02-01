
<?php
	class FilmManager extends Model{

		// Objet PDO d'accès à la BD
		private static $bdd;

		// Exécute une requête SQL éventuellement paramétrée
		protected function FilmModel() {
			$bdd = $this->getBdd();
		}
		public function getFilm(){
				$sql = 'SELECT * FROM Movie';
				$req = $this->executerRequete($sql);
				$count=$req->rowCount();
				$data=$req->fetchAll(PDO::FETCH_ASSOC);
				$req->closeCursor();
				return $data;
		}
		
		public function getCasting($ID){				
				$sql = 'select Nom, Ordinal from Casting c, Actor a where c.ActorID=a.ActorID and MovieID= :ID order by Ordinal';
				$req = $this->executerRequete($sql, array (':ID' => $ID));
				$data=$req->fetchAll(PDO::FETCH_ASSOC);
				$req->closeCursor();
				return $data;
		}
		
		public function getDetailsFilm($ID){		
			$sql = 'SELECT * FROM Movie WHERE MovieID=:ID';
			$req = $this->executerRequete($sql, array (':ID' => $ID));
			$data=$req->fetchAll(PDO::FETCH_ASSOC);
			$req->closeCursor();
			return $data;
		}
	}
?>
