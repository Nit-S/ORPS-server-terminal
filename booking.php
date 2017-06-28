<?php
require "res/inc/connect.php";

$station_id="";
$vehicle_type="";

function freezeAvailablity($_station_id,$_vehicle_type,$_conn){
    $queryStation=$_conn->prepare("SELECT * from STATION_PARKING_INFO where station_id = ?");
	$queryStation->bind_param('s',$station_id);
	$queryStation->execute();
	$queryStation->bind_result(
    $row['station_id'],$row['station_name'],$row['station_class'],
    $row['tot_2w_park'],$row['avail_2w_park'],$row['occ_2w_park'],$row['res_2w_park'],
    $row['tot_4w_park'],$row['avail_4w_park'],$row['occ_4w_park'],$row['res_4w_park']
    );

	$queryStation->fetch();

	echo "UPDATE STATION_PARKING_INFO
				SET avail_2w_park=".($row['avail_2w_park']-1)."
				AND res_2w_park=".($row['res_2w_park']+1)."
				where station_id=".$_station_id;;

	if($_vehicle_type=="2w"){
		if($row['avail_2w_park']>0){
			
		}

	}elseif ($_vehicle_type=="4w") {

	}

}

freezeAvailablity("ghy","2w",$conn);




?>