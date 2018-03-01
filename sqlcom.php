<?php
//this is where all postgresql queries will be stored

//Connecting, selecting database
$dbconn = pg_connect("host=localhost dbname=postgres user=postgres password=wlseprl1");
/*if (!$dbconn){
	echo "(Error: Connection failed.)\n";
} else {
	echo "(Connection successful.)\n";





?>
