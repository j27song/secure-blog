<html>

<h1>User List</h1>

<body>

<?php 
	$username = $_POST['un']; 
	$email = $_POST['em'];
	$address = $_POST['add'];
	$phonenum = $_POST['pn'];
	$ubio = $_POST['ub'];
	
//Connecting, selecting database
$dbconn = pg_connect("host=localhost dbname=postgres user=postgres password=wlseprl1");
/*if (!$dbconn){
	echo "(Error: Connection failed.)\n";
} else {
	echo "(Connection successful.)\n";
}*/

	$un_regex = '/^[a-zA-Z]+$/';
	$em_regex = '/[\w\.\-]+@[\w\-]+\.[a-zA-Z\.]+/';
	$ad_regex = '/[a-zA-Z][0-9][a-zA-Z](\ |)[0-9][a-zA-Z][0-9]/';
	$pn_regex = '/([\-\.\(\)]|)\d\d\d([\-\.\(\)]|)\d\d\d([\-\.\(\)]|)\d\d\d\d/';

	preg_match_all($un_regex, $username, $matches1, PREG_SET_ORDER, 0);
	preg_match_all($em_regex, $email, $matches2, PREG_SET_ORDER, 0);
	preg_match_all($ad_regex, $address, $matches3, PREG_SET_ORDER, 0);
	preg_match_all($pn_regex, $phonenum, $matches4, PREG_SET_ORDER, 0);

	$query = "insert into users values ('$username','$email','$address','$phonenum','$ubio')";
	
	if (($matches1[0][0] && $matches2[0][0] && $matches3[0][0] && $matches4[0][0]) != null){
		$result = pg_query($query);
			if ($result){
				echo "Records successfully inserted.\n";
			} else {
				echo "Query failed: " . pg_last_error();
			}
	}


$query = "select * from users;";
$result = pg_query($dbconn, $query);
	if (!$result){
		('Query failed: ' . pq_last_error());
	}

echo "<table border='1'>";
	echo "<tr>";
		echo "<th>Username</th>";
		echo "<th>Email</th>";
		echo "<th>Address</th>";
		echo "<th>Phone Number</th>";
		echo "<th>User Bio</th>";
	echo "</tr>";
	while ($row = pg_fetch_row($result)){
	echo "<tr>";
		echo "<th>$row[0]</th>";
		echo "<th>$row[1]</th>";
		echo "<th>$row[2]</th>";		
		echo "<th>$row[3]</th>";
		echo "<th>$row[4]</th>";
	echo "</tr>";
	}
echo "</table>";

pg_close($dbconn);
?>

<table border="0">
<tr>
	<td>
	<form action="newuser.php">
	<input type="submit" value="User registration">
	</form>
	</td>

	<td>
	<form action="userlist.php">
	<input type="submit" value="List users">
	</form>
	</td>
</tr>
</table>

</body>
</html>
