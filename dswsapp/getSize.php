<?php
	include 'db/db-connect.php';
	if(isset($_POST['codeName'])){
		 $tablename = $_POST['codeName'];
		 $size = 0;
		 
		 $Sql_Query = "SELECT size FROM `assistances` WHERE codeName = '$tablename'";
		 $result = mysqli_query($con, $Sql_Query);
		 
		 echo $result;
		}
	 
	 ?>