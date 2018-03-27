<?php
isset($_POST['deviceId'])? $deviceId = $_POST['deviceId'] : $deviceId = "";
isset($_POST['keywordStartCounterAllBlack'])? $keywordStartCounterAllBlack = $_POST['keywordStartCounterAllBlack'] : $keywordStartCounterAllBlack = "";
isset($_POST['keywordEndCounterAllBlack'])? $keywordEndCounterAllBlack = $_POST['keywordEndCounterAllBlack'] : $keywordEndCounterAllBlack = "";
isset($_POST['keywordStartCounterAllColor'])? $keywordStartCounterAllColor = $_POST['keywordStartCounterAllColor'] : $keywordStartCounterAllColor = "";
isset($_POST['keywordEndCounterAllColor'])? $keywordEndCounterAllColor = $_POST['keywordEndCounterAllColor'] : $keywordEndCounterAllColor = "";
isset($_POST['keywordStartCounterScanBlack'])? $keywordStartCounterScanBlack = $_POST['keywordStartCounterScanBlack'] : $keywordStartCounterScanBlack = "";
isset($_POST['keywordEndCounterScanBlack'])? $keywordEndCounterScanBlack = $_POST['keywordEndCounterScanBlack'] : $keywordEndCounterScanBlack = "";
isset($_POST['keywordStartCounterScanColor'])? $keywordStartCounterScanColor = $_POST['keywordStartCounterScanColor'] : $keywordStartCounterScanColor = "";
isset($_POST['keywordEndCounterScanColor'])? $keywordEndCounterScanColor = $_POST['keywordEndCounterScanColor'] : $keywordEndCounterScanColor = "";



if(isset($_POST['form'])){
	switch($_POST['form']){
		case "insert":
		/*
			$query = $db->prepare("SELECT count(*) as 'nb' FROM `keyword` WHERE `keyword_Start` LIKE :keywordStartCounterAllBlack  ");
			$query->bindValue('keywordStartCounterAllBlack',$keywordStartCounterAllBlack,PDO::PARAM_STR);
			$query->execute();		
			$data = $query->fetch(PDO::FETCH_OBJ);
			$query->closeCursor();
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
				$query = $db->prepare("INSERT INTO `keyword` (`keyword_Start`) VALUE(:keywordStartCounterAllBlack)");
				$query->bindValue('keywordStartCounterAllBlack',$keywordStartCounterAllBlack,PDO::PARAM_STR);
				$query->execute();
				$lastId = $db->lastInsertId();

			}else{
				//
				echo "<br/>->".$keywordStartCounterAllBlack."<- est pas dans la base'";
			}*/

	//		include_once('./class/CounterKeyword.php');
	//		$motcle = new CounterKeyword;
	//		$id = $motcle->add_keyword($db,$keywordStartCounterAllBlack,$keywordEndCounterAllBlack);
	//		echo "<br/>ID =".$id."<br/>";

			


			include_once('./class/CounterDeviceKeyword.php');
			$mail = new CounterDeviceKeyword;
			$mail->add($db,
				$deviceId,
				$keywordStartCounterAllBlack,
				$keywordEndCounterAllBlack,
				$keywordStartCounterAllColor,
				$keywordEndCounterAllColor,
				$keywordStartCounterScanBlack,
				$keywordEndCounterScanBlack,
				$keywordStartCounterScanColor,
				$keywordEndCounterScanColor);
			break;
	}
}



?>

<form method="post" action="index.php?m=<?= $m ?>">
	----------------------------------<br/>
	<select name="deviceId">
		<option></option>
	<?php
	$query = $db->query("SELECT `device_id`,`device_name` FROM `device`");

	$data = $query->fetchAll(PDO::FETCH_OBJ);
	
	foreach($data as $key =>$value){
		?><option value="<?= $data[$key]->device_id ?>"><?= $data[$key]->device_name ?></option><?php
	}
	?>
	$query->closeCursor();
	</select>
	----------------------------------<br/>
	keywordStartCounterAllBlack:<input type="text" name="keywordStartCounterAllBlack"><br/>
	keywordEndCounterAllBlack:<input type="text" name="keywordEndCounterAllBlack"><br/>
	----------------------------------<br/>
	keywordStartCounterAllColor:<input type="text" name="keywordStartCounterAllColor"><br/>
	keywordEndCounterAllColor:<input type="text" name="keywordEndCounterAllColor"><br/>
	----------------------------------<br/>
	keywordStartCounterScanBlack:<input type="text" name="keywordStartCounterScanBlack"><br/>
	keywordEndCounterScanBlack:<input type="text" name="keywordEndCounterScanBlack"><br/>
	----------------------------------<br/>
	keywordStartCounterScanColor:<input type="text" name="keywordStartCounterScanColor"><br/>
	keywordEndCounterScanColor:<input type="text" name="keywordEndCounterScanColor"><br/>
	----------------------------------<br/>
	<input type="hidden" name="form" value="insert">
	<input type="submit">
