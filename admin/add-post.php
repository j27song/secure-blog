<?php //include config
require_once('../includes/config.php');
//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Add Post</title>
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

	<h2>Add Post</h2>

	<?php
	//if form has been submitted process it
	if(isset($_POST['submit'])){
		$_POST = array_map( 'stripslashes', $_POST );
		//collect form data
		extract($_POST);
		//very basic validation
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
				$stmt = $db->prepare('INSERT INTO blog_post (pTitle,pDesc,pCont,pDate) VALUES (:pTitle, :pDesc, :pCont, :pDate)') ;
				$stmt->execute(array(
					':pTitle' => $pTitle,
					':pDesc' => $pDesc,
					':pCont' => $pCont,
					':pDate' => date('Y-m-d H:i:s')
				));
				//redirect to index page
				header('Location: index.php?action=added');
				exit;
			} catch(PDOException $e) {
			    echo $e->getMessage();
			}
		}
	}
	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo '<p class="error">'.$error.'</p>';
		}
	}
	?>

	<form action='' method='post'>

		<p><label>Title</label><br />
		<input type='text' name='pTitle' value='<?php if(isset($error)){ echo $_POST['pTitle'];}?>'></p>

		<p><label>Description</label><br />
		<textarea name='pDesc' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['pDesc'];}?></textarea></p>

		<p><label>Content</label><br />
		<textarea name='pCont' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['pCont'];}?></textarea></p>

		<p><input type='submit' name='submit' value='Submit'></p>

	</form>

</div>
