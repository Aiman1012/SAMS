<?php
$db =  "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521)) (CONNECT_DATA =  (SID = XE)))";


$conn = oci_pconnect("erekod", "erekod", $db);
// $conn = oci_connect("up_portal", "up_portal", "oracleserver:1521/xe");



if (!$conn) {
	// connection failed
	// as we don't have a connection yet the error is stored in the
	// module global error-handle
	$err = oci_error();
	echo htmlentities($err['message']);
	//if ($err[ "code" ] == "12545") {
	//	echo "target host or object does not exist\n";
	//}
	die();
} else {
	echo 'ok';
}
