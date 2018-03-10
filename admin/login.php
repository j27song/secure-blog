<?php
//include config
require_once('../includes/config.php');
//check if already logged in
//if( $user->is_logged_in() ){ header('Location: index.php'); } 
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="../style/normalize.css">
  <link rel="stylesheet" href="../style/main.css">
</head>
<body>

<div id="login">

	<?php
	//process login form if submitted
	if(isset($_POST['submit'])){
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
		$stmt = $db->query("SELECT verify FROM blog_members where username = '$username'");
		$row = $stmt->fetch();
		$verify = $row['verify'];
		
		if(!$verify){
			header('Location: verify.php');
			exit;
		} 
		
		if($user->login($username,$password)){ 
			//logged in return to index page
			header('Location: index.php');
			exit;
		
		} else {
			$message = '<p class="error">Wrong username or password</p>';
		}
	}//end if submit
	if(isset($message)){ echo $message; }
	?>
	
	<h1 align="center">Login Page</h1>
  	<hr align="center">
	<form action="" method="post">
	<p><label>Username</label><input type="text" name="username" value=""  /></p>
	<p><label>Password</label><input type="password" name="password" value=""  /></p>
	<p><label></label><input type="submit" name="submit" value="Login"  /></p>
	</form>
	<a href="reset.php">Forgot Password</a></br>
	<a href="../index.php">Back to the Main Page</a>

</div>
</body>
</html>
