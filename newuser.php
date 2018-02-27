<html>

<h1>User Registration</h1>

<body>


<form action="userdetails.php" method="POST">
	Username: <br><input type="text" name="un"><br>
	Email: <br><input type="email" name="em"><br>
	Address: <br><input type="text" name="add"><br>
	Phone Number: <br><input type="text" name="pn"><br>
	User bio: <br><input type="text" name="ub"><br>
	<br><input type="submit" value="Create user">
</form>


<table border="0">
<tr>
	<!--<td><form action="userdetails.php">
	<input type="submit" value="Create/View user">
	</form></td>-->
	<td><form action="userlist.php">
	<input type="submit" value="List users">
	</form></td>
</tr>
</table>

</body>
</html>


