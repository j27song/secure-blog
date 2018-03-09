<?php require('includes/config.php'); 
//$stmt = $db->prepare('SELECT pid, ptitle, pcont, pdate FROM blog_post WHERE pid = :pid');

$stmt = $db->prepare('select blog_post.pid, blog_post.ptitle, blog_post.pdesc, blog_post.pcont, blog_post.pdate, blog_members.username, blog_members.email from blog_post inner join blog_members on blog_post.mid=blog_members.mid where pid = :pid');

$stmt->execute(array(':pid' => $_GET['id']));
$row = $stmt->fetch();



//if post does not exists redirect user.
if($row['pid'] == ''){
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
				echo '<p>By:'.$row['username'].' ('.$row['email'].')</p>';
				echo '<p>Posted on '.date('jS M Y', strtotime($row['pdate'])).'</p>';
				echo '<p>'.$row['pcont'].'</p>';				
			echo '</div>';
		?>

	</div>

</body>
</html>
