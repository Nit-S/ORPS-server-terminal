<?php
$_station_id="ghy";
$_vehical_type="";

require "res/inc/connect.php";



$_station_status_query=$_conn->prepare("select * from station_parking_info where station_id=?");
$_station_status_query->bind_param("s",$_station_id);

$_result=mysqli_query($_conn,$_station_status_query);

if(mysqli_num_rows($_result)>0){
	while($_row=$_result->fetch_assoc()){
        echo "station name : ".$_row["station_name"]."\n";

if($_vehical_type="2w"){
    echo "available two wheeler space : ".$_row["avail_2w_park"];

}elseif ($_vehical_type="4w") {
    echo "available four wheeler space : ".$_row["avail_4w_park"];

}
}
}else{
	echo "0 results";
}


?>