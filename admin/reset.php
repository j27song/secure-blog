<?php //include config
require_once('../includes/config.php');

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="../style/normalize.css">
  <link rel="stylesheet" href="../style/main.css">
</head>
<body>

<div id="wrapper">

	<h1>J&J's Blog</h1>	
	<ul id='adminmenu'>
	<li><a href='admin/index.php'>Blog Management</a></li>
	<li><a href='admin/logout.php'>Logout</a></li>
	</ul>
	<br/>
	<hr />		

	<h2>Forgot password</h2>
	
	<?php
	if(isset($_POST['submit'])){
		//collect form data
		extract($_POST);
		//very basic validation
		if($username ==''){
			$error[] = 'Please enter the username.';
		}

		if(!isset($error)){
			try {
				//insert into database
				$stmt = $db->prepare("UPDATE blog_members set reset = 't' WHERE username = '$username'");
				$stmt->execute(array(
				));
				//redirect to index page
				//header('Location: users.php?action=added');
				header('Location: verify.php?action=added');
				exit;
			} catch(PDOException $e) {
			    echo $e->getMessage();
			}
		}
	}
	?>
	
	<form action='' method='post'>
		<p><label>Username</label><br />
		<input type='text' name='username' value='<?php if(isset($error)){ echo $_POST['username'];}?>'></p>
		<p><input type='submit' name='submit' value='Submit'></p>

	</form> 

</div>

</body>
</html> 
