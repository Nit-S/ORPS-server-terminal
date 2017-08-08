<!DOCTYPE html>
<html>
<head>
	<title>Recipt</title>
	<link rel="icon" type="image/gif" href="res/img/indian-railway-logo11.png"/>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<script>

</script>
</head>

<?php
$key=$_REQUEST['key'];
$name=$_REQUEST['name'];
$number=$_REQUEST['number'];
$station=$_REQUEST['station'];
$carno=$_REQUEST['carno'];
$slot=$_REQUEST['slot'];

$chkinData=urlencode('{"key":"'.$key.'","type":"chkin"}');
$chkoutData=urlencode('{"key":"'.$key.'","type":"chkout"}');
?>

<script type="text/javascript">

</script>

<body>
<div align="center">
	<h1>Parking Recipt</h1>
	<button onclick="window.print()" >Print</button>
	<div id="data">
		<div>
			<!-- <p id="key"></p>
			<p id="name"></p>
			<p id="number"></p> -->
			<?php
				echo "<p id='key'>".$key."</p>";
				echo "<p id='name'>".$name."</p>";
				echo "<p id='number'>".$number."</p>";
			?>
		</div>
		<div>
			<!-- <p id="time"></p>
			<p id="carno"></p>
			<p id="slot"></p> -->
			<?php
				echo "<p id='station'>".$station."</p>";
				echo "<p id='carno'>".$carno."</p>";
				echo "<p id='slot'>".$slot."</p>";
			?>
		</div>
	</div>
	<div id="chkin">
		<h3>Checkin</h3>
		<?php
			echo "<img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".$chkinData."&choe=UTF-8' title='checkin' alt='checkin'/>";
		?>
	</div>
	<div id="chkout">
		<h3>Checkout</h3>
		<?php
			echo "<img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".$chkoutData."&choe=UTF-8' title='checkin' alt='checkin'/>";
		?>
	</div>
</div>
</body>
</html>

