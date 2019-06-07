<?php
	include 'db/db-connect.php';
	
	if(isset($_POST['table_name']) && isset($_POST['firstname']) && isset($_POST['middlename']) && isset($_POST['lastname']) && isset($_POST['assistant_type'])){
		$str_fname = $_POST['firstname'];
		$str_lname = $_POST['lastname'];
		$str_mname = $_POST['middlename'];
		$tablename = $_POST['table_name'];
		$assistant_type = $_POST['assistant_type'];
	}
	
	$updateAssist = "";
		
	$sql="SELECT * FROM $tablename where firstname = '$str_fname' AND lastname = '$str_lname' AND middlename = '$str_mname'";
	$result = mysqli_query($con,$sql);
 
	$data = array();
	$row = mysqli_fetch_assoc($result);
	$assist = $row[$assistant_type];
	
	if($assist == NULL){
		$updateAssist = "Yes";
		$sql="UPDATE $tablename SET $assistant_type = '$updateAssist' where firstname = '$str_fname' AND lastname = '$str_lname' AND middlename = '$str_mname'";
		if(mysqli_query($con,$sql)){
			if($assistant_type == "assistance1"){
				echo "Successfully updated data. It has been noted that the victim head has already received food packs";
			}
			if($assistant_type == "assistance2"){
				echo "Successfully updated data. It has been noted that the victim head has already received relief packs";
			}
			if($assistant_type == "assistance3"){
				echo "Successfully updated data. It has been noted that the victim head has already received health kits.";
			}
			if($assistant_type == "assistance4"){
				echo "Successfully updated data. It has been noted that the victim head has already received housing materials.";
			}
			if($assistant_type == "assistance5"){
				echo "Successfully updated data. It has been noted that the victim head has already received financial assistance.";
			}
			
		}else {
			echo "Problem updating the database.";
		}
	}else if($assist == "Yes"){
		echo "Victim has already recieved this kind of assistance.";
	}
	
	
?>