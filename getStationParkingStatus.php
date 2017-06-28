<?php

header("Content-Type: application/json; charset=UTF-8");

$station_id="ghy";

require "res/inc/connect.php";

$queryStation=$conn->prepare("SELECT * from STATION_PARKING_INFO where station_id = ?");
$queryStation->bind_param('s',$station_id);
$queryStation->execute();
$queryStation->bind_result(
    $row['station_id'],$row['station_name'],$row['station_class'],
    $row['tot_2w_park'],$row['avail_2w_park'],$row['occ_2w_park'],$row['res_2w_park'],
    $row['tot_4w_park'],$row['avail_4w_park'],$row['occ_4w_park'],$row['res_4w_park']
    );

while($queryStation->fetch()){
    echo json_encode($row);  
}
?>

