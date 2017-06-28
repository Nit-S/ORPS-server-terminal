<?php
header("Content-Type: application/json; charset=UTF-8");
require "res/inc/connect.php";

$station_id="ghy";
$vehicle_type="2w";

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



function getRegistration(){
	
}

?>
