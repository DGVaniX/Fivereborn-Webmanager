<?php
include("../inc/mysql.php");
$xcommand = $_POST['command'];
$server_key = $_POST['serverkey'];

$sql = mysqli_query($db, "select * FROM servers WHERE id = $server_key");
$serverinfo = array();
while ($row_settings = mysqli_fetch_assoc($sql))
$serverinfo[] = $row_settings;


require("q3query.class.php");

		   $con = new q3query($serverinfo[0]['ip'], $serverinfo[0]['port'], $success);
			if (!$success) {
				die ("Fehler bei der Verbindungherstellung");
			}
			$con->setRconpassword($serverinfo[0]['rconpassword']);

echo "> $xcommand</br>";

if($xcommand == 'status') {
	$rcon_status = $con->rcon("status");	
	$rcon_status = str_replace("\n", "</br>", $rcon_status);
	echo $rcon_status;
} else {
	echo $con->rcon("$xcommand");	
}
?>