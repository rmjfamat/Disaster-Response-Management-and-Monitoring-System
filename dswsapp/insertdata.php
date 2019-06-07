<?php
	include 'db/db-connect.php';
	 
	 if(isset($_POST['table_name']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['middlename']) && isset($_POST['head_age'])  && isset($_POST['headGender']) && isset($_POST['address']) && isset($_POST['civil_status']) && isset($_POST['headBirthdate']) && isset($_POST['occupation']) && isset($_POST['income']) && isset($_POST['residentCategory']) && isset($_POST['renterOf']) && isset($_POST['sharerOf']) && isset($_POST['lodgerOf']) && isset($_POST['estimatedDamages']) && isset($_POST['specialSpecs']) && isset($_POST['healthCondition']) && isset($_POST['ethnicity']) && isset($_POST['FPSMember']) && isset($_POST['familyMember_1']) && isset($_POST['familyMember_2']) && isset($_POST['familyMember_3']) && isset($_POST['verified']) && isset($_POST['infoSource']) && isset($_POST['witness']) && isset($_POST['interviewer']) && isset($_POST['dateRegistered']) && isset($_POST['validator']) && isset($_POST['dateValidated']) ){
		 $tablename = $_POST['table_name'];
		 $firstname = $_POST['firstname'];
		 $middlename = $_POST['middlename'];
		 $lastname = $_POST['lastname'];
		 $age = $_POST['head_age'];
		 $head_gender = $_POST['headGender'];
		 $victim_occupation = $_POST['occupation'];
		 $address = $_POST['address'];
		 $civil_status = $_POST['civil_status'];
		 $head_birthdate = $_POST['headBirthdate'];
		 $head_income = $_POST['income'];
		 $residentCategory = $_POST['residentCategory'];
		 $renter = $_POST['renterOf'];
		 $sharer = $_POST['sharerOf'];
		 $lodger = $_POST['lodgerOf'];
		 $estimate = $_POST['estimatedDamages'];
		 $special = $_POST['specialSpecs'];
		 $health_con = $_POST['healthCondition'];
		 $ethnicity = $_POST['ethnicity'];
		 $four_ps = $_POST['FPSMember'];
		 $familyMember1 = $_POST['familyMember_1'];
		 $familyMember2 = $_POST['familyMember_2'];
		 $familyMember3 = $_POST['familyMember_3'];
		 $verif = $_POST['verified'];
		 $infoSrc = $_POST['infoSource'];
		 $witness = $_POST['witness'];
		 $interviewer = $_POST['interviewer'];
		 $dateReg = $_POST['dateRegistered'];
		 $validator = $_POST['validator'];
		 $dateVal = $_POST['dateValidated'];
		 
		 $Sql_Query = "insert into $tablename (firstname, middlename, lastname, head_age, headGender, occupation, address, civil_status, headBirthdate, income, residentCategory, renterOf, sharerOf, lodgerOf, estimatedDamages, specialSpecs, healthCondition, ethnicity, FPSMember, familyMember_1, familyMember_2, familyMember_3, verified, infoSource, witness, interviewer, dateRegistered, validator, dateValidated) values ('$firstname', '$middlename', '$lastname', '$age', '$head_gender', '$victim_occupation', '$address', '$civil_status', '$head_birthdate', '$head_income', '$residentCategory', '$renter', '$sharer', '$lodger', '$estimate', '$special', '$health_con', '$ethnicity', '$four_ps', '$familyMember1', '$familyMember2', '$familyMember3', '$verif', '$infoSrc', '$witness', '$interviewer', '$dateReg', '$validator', '$dateVal')";
		 $result = mysqli_query($con, "SELECT firstname FROM $tablename where firstname = '$firstname' AND middlename = '$middlename' AND lastname = '$lastname'");
		 
		 if(mysqli_num_rows($result) !=0){
			echo "This name already registered.";
		 }else{
			if(mysqli_query($con,$Sql_Query)){
			echo 'Data Inserted Successfully';
			}
			else{
				echo 'Saving data is unsuccessful. Try again';
			}
		 }
	}
		
?>