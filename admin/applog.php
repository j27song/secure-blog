<?php require_once('../includes/config.php'); 

if(isset($_GET['verifypost'])){ 
	$stmt = $db->prepare("UPDATE blog_members set verify = 't' WHERE mid = :mid") ;
	$stmt->execute(array(':mid' => $_GET['verifypost']));
	header('Location: applog.php');
	exit;
} 
?>

<!DOCTYPE html>
<html lang ="en">
<head>
  <meta charset="utf-8">
  <title>Admin - AppLog</title>
  <link rel="stylesheet" href="../style/normalize.css">
  <link rel="stylesheet" href="../style/main.css">
  <script language="JavaScript" type="text/javascript">
  function verifypost(mid, username)
  {
	  if (confirm("Are you sure you want to activate '" + username + "'"))
	  {
	  	window.location.href = 'applog.php?verifypost=' + mid;
	  }
  }
  </script>
</head>

<body>

	<div id="wrapper">
	<?php include('menu-admin.php');?>

<p>Verification Table</p>
<table>
	<tr>
		<th>Member ID</th>
		<th>Username</th>
		<th>Verify</th>
	</tr>
	<?php		

		try {
			
			$stmt = $db->query("SELECT mid, username FROM blog_members WHERE verify = 'f' ORDER by mid ASC");
			while($row = $stmt->fetch()){
				
				echo '<tr>';
				echo '<td>'.$row['mid'].'</td>';
				echo '<td>'.$row['username'].'</td>';
				?>

				<td>
					 <a href="javascript:verifypost('<?php echo $row['mid'];?>','<?php echo $row['username'];?>')">Verify</a>
				</td>
				
				<?php 
				echo '</tr>';
			}
		} catch(PDOException $e) {
		    echo $e->getMessage();
		} 
	?>
</table>

<p>Password Reset Table</p>
<table>
	<tr>
		<th>Member ID</th>
		<th>Username</th>
		<th>Reset</th>
	</tr>
	<?php		

		try {
			
			$stmt = $db->query("SELECT mid, username FROM blog_members WHERE reset = 't' ORDER by mid ASC");
			while($row = $stmt->fetch()){
				
				echo '<tr>';
				echo '<td>'.$row['mid'].'</td>';
				echo '<td>'.$row['username'].'</td>';
				?>

				<td>
					<a href="edit-user.php?id=<?php echo $row['mid'];?>">Change password</a> 
				</td>
				
				<?php 
				echo '</tr>';
			}
		} catch(PDOException $e) {
		    echo $e->getMessage();
		} 
	?>
</table>

</body>
</html>

