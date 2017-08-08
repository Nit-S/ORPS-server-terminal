<?php


header("Content-Type: application/json; charset=UTF-8");
require "res/inc/connect.php";

function showBooking($mconn,$mregKey){
$getRegQuery=$mconn->query("SELECT * FROM `registrations` WHERE reg_no='".$mregKey."'");
		if($mconn->errno){
	    die('fatal error : '.$conn->error);
       }
if($getRegQuery->num_rows==1){
        if($row=$getRegQuery->fetch_assoc()){
        	echo json_encode($row);
	}
	$getRegQuery->close();
	}
}

// $key=$_REQUEST['key'];

$key="ghy2w10001201708041456";

showBooking($conn,$key);

?>