<?php //include config
require_once('../includes/config.php');
//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Edit Post</title>
  <link rel="stylesheet" href="../style/normalize.css">
  <link rel="stylesheet" href="../style/main.css">
  <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
  <script>
          tinymce.init({
              selector: "textarea",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });
  </script>
</head>
<body>

<div id="wrapper">

	<?php include('menu.php');?>
	<p><a href="./">Blog Admin Index</a></p>

	<h2>Edit Post</h2>


	<?php
	//if form has been submitted process it
	if(isset($_POST['submit'])){
		$_POST = array_map( 'stripslashes', $_POST );
		//collect form data
		extract($_POST);
		//very basic validation
		if($pID ==''){
			$error[] = 'This post is missing a valid id!.';
		}
		if($pTitle ==''){
			$error[] = 'Please enter the title.';
		}
		if($pDesc ==''){
			$error[] = 'Please enter the description.';
		}
		if($pCont ==''){
			$error[] = 'Please enter the content.';
		}
		if(!isset($error)){
			try {
				//insert into database
				$stmt = $db->prepare('UPDATE blog_post SET pTitle = :pTitle, pDesc = :pDesc, pCont = :pCont WHERE pID = :pID') ;
				$stmt->execute(array(
					':pTitle' => $pTitle,
					':pDesc' => $pDesc,
					':pCont' => $pCont,
					':pID' => $pID
				));
				//redirect to index page
				header('Location: index.php?action=updated');
				exit;
			} catch(PDOException $e) {
			    echo $e->getMessage();
			}
		}
	}
	?>


	<?php
	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo $error.'<br />';
		}
	}
		try {
			$stmt = $db->prepare('SELECT pID, pTitle, pDesc, pCont FROM blog_post WHERE pID = :pID') ;
			$stmt->execute(array(':pID' => $_GET['id']));
			$row = $stmt->fetch(); 
		} catch(PDOException $e) {
		    echo $e->getMessage();
		}
	?>

	<form action='' method='post'>
		<input type='hidden' name='pID' value='<?php echo $row['pID'];?>'>

		<p><label>Title</label><br />
		<input type='text' name='pTitle' value='<?php echo $row['pTitle'];?>'></p>

		<p><label>Description</label><br />
		<textarea name='pDesc' cols='60' rows='10'><?php echo $row['pDesc'];?></textarea></p>

		<p><label>Content</label><br />
		<textarea name='pCont' cols='60' rows='10'><?php echo $row['pCont'];?></textarea></p>

		<p><input type='submit' name='submit' value='Update'></p>

	</form>

</div>

</body>
</html> 
