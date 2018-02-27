<html>

<h1>Usernames</h1>

<body>
<!--
<?php
//Connecting, selecting database
$dbconn = pg_connect("host=localhost dbname=postgres user=postgres password=wlseprl1");
/*if (!$dbconn){
	echo "Error: Connection failed.\n";
} else {
	echo "Connection successful.\n";
}*/

$query = "select * from users;";
$result = pg_query($dbconn, $query);
	if (!$result){
		('Query failed: ' . pq_last_error());
	}

echo "<table border='1'>";
	echo "<tr>";
		echo "<th>Username</th>";
	echo "</tr>";
	while ($row = pg_fetch_row($result)){
	echo "<tr>";
		echo "<th>$row[0]</th>";
	echo "</tr>";
	}
echo "</table>";

pg_close($dbconn);
?>
-->

<table border="0">
<tr>
	<th>Username</th>
	<th><?php echo $_POST["un"]; ?></th>
</tr>
</table>

<table border="0">
<tr>

	<td><form action="newuser.php">
	<input type="submit" value="User registration">
	</form></td>

	<td><form action="userdetails.php">
	<input type="submit" value="Display user details">
	</form></td>

</tr>
</table>

</body>
</html>
