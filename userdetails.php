<html>

<h1>User List</h1>

<body>
<!--
<?php 
	$username = $_POST['un']; 
	$email = $_POST['em'];
	$password = $_POST['pw'];
	
	
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

	preg_match_all($un_regex, $username, $matches1, PREG_SET_ORDER, 0);
	preg_match_all($em_regex, $email, $matches2, PREG_SET_ORDER, 0);
	//preg_match_all($ad_regex, $password, $matches3, PREG_SET_ORDER, 0);


	$query = "insert into users values ('$username','$email','$password')";
	
	if (($matches1[0][0] && $matches2[0][0]) != null){
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
		
	echo "</tr>";
	while ($row = pg_fetch_row($result)){
	echo "<tr>";
		echo "<th>$row[0]</th>";
		echo "<th>$row[1]</th>";
		echo "<th>$row[2]</th>";		
	echo "</tr>";
	}
echo "</table>";

pg_close($dbconn);
?>
-->

<table border="0">
<tr>
	<td>Username</td>
	<td>Email</td>
	<td>Password</td>
</tr>
<tr>
	<td><?php echo $_POST["un"]; ?></td>
	<td><?php echo $_POST["em"]; ?></td>
	<td><?php echo $_POST["pw"]; ?></td>
</tr>
</table>

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
