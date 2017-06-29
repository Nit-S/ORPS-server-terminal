<?php
header("Content-Type: application/json; charset=UTF-8");
require "res/inc/connect.php";



// this function takes in station id and vehical tpe and frezes a spot as booked in the server

function freezeAvailablity($_conn,$_station_id,$_vehicle_type){
    $queryStation=$_conn->prepare("SELECT * from STATION_PARKING_INFO where station_id = ?");
    if($queryStation->errno){
    die('fatal error : '.$queryStation->error);
}
	$queryStation->bind_param('s',$_station_id);
	if($queryStation->errno){
    die('fatal error : '.$queryStation->error);
}
	
	$queryStation->execute();
	if($queryStation->errno){
    die('fatal error : '.$queryStation->error);
}
	$queryStation->bind_result(
    $row['station_id'],$row['station_name'],$row['station_class'],
    $row['tot_2w_park'],$row['avail_2w_park'],$row['occ_2w_park'],$row['res_2w_park'],
    $row['tot_4w_park'],$row['avail_4w_park'],$row['occ_4w_park'],$row['res_4w_park']
    );
    
	if($queryStation->errno){
    die('fatal error : '.$queryStation->error);
}
	if($queryStation->fetch()){
		$queryStation->close();

	if($_vehicle_type=="2w"){
		if($row['avail_2w_park']>0){
			$_conn->query(
				"UPDATE STATION_PARKING_INFO
				SET avail_2w_park=".($row['avail_2w_park']-1).",
				res_2w_park=".($row['res_2w_park']+1)."
				WHERE station_id='".$_station_id."'"
				);
			if($_conn->errno){
				die('fatal error : '.$_conn->error);
			}
			return true;
		}else{
			return false;
		}

	}elseif ($_vehicle_type=="4w") {
		if($row['avail_4w_park']>0){
			$_conn->query(
				"UPDATE STATION_PARKING_INFO
				SET avail_4w_park=".($row['avail_4w_park']-1).",
				res_4w_park=".($row['res_4w_park']+1)."
				where station_id='".$_station_id."'"
				);
			if($_conn->errno){
				die('fatal error : '.$_conn->error);
			}
			return true;
		}else{
			return false;
		}
	}
}

}


function actualSlotBook($_conn,$_station_id,$_vehicle_type){
	$slotQuery=$_conn->prepare(
		"SELECT * from slot_detail 
		Where station_id=? AND vehicle_type=? AND status_id='green' 
		ORDER BY slot_fpno ASC LIMIT 1"
		);

	if($slotQuery->errno){
    die('fatal error : '.$slotQuery->error);
}

$slotQuery->bind_param('ss',$_station_id,$_vehicle_type);
	
	if($slotQuery->errno){
    die('fatal error : '.$slotQuery->error);
}

$slotQuery->execute();

	if($slotQuery->errno){
    die('fatal error : '.$slotQuery->error);
}

$slotQuery->bind_result($row['station_id'],
	$row['vehicle_type'],
	$row['slot_fpno'],
	$row['slot_status']
	);

	if($slotQuery->errno){
    die('fatal error : '.$slotQuery->error);
}
$slotQuery->fetch();
$slotQuery->close();

$_conn->query(
	"UPDATE slot_detail SET status_id='yellow'
	 WHERE station_id = '".$row['station_id']."' AND vehicle_type = '".$row['vehicle_type']."' AND slot_fpno = '".$row['slot_fpno']."'"
	);
	if($_conn->errno){
    die('fatal error : '.$_conn->error);
}
if($_conn->affected_rows){
	return $row;
}
}



function storeVehicle($mconn,$mvehicleNo,$mvehicleType,$mvehicleName,$mvehicleColor){
$insVehicleQuery=$mconn->prepare("INSERT INTO vehicle values(?,?,?,?)");
if($insVehicleQuery->errno){
	 die('fatal error : '.$insVehicleQuery->error);
}
$insVehicleQuery->bind_param('ssss',$mvehicleNo,$mvehicleType,$mvehicleName,$mvehicleColor);
if($insVehicleQuery->errno){
	 die('fatal error : '.$insVehicleQuery->error);
}
$insVehicleQuery->execute();
if($insVehicleQuery->errno){
	 die('fatal error : '.$insVehicleQuery->error);
}
$insVehicleQuery->close();
}


function getRegistration($mconn,$mcustName,$mcustNumber,$mcustEmail,$mvehicleNo,$mvehicleType,$mvehicleName,$mvehicleColor,$mstationId){
 storeVehicle($mconn,$mvehicleNo,$mvehicleType,$mvehicleName,$mvehicleColor);

if(freezeAvailablity($mconn,$mstationId,$mvehicleType)){
	$slotDetails=actualSlotBook($mconn,$mstationId,$mvehicleType);
	if($slotDetails==array()){
		echo "negative returns";
	}else{
		$regNo=$mstationId.$mvehicleNo.$mvehicleType.$slotDetails['slot_fpno'].date('YmdHi');

		$registerQuery=$mconn->prepare("INSERT INTO registrations (reg_no,	cust_name,cust_number,cust_email,vehicle_no,station_id,slot_fpno) VALUES(?,?,?,?,?,?,?)");

		if($registerQuery->errno){
	    die('fatal error : '.$registerQuery->error);
       }
  		$registerQuery->bind_param(
			'ssisssi',
			$regNo,
			$mcustName,
			$mcustNumber,
			$mcustEmail,
			$mvehicleNo,
			$mstationId,
			$slotDetails['slot_fpno']
			);
  		if($registerQuery->errno){
	    die('fatal error : '.$registerQuery->error);
       }
		$registerQuery->execute();
				if($registerQuery->errno){
	    die('fatal error : '.$registerQuery->error);
       }
		$registerQuery->close();
		return $regNo;
}
}
else {
	return false;
}
}












$station_id="ghy";
$vehicle_type="2w";









$conn->query("LOCK TABLES registrations write , slot_detail write , station_ parking_info write");
$conn->query("START TRANSACTION");

$key= getRegistration($conn,"sakshi shrivastav",9899643241,"Cnitigya.sharma12@gmail.com","DL7C3333",$vehicle_type,"tuv 500","matt black",$station_id);

if($key){
	$conn->query("commit");
	echo "possitive response";
}else{
	$conn->query("rollback");
	echo "negative response";
}
$conn->query("UNLOCK TABLES");



$conn->query("LOCK TABLES registrations read");
$getRegQuery=$conn->query("SELECT * FROM `registrations` WHERE reg_no='".$key."'");
		if($conn->errno){
	    die('fatal error : '.$conn->error);
       }
       $conn->query("UNLOCK TABLES");
if($getRegQuery->num_rows==1){
        if($row=$getRegQuery->fetch_assoc()){
		echo json_encode($row);
	}
	$getRegQuery->close();
	}

?>
