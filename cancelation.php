<?php

header("Content-Type: application/json; charset=UTF-8");
require "res/inc/connect.php";

function storeCheckout($mconn,$mregkey){
$mconn->query("lock tables registrations write ,station_parking_info write ,slot_detail write , vehicle read");
$mconn->query("START TRANSACTION");

$getRegQuery=$mconn->query("SELECT * FROM `registrations` WHERE reg_no='".$mregkey."'");
		if($mconn->errno){
	    die('fatal error : '.$conn->error);
       }
if($getRegQuery->num_rows==1){
        if($row=$getRegQuery->fetch_assoc()){
        	// check something to do after reciving the details...
	}
	$getRegQuery->close();
	}

$mconn->query("UPDATE slot_detail set status_id ='GREEN' where station_id='".$row['station_id']."' and vehicle_type= (select vehicle_type from vehicle where vehicle_no='".$row['vehicle_no']."') and slot_fpno='".$row['slot_fpno']."'");

if($mconn->errno){
	die ("fatal error : ".$mconn->error);
}



$getVehicleTypeQuery=$mconn->query("select * from vehicle where vehicle_no='".$row['vehicle_no']."'");

if($mconn->errno){
	die('fatal error : '.$mconn->error);
}
if($getVehicleTypeQuery->num_rows){
	$res=$getVehicleTypeQuery->fetch_assoc();
}


if($res['vehicle_type']=="2w"){
			$mconn->query(
				// debug error take ststion psrking info and use in a variablke other than row

				"UPDATE STATION_PARKING_INFO
				SET res_2w_park = res_2w_park - 1,
				avail_2w_park = avail_2w_park + 1
				WHERE station_id='".$row['station_id']."'"
				);
			if($mconn->errno){
				die('fatal error : '.$mconn->error);
			}
		}elseif ($res['vehicle_type']=="4w") {
			$mconn->query(
				"UPDATE STATION_PARKING_INFO
				SET res_4w_park = res_4w_park - 1,
				avail_4w_park = avail_4w_park + 1
				where station_id='".$row['station_id']."'"
				);
			if($mconn->errno){
				die('fatal error : '.$mconn->error);
			}
		}


$mconn->query("UPDATE registrations set chkout_time='".date('Y-m-d H:i:s')."', commit_status ='canceled'  WHERE reg_no='".$mregkey."' And chkout_time IS NULL and commit_status ='initialised'");

if($mconn->errno){
	die ("fatal error : ".$mconn->error);
}
if($mconn->affected_rows){
	$mconn->query("commit");
	echo "positive";
}else{
	$mconn->query("rollback");
	echo "negative";
}
$mconn->query("unlock tables");

}


 $key=$_REQUEST['key'];


storeCheckout($conn,$key);



?>