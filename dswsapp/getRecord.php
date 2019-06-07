<?php
	include 'db/db-connect.php';

	$sql="SELECT * FROM `reportedfireincidents`";
	$result = mysqli_query($con,$sql);
 
	$data = array();
	while($row = mysqli_fetch_assoc($result)){
		$data["data"][]=$row;
	}
 
	header('Content-Type:Application/json');
			
	echo json_encode($data);
	

?>