</form> 
<?php
try{
	$query = $db->prepare("SELECT 
					`device`.`device_name`,
					`kcab`.`keyword_Start` AS 'keywordStartCounterAllBlack',
					`kcab`.`keyword_End` AS 'keywordEndCounterAllBlack',
					`kcac`.`keyword_Start` AS 'keywordStartCounterAllColor',
					`kcac`.`keyword_End` AS 'keywordEndCounterAllColor',
					`kcsb`.`keyword_Start` AS 'keywordStartCounterScanBlack',
					`kcsb`.`keyword_End` AS 'keywordEndCounterScanBlack',
					`kcsc`.`keyword_Start` AS 'keywordStartCounterScanColor',
					`kcsc`.`keyword_End` AS 'keywordEndCounterScanColor'
				FROM
					`tj_keyword_engine`
				LEFT join
					`keyword` as kcab
				ON `tj_keyword_engine`.`pk_id_keywordCounterAllBlack` = `kcab`.`keyword_id`
				LEFT join
					`keyword` as kcac
				ON `tj_keyword_engine`.`pk_id_keywordCounterAllColor` = `kcac`.`keyword_id`
				LEFT join
					`keyword` as kcsb
				ON `tj_keyword_engine`.`pk_id_keywordCounterScanBlack` = `kcsb`.`keyword_id`
				LEFT join
					`keyword` as kcsc
				ON `tj_keyword_engine`.`pk_id_keywordCounterScanColor` = `kcsc`.`keyword_id`
				LEFT join
					`device`
				ON `tj_keyword_engine`.`id_device` = `device`.`device_id`
				");
	//$query->bindValue('idDevice',$idDevice,PDO::PARAM_INT)
	$query->execute();
	//echo "<br/>".$query->queryString;
/*	$data = $query->fetchAll(PDO::FETCH_OBJ);
	echo "<pre>";
	var_dump($data);
	echo "</pre>";
	*/
?>

<table>
	<tr>
		<td>device_name</td>
		<td>keywordStartCounterAllBlack</td>
		<td>keywordEndCounterAllBlack</td>
		<td>keywordStartCounterAllColor</td>
		<td>keywordEndCounterAllColor</td>
		<td>keywordStartCounterScanBlack</td>
		<td>keywordEndCounterScanBlack</td>
		<td>keywordStartCounterScanColor</td>
		<td>keywordEndCounterScanColor</td>
	</tr>
	<?php
	while($data = $query->fetch(PDO::FETCH_OBJ)){
//		echo "<pre>";
//	var_dump($data);
//	echo "</pre>";
		?>
		<tr>
			<td><?= $data->device_name ?></td>
			<td><?= $data->keywordStartCounterAllBlack ?></td>
			<td><?= $data->keywordEndCounterAllBlack ?></td>
			<td><?= $data->keywordStartCounterAllColor ?></td>
			<td><?= $data->keywordEndCounterAllColor ?></td>
			<td><?= $data->keywordStartCounterScanBlack ?></td>
			<td><?= $data->keywordEndCounterScanBlack ?></td>
			<td><?= $data->keywordStartCounterScanColor ?></td>
			<td><?= $data->keywordEndCounterScanColor ?></td>

		</tr>
			<?php
	}
	$query->closeCursor();
?>
</table>
<?php
}

catch(Exeption $e){
	die('Erreur : '.$e->getMessage());
}
/*
$query = $db->query("SELECT `device_id`,`device_name` FROM `device`");

	$data = $query->fetchAll(PDO::FETCH_OBJ);
	var_dump($data);
*/
	?>