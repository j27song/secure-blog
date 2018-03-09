<?php require('includes/config.php'); 
if($user->is_logged_in()){ header('Location: index-logged.php'); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>

	<div id="wrapper">

		<h1>Blog</h1>

		<h1>J&J's Blog</h1>

		<ul id='adminmenu'>
		<li><a href="admin/add-user.php">Register</a></li>
		<li><a href="admin/login.php">Login</a></li>
		</ul>		
		<br/>

		<hr />

		<?php
			try {
				$stmt = $db->query('SELECT pid, ptitle, pdesc, pdate FROM blog_post ORDER BY pid DESC');
				while($row = $stmt->fetch()){
					
					echo '<div>';
						echo '<h1><a href="viewpost.php?id='.$row['pid'].'">'.$row['ptitle'].'</a></h1>';
						echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['pdate'])).'</p>';
						echo '<p>'.$row['pdesc'].'</p>';				
						echo '<p><a href="viewpost.php?id='.$row['pid'].'">Read More</a></p>';				
					echo '</div>';
				}
			} catch(PDOException $e) {
			    echo $e->getMessage();
			}
		?>

	</div>


</body>
</html>
