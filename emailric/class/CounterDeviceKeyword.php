<?php
class CounterDeviceKeyword{
		//Mots clé Compteur Total Noir [deput - fin]
	private $_keywordStartCounterAllBlack;
	private $_keywordEndCounterAllBlack;
	//------------------------------------
	//Mots clé Compteur Total Couleur [deput - fin]
	private $_keywordStartCounterAllColor;
	private $_keywordEndCounterAllColor;
	//------------------------------------
	//Mots clé Compteur Scan Noir [deput - fin]
	private $_keywordStartCounterScanBlack;
	private $_keywordEndCounterScanBlack;
	//------------------------------------
	//Mots clé Compteur Scan Couleur [deput - fin]
	private $_keywordStartCounterScanColor;
	private $_KeywordEndCounterColor;
	//------------------------------------
	public function add($db,$deviceId,$keywordStartCounterAllBlack,$keywordEndCounterAllBlack,$keywordStartCounterAllColor,$keywordEndCounterAllColor,$keywordStartCounterScanBlack,$keywordEndCounterScanBlack,$keywordStartCounterScanColor,$KeywordEndCounterColor){
		include_once('./class/CounterKeyword.php');
		// Recherche dans la BDD si l'association machine / mot cle compteur existe ?
		$query = $db->prepare("SELECT count(*) as 'nb' FROM `tj_keyword_engine` WHERE  `id_device` LIKE :id_device");
		$query->bindValue('id_device',$deviceId,PDO::PARAM_STR);
		$query->execute();
		$nbResult = $query->fetch(PDO::FETCH_OBJ);
		$query->closeCursor();


		$keywordCounterAllBlack = new CounterKeyword;
		$id_keywordCounterAllBlack = $keywordCounterAllBlack->add_keyword($db,$keywordStartCounterAllBlack,$keywordEndCounterAllBlack);

		$keywordCounterAllColor = new CounterKeyword;
		$id_keywordCounterAllColor = $keywordCounterAllBlack->add_keyword($db,$keywordStartCounterAllColor,$keywordEndCounterAllColor);

		$keywordCounterScanBlack = new CounterKeyword;
		$id_keywordCounterScanBlack = $keywordCounterScanBlack->add_keyword($db,$keywordStartCounterScanBlack,$keywordEndCounterScanBlack);

		$keywordCounterScanColor = new CounterKeyword;
		$id_keywordCounterScanColor = $keywordCounterScanColor->add_keyword($db,$keywordStartCounterScanColor,$KeywordEndCounterColor);


		if($nbResult->nb == 0){
			echo "<br/>création d'une liaaison mont cle/machine<br/>";
			$query = $db->prepare("INSERT INTO `tj_keyword_engine` (
										`pk_id_keywordCounterAllBlack`,
										`pk_id_keywordCounterAllColor`,
										`pk_id_keywordCounterScanBlack`,
										`pk_id_keywordCounterScanColor`,
										`id_device`
									) VALUE(
										:id_keywordCounterAllBlack ,
										:id_keywordCounterAllColor,
										:id_keywordCounterScanBlack,
										:id_keywordCounterScanColor,
										:id_device
								)");
			$query->bindValue('id_keywordCounterAllBlack',$id_keywordCounterAllBlack,PDO::PARAM_INT);
			$query->bindValue('id_keywordCounterAllColor',$id_keywordCounterAllColor,PDO::PARAM_INT);
			$query->bindValue('id_keywordCounterScanBlack',$id_keywordCounterScanBlack,PDO::PARAM_INT);
			$query->bindValue('id_keywordCounterScanColor',$id_keywordCounterScanColor,PDO::PARAM_INT);
			$query->bindValue('id_device',$deviceId,PDO::PARAM_INT);
			$query->execute();
			$query->closeCursor();
			
		}else{
			// Si $word existe on recupère son ID
			$query = $db->prepare("UPDATE `tj_keyword_engine` SET 
										`pk_id_keywordCounterAllBlack` = :id_keywordCounterAllBlack ,
										`pk_id_keywordCounterAllColor` = :id_keywordCounterAllColor,
										`pk_id_keywordCounterScanBlack` = :id_keywordCounterScanBlack,
										`pk_id_keywordCounterScanColor` = :id_keywordCounterScanColor
									WHERE
										`id_device` = :id_device
								 ");
			$query->bindValue('id_keywordCounterAllBlack',$id_keywordCounterAllBlack,PDO::PARAM_INT);
			$query->bindValue('id_keywordCounterAllColor',$id_keywordCounterAllColor,PDO::PARAM_INT);
			$query->bindValue('id_keywordCounterScanBlack',$id_keywordCounterScanBlack,PDO::PARAM_INT);
			$query->bindValue('id_keywordCounterScanColor',$id_keywordCounterScanColor,PDO::PARAM_INT);
			$query->bindValue('id_device',$deviceId,PDO::PARAM_INT);
			$query->execute();
			$query->closeCursor();

		}
		

	}
}