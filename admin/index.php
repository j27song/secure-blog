<?php
//include config
require_once('../includes/config.php');
//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
//show message from add / edit page
if(isset($_GET['delpost'])){ 
	$stmt = $db->prepare('DELETE FROM blog_post WHERE pid = :pid') ;
	$stmt->execute(array(':pid' => $_GET['delpost']));
	header('Location: index.php?action=deleted');
	exit;
} 
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin</title>
  <link rel="stylesheet" href="../style/normalize.css">
  <link rel="stylesheet" href="../style/main.css">
  <script language="JavaScript" type="text/javascript">
  function delpost(id, title)
  {
	  if (confirm("Are you sure you want to delete '" + title + "'"))
	  {
	  	window.location.href = 'index.php?delpost=' + id;
	  }
  }
  </script>
</head>
<body>

	<div id="wrapper">

	<?php include('menu.php');?>

	<?php
	//show message from add / edit page
	if(isset($_GET['action'])){ 
		echo '<h3>Post '.$_GET['action'].'.</h3>'; 
	} 
	?>

	<table>
	<tr>
		<th>Title</th>
		<th>Date</th>
		<th>Action</th>
	</tr>
	<?php		
	
	$username = $_SESSION['username'];
	//echo "This is a test, the username name is $username"

	$stmt = $db->query("SELECT mid FROM blog_members where username = '$username'");
	$row = $stmt->fetch();
	$id = $row['mid'];
	//echo "The member id is $id"; 	
		try {
			
			$stmt = $db->query("SELECT pid, ptitle, pdate FROM blog_post WHERE mid = '$id' ORDER BY pid DESC");
			while($row = $stmt->fetch()){
				
				echo '<tr>';
				echo '<td>'.$row['ptitle'].'</td>';
				echo '<td>'.date('jS M Y', strtotime($row['pdate'])).'</td>';
				?>

				<td>
					<a href="edit-post.php?id=<?php echo $row['pid'];?>">Edit</a> | 
					<a href="javascript:delpost('<?php echo $row['pid'];?>','<?php echo $row['ptitle'];?>')">Delete</a>
				</td>
				
				<?php 
				echo '</tr>';
			}
		} catch(PDOException $e) {
		    echo $e->getMessage();
		}
	?>
	</table>

	<p><a href='add-post.php'>Add Post</a></p>

</div>

</body>
</html>
