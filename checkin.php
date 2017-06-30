<?php

header("Content-Type: application/json; charset=UTF-8");
require "res/inc/connect.php";

function storeCheckin($mconn,$mregkey){
$mconn->query("lock tables registrations write , slot_detail write , vehicle read");
if($mconn->errno){
	die ("fatal error : ".$mconn->error);
}
$mconn->query("START TRANSACTION");
if($mconn->errno){
	die ("fatal error : ".$mconn->error);
}

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





$key="ghyDL 7C 33332w100002201706301336";

storeCheckin($conn,$key);



?>