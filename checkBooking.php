<?php


header("Content-Type: application/json; charset=UTF-8");
require "res/inc/connect.php";

function showBooking($mconn,$mregKey){

$mconn->query("lock tables registrations read");
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
	$mconn->query("unlock tables");

}

$key=$_REQUEST['key'];

showBooking($conn,$key);

?>