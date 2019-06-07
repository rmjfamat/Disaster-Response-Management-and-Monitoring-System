<?php
	$random_salt_length = 32;

	function userExists($username){
		$query = "SELECT username FROM mobile_users WHERE username = ?";
		global $con;
		if($stmt = $con->prepare($query)){
			$stmt->bind_param("s",$username);
			$stmt->execute();
			$stmt->store_result();
			$stmt->fetch();
			if($stmt->num_rows == 1){
				$stmt->close();
				return true;
			}
			$stmt->close();
		}
	 
		return false;
	}
	 
	function getSalt(){
		global $random_salt_length;
		return bin2hex(openssl_random_pseudo_bytes($random_salt_length));
	}

	function concatPasswordWithSalt($password,$salt){
		global $random_salt_length;
		if($random_salt_length % 2 == 0){
			$mid = $random_salt_length / 2;
		}
		else{
			$mid = ($random_salt_length - 1) / 2;
		}
	 
		return
		substr($salt,0,$mid - 1).$password.substr($salt,$mid,$random_salt_length - 1);
	}
?>