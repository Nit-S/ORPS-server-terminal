<?php
$_server="localhost";
$_username="root";
$_password="";
$_database="maituts";

$_conn = new mysqli($_server, $_username, $_password, $_database);

// Check connection
if ($_conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>