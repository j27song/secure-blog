<?php
//to add a post to the blog
if (!empty ($_POST)){
	include 'sqlcom.php';
	$pt = $_POST['title'];
	$pb = $_POST['body'];
	$da = date("d-m-Y");
	//echo "\n" .$pt. " " .$pb. " " .$da. "\n";
	//('$pt', '$pb', '$da')");
	$query = pg_query("insert into blog_posts (ptitle, pbody, pdate) values ('$pt', '$pb', '$da')");
	if ($query){
		echo "Post added successfully.";
	} else {
		echo "Query failed: " . pg_last_error();
	}
}

?>

<form method="POST">
	<table border="0">
		<tr>
			<td><label for="title">Title</label></td>
			<td><input name="title" id="title"/></td>
		</tr>
		<tr>
			<td><label for="body">Body</label></td>
			<td><textarea name="body"></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="Post"/></td>
		</tr>
	</table>
</form>
