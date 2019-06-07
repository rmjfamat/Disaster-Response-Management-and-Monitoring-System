<?php
	include 'db/db-connect.php';
	 
	 if(isset($_POST['codeName']) && isset($_POST['Date']) && isset($_POST['Time']) && isset($_POST['Region']) && isset($_POST['Province']) && isset($_POST['Municipality']) && isset($_POST['Baranggay']) && isset($_POST['Sitio']) && isset($_POST['accessToken']) && isset($_POST['mapID']) && isset($_POST['sourceLayerName'])){
		 $tablename = $_POST['codeName'];
		 $codename = $_POST['codeName'];
		 $date = $_POST['Date'];
		 $time = $_POST['Time'];
		 $region = $_POST['Region'];
		 $province = $_POST['Province'];
		 $municipality = $_POST['Municipality'];
		 $baranggay = $_POST['Baranggay'];
		 $sitio = $_POST['Sitio'];
		 $accessToken = $_POST['accessToken'];
		 $mapId = $_POST['mapID'];
		 $layerName = $_POST['sourceLayerName'];
		 
		 define('DB_TABLE', $tablename); // db table
		 
		 $Sql_Query_create = "CREATE TABLE IF NOT EXISTS $tablename	 (
							`id` INT(11) AUTO_INCREMENT,
							`firstname` VARCHAR(50),
							`middlename` VARCHAR(50),
							`lastname` VARCHAR(50),						
							`head_age` VARCHAR(20),
							`headGender` VARCHAR(20),
							`address` VARCHAR(20),
							`civil_status` VARCHAR(20),
							`headBirthdate` VARCHAR(50),
							`occupation` VARCHAR(50),
							`income` VARCHAR(50),							
							`residentCategory` VARCHAR(100),
							`sharerOf` VARCHAR(50),
							`renterOf` VARCHAR(50),
							`lodgerOf` VARCHAR(50),				
							`specialSpecs` VARCHAR(20),
							`healthCondition` VARCHAR(20),
							`estimatedDamages` VARCHAR(20),
							`ethnicity` VARCHAR(50),
							`FPSMember` VARCHAR(10),
							`familyMember_1` VARCHAR(300),
							`familyMember_2` VARCHAR(300),
							`familyMember_3` VARCHAR(300),
							`verified` VARCHAR(10),
							
							`infoSource` VARCHAR(30),
							`witness` VARCHAR(30),
							`interviewer` VARCHAR(30),
							`dateRegistered` VARCHAR(20),
							`validator` VARCHAR(30),
							`dateValidated` VARCHAR(20),			
							
							`assistance1` VARCHAR(20),
							`assistance2` VARCHAR(20),
							`assistance3` VARCHAR(20),
							`assistance4` VARCHAR(20),
							`assistance5` VARCHAR(20),
							
							PRIMARY KEY (`id`))";
																	
		 $Sql_Query = "insert into reportedfireincidents (codeName, Date, Time, Region, Province, Municipality, Baranggay, Sitio, accessToken, mapID, sourceLayerName) values ('$codename', '$date', '$time', '$region', '$province', '$municipality', '$baranggay', '$sitio', '$accessToken', '$mapId', '$layerName')";
		 $Sql_Query2 = "insert into assistances(codeName, size, assistance1, assitance2, assistance3, assistance4, assistance5, assistance6, assistance7) values ($codeName, 0, '', '', '', '', '', '', '')";
		 
		 if(mysqli_query($con,$Sql_Query_create)){
			echo 'Creating new table is successfull.';
			
			if(mysqli_query($con,$Sql_Query) && mysqli_query($con,$Sql_Query2)){
				echo 'New fire incident data added to record successfully.';
			}
			else{
				echo 'Adding new fire incident data is unsuccessfull. Try again.';
			}
		 }
		 else{
				echo 'Creating table is unsuccessful. Try again';
			
		 }
		
	}
	

?>