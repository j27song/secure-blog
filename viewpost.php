<?php require('includes/config.php'); 
$stmt = $db->prepare('SELECT pID, pTitle, pCont, pDate FROM blog_post WHERE pID = :pID');
$stmt->execute(array(':postID' => $_GET['id']));
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
    <title>Blog - <?php echo $row['postTitle'];?></title>
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
				echo '<h1>'.$row['pTitle'].'</h1>';
				echo '<p>Posted on '.date('jS M Y', strtotime($row['pDate'])).'</p>';
				echo '<p>'.$row['pCont'].'</p>';				
			echo '</div>';
		?>

	</div>

</body>
</html>
