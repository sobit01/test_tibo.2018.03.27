<?php
ini_set ( 'display_errors' , 'On' );

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<a href="index.php">index</a>
	<a href="index.php?m=create_sql">create_sql</a>
	<a href="index.php?m=brand_table">brand_table</a>
	<a href="index.php?m=keyword_table">keyword_table</a>
	<br/>
	<br/>
	
	

	<?php
	include('./global/global.php');

	try {
		$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8',DB_USER ,DB_PASS );
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (Exeption $e){
		die('Erreur : '.$e->getMessage());
	}

	if(isset($_GET['m']) ){
		$m = $_GET['m'];
		switch($_GET['m']){
			case "create_sql":
				include('create_sql.php');
				break;
			case "brand_table":
				include('brand_table.php');
				break;
			case "keyword_table" || "insert":
				include('keyword_table.php');
				break;

		}
		
	}

	?>





		


</body>
</html>