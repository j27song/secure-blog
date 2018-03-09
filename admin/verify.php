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
  <title>Verification</title>
  <link rel="stylesheet" href="../style/normalize.css">
  <link rel="stylesheet" href="../style/main.css">
</head>
<body>

<div id="verify">

	<h1 align="center">Verification</h1>
  	<hr align="center">
	<form action="" method="post">
	<p>Please wait for an administration approval to verify your account and log on!</p>
	</form>
	<a href="../index.php">Back to the Main Page</a>

</div>
</body>
</html>
