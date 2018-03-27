<?php
//-------------------------------------//
			// Crréation de la table Marque
			//-------------------------------------//
			try{

				$sql = "CREATE TABLE  IF NOT EXISTS `brand` (
							`brand_id` int NOT NULL AUTO_INCREMENT,
							`brand_name` varchar(255) NOT NULL,
							  PRIMARY KEY (`brand_id`)
						) ENGINE=InnoDB ";
				$query = $db->prepare($sql);
				$query->execute();
			//	var_dump($query);
				echo "<pre>".$query->queryString."</pre>";
						
			}
			catch (Expetion $e){
				echo "eeeeeeeeeeeeeeeeeeeeeeee----<br/>";
				var_dump($query);
			}
			//-------------------------------------//
			// Crréation de la table Machine
			//-------------------------------------//
			try{
				
				
				$sql="CREATE TABLE IF NOT EXISTS `device` (
					  `device_id` int NOT NULL AUTO_INCREMENT,
					  `device_pk_brand_id` int NOT NULL,
					  `device_name` varchar(255) NOT NULL,
					  `device_pk_device_type_id` int NOT NULL,
					  `device_pk_segment_id` int NOT NULL,
					  `device_VMinBlackMonthly` int NOT NULL,
					  `device_VMinColorMonthly` int NOT NULL,
					  `device_VMaxBlackMonthly` int NOT NULL,
					  `device_VMaxColorMonthly` int NOT NULL,
					  `device_isColor` int(2) NOT NULL,
					  `device_is_sale` int(2) NOT NULL,
					  PRIMARY KEY (`device_id`)
					) ENGINE=InnoDB ";
				$query = $db->prepare($sql);
				echo "<pre>".$query->queryString."</pre>";
				$query->execute();
			}
			catch (Expetion $e){
				echo "eeeeeeeeeeeeeeeeeeeeeeee----<br/>";
				var_dump($query);
			}
			//-------------------------------------//
			// Crréation de la table Mots Clés
			//-------------------------------------//
			try{
				
				
				$sql="CREATE TABLE IF NOT EXISTS `keyword` (
					`keyword_id` INT NOT NULL AUTO_INCREMENT,
					`keyword_Start` varchar(255) NOT NULL,
					`keyword_End` varchar(255) NOT NULL,
					 PRIMARY KEY (`keyword_id`)
				 ) ENGINE = InnoDB";
				$query = $db->prepare($sql);
				echo "<pre>".$query->queryString."</pre>";
				$query->execute();
			}
			catch (Expetion $e){
				echo "eeeeeeeeeeeeeeeeeeeeeeee----<br/>";
				var_dump($query);
			}
			//-------------------------------------//
			// Crréation de la table liaison Mots Clés / Machine
			//-------------------------------------//
			try{
				
				
				$sql="CREATE TABLE IF NOT EXISTS `tj_keyword_engine` (
					`id` INT NOT NULL AUTO_INCREMENT,
					`pk_id_keywordCounterAllBlack` INT NOT NULL,
					`pk_id_keywordCounterAllColor` INT NOT NULL,
					`pk_id_keywordCounterScanBlack` INT NOT NULL,
					`pk_id_keywordCounterScanColor` INT NOT NULL,
					`id_device` INT NOT NULL,
	 				PRIMARY KEY (`id`)
 				) ENGINE = InnoDB";
				$query = $db->prepare($sql);
				echo "<pre>".$query->queryString."</pre>";
				$query->execute();
			}
			catch (Expetion $e){
				echo "eeeeeeeeeeeeeeeeeeeeeeee----<br/>";
				var_dump($query);
			}