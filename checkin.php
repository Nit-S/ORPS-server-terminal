<?php

header("Content-Type: application/json; charset=UTF-8");
require "res/inc/connect.php";

function storeCheckin($mconn,$mregkey){
$mconn->query("lock tables registrations write");
$mconn->query("UPDATE registrations set chkin_time='".date('Y-m-d H:i:s')."',  chkin_emp_userid=(SELECT emp_userid from emp where emp_work_start<'".time('Y-m-d H:i:s')."' and emp_work_end>'".time('Y-m-d H:i:s')."') WHERE reg_no='".$mregkey."' And chkin_time IS NULL");
if($mconn->errno){
	die ("fatal error : ".$mconn->error);
}
if($mconn->affected_rows){
	echo "possitive response";
}else{
	echo "negative response";
}
$mconn->query("unlock tables");
$

}





$key="ghyDL 7C 33332w100003201706301115";



storeCheckin($conn,$key);



?>