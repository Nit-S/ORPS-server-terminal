<?php

header("Content-Type: application/json; charset=UTF-8");
require "res/inc/connect.php";

function storeCheckin($mconn,$mregkey){
$mconn->query("lock tables registrations write ,station_parking_info write ,slot_detail write , vehicle read");
$mconn->query("START TRANSACTION");

$getRegQuery=$mconn->query("SELECT * FROM `registrations` WHERE reg_no='".$mregkey."'");
		if($mconn->errno){
	    die('fatal error : '.$conn->error);
       }
if($getRegQuery->num_rows==1){
        if($row=$getRegQuery->fetch_assoc()){
	}
	$getRegQuery->close();
	}

$mconn->query("UPDATE slot_detail set status_id ='RED' where station_id='".$row['station_id']."' and vehicle_type= (select vehicle_type from vehicle where vehicle_no='".$row['vehicle_no']."') and slot_fpno='".$row['slot_fpno']."'");

if($mconn->errno){
	die ("fatal error : ".$mconn->error);
}



$getVehicleTypeQuery=$mconn->query("select * from vehicle where vehicle_no='".$row['vehicle_no']."'");
if($getVehicleTypeQuery->errno){
	die('fatal error : '.$getVehicleTypeQuery->error);
}
if($getVehicleTypeQuery->num_rows){
	$res=$getVehicleTypeQuery->fetch_assoc();
}
if($res['vehicle_type']=="2w"){
			$_conn->query(
				"UPDATE STATION_PARKING_INFO
				SET res_2w_park=".($row['avail_2w_park']-1).",
				occ_2w_park=".($row['res_2w_park']+1)."
				WHERE station_id='".$_station_id."'"
				);
			if($_conn->errno){
				die('fatal error : '.$_conn->error);
			}
		}

	}elseif ($res['vehicle_type']=="4w") {
			$_conn->query(
				"UPDATE STATION_PARKING_INFO
				SET res_4w_park=".($row['avail_4w_park']-1).",
				occ_4w_park=".($row['res_4w_park']+1)."
				where station_id='".$_station_id."'"
				);
			if($_conn->errno){
				die('fatal error : '.$_conn->error);
			}
		}
	}







$mconn->query("UPDATE registrations set chkin_time='".date('Y-m-d H:i:s')."',  chkin_emp_userid=(SELECT emp_userid from emp where emp_work_start<'".time('Y-m-d H:i:s')."' and emp_work_end>'".time('Y-m-d H:i:s')."') WHERE reg_no='".$mregkey."' And chkin_time IS NULL");
if($mconn->errno){
	die ("fatal error : ".$mconn->error);
}
if($mconn->affected_rows){
	$mconn->query("commit");
	echo "possitive response";
}else{
	$mconn->query("rollback");
	echo "negative response";
}
$mconn->query("unlock tables");

}





$key="ghy2w100002201706301336";

storeCheckin($conn,$key);



?>