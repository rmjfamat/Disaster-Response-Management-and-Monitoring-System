<?php
	include 'db/db-connect.php';
	
	if(isset($_POST['table_name']) && isset($_POST['id']) && isset($_POST['assistance_type'])){
		 $tablename = $_POST['table_name'];
		 $id = $_POST['id'];
		 $assistance = $_POST['assistance_type'];
		 
		 $sql_query = "UPDATE $tablename SET $assistance_type = 'Yes' WHERE id = $id";
		 
		 if(mysqli_query($con,$sql_query)){
	
			echo 'It has been noted that the victim has recieved the assistance.';
		 
		 }
		 else{
		 
			echo 'Updating data unsuccessful. Try again';
		 
		 }
		 
		 
		
	}
	
	<?php
	include 'db/db-connect.php';
	
	$id = 1;
	$tablename = "fireincident00";
	$assistant_type = "";
	$updateAssist = "";
	$assistant_type = "food_packs";
	
	$sql="SELECT * FROM $tablename where id = '$id'";
	$result = mysqli_query($con,$sql);
 
	$data = array();
	$row = mysqli_fetch_assoc($result);
	$assist = $row[$assistant_type];
	
	if($assist == NULL){
		$updateAssist = "Yes";
		$sql="UPDATE $tablename SET $assistant_type = '$updateAssist' where id = '$id'";
		if(mysqli_query($con,$sql)){
			echo "Successfully updated database";
		}else {
			echo "Problem updating the database.";
		}
	}else if($assist == "Yes"){
		echo "Victim has already recieved this assistance.";
	}
	
	
?>