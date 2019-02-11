<!DOCTYPE html>
<?php
	require_once('classes/classes.php');
	require_once('globalFunctions.php');

	function loadListPosts() {

		$posts = returnAllPosts();
		$numberOfPosts = count($posts);

		echo '<table id="listPostsTable">';
			echo "<tr>";
				echo "<th>Title</th>";
				echo "<th>Author</th>";
				echo "<th>Date</th>";
				echo "<th></th>";
			echo "</tr>";

		for ($i=($numberOfPosts-1); $i>=0; $i--) {
			$auxPost = $posts[$i];
			echo "<tr>";
				echo "<td>".$auxPost->title."</td>";
				echo "<td>".$auxPost->author->userId."</td>";
				echo "<td>".$auxPost->dateTime."</td>";
				echo "<td style='text-align: center;'>
					<a href='management.php?postId=".$auxPost->postId."'><span style='color: black;' class='glyphicon glyphicon-pencil'></span></a>
					<a href='listPosts.php?delete=".$auxPost->postId."'><span style='color: black;' class='glyphicon glyphicon-trash'></span></a>
					</td>";
			echo "</tr>";
		}
	}

	if (!empty($_GET) && isset($_GET['delete'])) {
		$postId = $_GET['delete'];
		deletePostById($postId);
	}
 ?>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<?php
			require_once('header.php');
			require_once('nav.php');
		?>
		<main>
			<div id="articleMain1" class="col-sm-11 col-xs-1">
				<?php loadListPosts(); ?>
			</div>
		</main>
	</body>
</html>
