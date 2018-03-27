<?php
class CounterKeyword{
	private $_keywordStartCounterAllBlack;

	public function setStartCounterAllBlack($keywordStartCounterAllBlack){
		$this->_keywordStartCounterAllBlack = $keywordStartCounterAllBlack;
	}
	public function add_keyword($db,$keywordStart,$keywordEnd){
	//	if($keywordStart != '' && $keywordEnd != ''){
			// Recherche dans la BDD si $word existe ?
			$query = $db->prepare("SELECT count(*) as 'nb' FROM `keyword` WHERE `keyword_Start` LIKE :keywordStart AND `keyword_end` LIKE :keywordEnd");
			$query->bindValue('keywordStart',$keywordStart,PDO::PARAM_STR);
			$query->bindValue('keywordEnd',$keywordEnd,PDO::PARAM_STR);
			$query->execute();
			$nbResult = $query->fetch(PDO::FETCH_OBJ);
			$query->closeCursor();
			if($nbResult->nb == 0){
				// Si $word n'existe pas on le crée et on recupère son ID
				$query = $db->prepare("INSERT INTO `keyword` (`keyword_Start`,`keyword_end`) VALUE(:keywordStart ,:keywordEnd )");
				$query->bindValue('keywordStart',$keywordStart,PDO::PARAM_STR);
				$query->bindValue('keywordEnd',$keywordEnd,PDO::PARAM_STR);
				$query->execute();
				$query->closeCursor();
				$id = $db->lastInsertId();
				return $id;
			}else{
				// Si $word existe on recupère son ID
			//	echo "<br/>keywordStart:".$keywordStart."</br>";
			//	echo "<br/>keywordEnd:".$keywordEnd."</br>";
				$query = $db->prepare("SELECT `keyword_id` FROM `keyword` WHERE `keyword_Start` LIKE :keywordStart AND  `keyword_end` LIKE :keywordEnd ");
				$query->bindValue('keywordStart',$keywordStart,PDO::PARAM_STR);
				$query->bindValue('keywordEnd',$keywordEnd,PDO::PARAM_STR);
				$query->execute();
				$data = $query->fetch(PDO::FETCH_OBJ);
				$query->closeCursor();
			//	echo "<pre>";
			//	var_dump($data);
			//	echo "</pre>";
				$id = $data->keyword_id;
				return $id;
			}
	//	}else{
	//		return 0;
	//	}
	}
}


/*


	
//	$query = $db->prepare("SELECT count(*) as 'nb' FROM `keyword` WHERE `keyword_Start` LIKE :keywordStartCounterAllBlack  ");
//			$query->bindValue('keywordStartCounterAllBlack',$keywordStartCounterAllBlack,PDO::PARAM_STR);
//			$query->execute();		
//			$data = $query->fetch(PDO::FETCH_OBJ);
//			$query->closeCursor();
			echo "<br/>";
			var_dump($data);
			echo "<br/>---> nb resultat :".$data->nb."<--<br/>";
		/*	echo "<br/>".$query->queryString;
			echo "<br/>---------------------------------------------------------------><br/>";
			echo "--------------------------> DATA:<br/>";
			echo "---------------------------------------------------------------><br/>";
			var_dump($data);
			echo "<br/>---------------------------------------------------------------><br/>";
			echo "---------------------------------------------------------------><br/>";
			echo "---------------------------------------------------------------><br/><br/><br/><br/><br/><br/> dump data:<br/>";
			if($data->nb == 0){
				//insert si n'est pas dans la base
				echo "<br/>->".$keywordStartCounterAllBlack."<- n\'est pas dans la base'";
	//			$query = $db->prepare("INSERT INTO `keyword` (`keyword_Start`) VALUE(:keywordStartCounterAllBlack)");
				$query->bindValue('keywordStartCounterAllBlack',$keywordStartCounterAllBlack,PDO::PARAM_STR);
				$query->execute();
				$lastId = $db->lastInsertId();

			}else{
				//
				echo "<br/>->".$keywordStartCounterAllBlack."<- est pas dans la base'";
			}
			*/