<?php

header("Content-Type: application/json; charset=UTF-8");

 $station_id=$_REQUEST['stationid'];

require "res/inc/connect.php";


$conn->query("LOCK TABLES station_parking_info read");

$queryStation=$conn->prepare("SELECT * from STATION_PARKING_INFO where station_id = ?");
if($queryStation->errno){
    die('fatal error : '.$queryStation->error);
}
$queryStation->bind_param('s',$station_id);
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
    echo json_encode($row);  
}else{
echo '{"station_id":"NULL","station_name":"NULL","station_class":"NULL","tot_2w_park":"NULL","avail_2w_park":"NULL","occ_2w_park":"NULL","res_2w_park":"NULL","tot_4w_park":"NULL","avail_4w_park":"NULL","occ_4w_park":"NULL","res_4w_park":"NULL"}';

}
$queryStation->close();
    $conn->query("UNLOCK TABLES");
$conn->close();
?>

