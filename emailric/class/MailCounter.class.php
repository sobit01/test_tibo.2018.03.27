<?php
class KeywordMailCounter extends Counter
{
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


	public function __construct($db,$idDevice){
		//requette SQL qui retourne les différents mots clé en fonction de $idDevice
		$query = $bd->prepare('SELECT 
							`kcab`.`keyword_pk_id_keywordStart`,
							`kcab`.`keyword_pk_id_keywordEnd`,
							`kcac`.`keyword_pk_id_keywordStart`,
							`kcac`.`keyword_pk_id_keywordEnd`,
							`kcsb`.`keyword_pk_id_keywordStart`,
							`kcsb`.`keyword_pk_id_keywordEnd`,
							`kcsc`.`keyword_pk_id_keywordStart`,
							`kcsc`.`keyword_pk_id_keywordEnd`
						FROM
							`tj_keyword_engine`
						LEFT join
							`keyword` as kcab
						ON `tj_keyword_engine`.`pk_id_keywordCounterAllBlack` = `keyword`.`keyword_id`
						LEFT join
							`keyword` as kcac
						ON `tj_keyword_engine`.`pk_id_keywordCounterAllColor` = `keyword`.`keyword_id`
						LEFT join
							`keyword` as kcsb
						ON `tj_keyword_engine`.`pk_id_keywordCounterScanBlack` = `keyword`.`keyword_id`
						LEFT join
							`keyword` as kcsc
						ON `tj_keyword_engine`.`pk_id_keywordCounterScanColor` = `keyword`.`keyword_id`
						WHERE 
							`tj_keyword_engine`.`id_device` = :idDevice');
		$query->bindValue('idDevice',$idDevice,PDO::PARAM_INT)
		$query->execute();
		$data = $query->fetch(PDO::FETCH::OBj);
		
	}

	public function getKeywordStartCounterAllBlack($keywordStartCounterAllBlack){
		$this->_keywordStartCounterAllBlack = $keywordStartCounterAllBlack;
	}
	public function getKeywordSEndCounterAllBlack($keywordEndCounterAllBlack){
		$this->_keywordEndCounterAllBlack = $keywordEndCounterAllBlack;
	}
	public function getKeywordStartCounterAllColor($keywordStartCounterAllColor){
		$this->_keywordStartCounterAllColor = $keywordStartCounterAllColor;
	}
	public function getKeywordEndCounterAllColor($keywordEndCounterAllColor){
		$this->_keywordEndCounterAllColor = $keywordEndCounterAllColor;
	}
	public function getKeywordStartCounterScanBlack($keywordStartCounterScanBlack){
		$this->_keywordStartCounterScanBlack = $keywordStartCounterScanBlack;
	}
	public function getKeywordEndCounterScanBlack($keywordEndCounterScanBlack){
		$this->_keywordEndCounterScanBlack = $keywordEndCounterScanBlack;
	}
	public function getKeywordStartCounterScanColor($keywordStartCounterScanColor){
		$this->_keywordStartCounterScanColor = $keywordStartCounterScanColor;
	}
	public function getKeywordEndCounterScanBlack($keywordEndCounterScanBlack){
		$this->_keywordEndCounterScanColor = $keywordEndCounterScanColor;
	}


}
?>