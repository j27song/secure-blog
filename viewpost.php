<?php require('includes/config.php'); 
$stmt = $db->prepare('SELECT pid, ptitle, pcont, pdate FROM blog_post WHERE pid = :pid');
$stmt->execute(array(':pID' => $_GET['id']));
$row = $stmt->fetch();
//if post does not exists redirect user.
if($row['pID'] == ''){
	header('Location: ./');
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog - <?php echo $row['ptitle'];?></title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>

	<div id="wrapper">

		<h1>Blog</h1>
		<hr />
		<p><a href="./">Blog Index</a></p>


		<?php	
			echo '<div>';
				echo '<h1>'.$row['ptitle'].'</h1>';
				echo '<p>Posted on '.date('jS M Y', strtotime($row['pdate'])).'</p>';
				echo '<p>'.$row['pcont'].'</p>';				
			echo '</div>';
		?>

	</div>

</body>
</html>
