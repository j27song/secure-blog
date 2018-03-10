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

		</ul>		
		<br/>

		<hr />

		<?php
			try {
			
			$stmt = $db->query('select mid, username, email, prof_image from blog_members');
			$row = $stmt->fetch();
			echo '<p>Email:'.$row['email'].'</p>';
			
			$ifile = glob("images/*.*");
			$va = strcmp("images/bear_avatar.png","images/$row['prof_image']");
			echo $va;
			for ($i=0; $i<count($ifile); $i++){
				$im = $ifile[$i];
				//if($im === images/$row['prof_image']){
					//$im0 = $im;
				//}
			}
			echo '<img src="'.$im.'" alt="an_avatar"/>'."<br />";
			/*
				while($row){
					echo '<div>';
						
						echo '<img src="'.$im.'" alt="avatar"/>'.'<br />';
						echo '<p>Username:'.$row['username'].'</p>';
						echo '<p>Email:'.$row['email'].'</p>';
						
						
					echo '</div>';
				}
			*/
			} catch(PDOException $e) {
			    echo $e->getMessage();
			}
		?>

	</div>


</body>
</html>
