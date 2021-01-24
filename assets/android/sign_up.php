<?php

include "db_connect.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
$nama_distributor = mysqli_real_escape_string($conn, $_POST['nama_distributor']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$password= mysqli_real_escape_string($conn,$_POST['password']);
$telephone= mysqli_real_escape_string($conn, $_POST['telephone']);
$alamat = mysqli_real_escape_string($conn,$_POST['alamat']);

$check_query = "SELECT * FROM tb_distributor WHERE email='$email'";
$check_result_query =mysqli_fetch_array(mysqli_query($conn,$check_query));

if (isset($check_result_query)) {
	// User already exists
	  $result["success"] = "0";
	  $result["message"] = "Account already exits!";

		echo json_encode($result);
		echo $result[message];
}

else{

	// Create user
$sql=mysqli_query($conn, 'INSERT INTO tb_distributor(nama_distributor,email,password,telephone,alamat)
         VALUES("'.$_POST['nama_distributor'].'","'.$_POST['email'].'",SHA1("'.$_POST['password'].'")),"'.$_POST['telephone'].'","'.$_POST['alamat'].'"');


		 if (!$sql) {
		 die (mysqli_error($conn));
		 }

else {

	    $result["success"] = "1";
		$result["message"] = "Account created successfully!";

		echo json_encode($result);
		echo $result;
}

}}

else {

	        $result["success"] = "0";
		$result["message"] = "Registration failed, an error occurred";

		echo json_encode($result);
		echo $result;
}


?>
