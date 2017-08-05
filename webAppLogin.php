<?php

require "res/inc/connect.php";

$stationid=$_REQUEST['stationid'];
$empid=$_REQUEST['empid'];
$emppw=$_REQUEST['emppw'];

$result=$conn->query("select * from emp where emp_station='".$stationid."' and emp_userid='".$empid."' and emp_password='".$emppw."'");
if($conn->errno){
	echo "Fatlal error : ".$conn->error;
}
if($result->num_rows){
	echo "pass";
}else{
	echo "fail";
}

?> 