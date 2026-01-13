<?php
date_default_timezone_set('Asia/Jakarta');

$servername = "localhost";
$username = "keynafz";
$password = "SUKArendang65";
$db = "webdailyjournal";

//create connection
$conn = new mysqli($servername, $username, $password, $db);

//check connection
if($conn -> connect_error){
    die("Connection Failed : ".
    $conn -> connect_error);
}

//echo "Connected Successfully<hr>";
?>


