<?php
error_reporting(E_ALL);
$conn = new mysqli("localhost","root","","wtf");
if($conn->connect_error){
	echo "failure";
	echo $conn->error;
}else{

try{
	$conn->query("START TRANSACTION");
	$conn->query("INSERT INTO try values(1,2)");
	$conn->query("insert into try values(3,4)");
	$conn->query("insert into try values(5,6)");
	$conn->query("insert into try values(7,8)");

	$conn->commit();
	}catch(Exception $e){
		$conn->rollback();
	}
	
}

?>
