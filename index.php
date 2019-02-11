<!DOCTYPE html>
<?php
	header('Content-Type: text/html; charset=utf-8');

	$pages=null;
	$links=null;
	$postId=null;

	require_once('php/globalFunctions.php');

	//Evitamos que salgan errores por variables vacías
	error_reporting(E_ALL ^ E_NOTICE);

	function loadFullPost($postId) {
		$auxPost = returnPostById($postId);
		$user = createUserById($_SESSION['user']['userId']);
		echo "<section class='textBox'>";
		if (!empty($_SESSION) && isset($_SESSION['user'])) {
			$isFavourite = $user->isAFavouritePost($postId);

			echo "<form method='post' action=''>";
			echo "<input type='hidden' name='postIdFavourite' value='$postId'>";
				if (!$isFavourite) {
					echo "<div style='text-align: right'>";
					echo "<br/> <input type='image' src='images/no-favourite.png' width='40px' height='40px' alt='Submit Form' />";
					echo "</div>";
				} else {
					echo "<div style='text-align: right'>";
					echo "<br/> <input type='image' width='40px' height='40px' src='images/favourite.png' alt='Submit Form' />";
					echo "</div>";
				}
			echo "</form>";
		}

		echo "<h2>$auxPost->title</h2>";
		$content = $auxPost->content;
		$content = nl2br($content);
		echo "<p>$content</p>";
		if ($auxPost->image==null) {
			echo "<img align='center' id='postImage' src='images/default.jpeg'>";

		} else {
			echo "<img align='center' id='postImage' src='$auxPost->image'>";
		}





		if (isset($_SESSION['user'])) {
			echo "<h2>Comments</h4>";
			echo "<div id='comment'>";
			echo    '<form method="post" action="">';
				echo '<label for="userName">';
					echo "<input style='border: 0; background: lightgray;' size='49%' type='text' value ='".$_SESSION['user']['name']."' readonly>";
				echo '<label/> <br/>';

				echo '<label for="content">';
					echo "<textarea style='overflow: hidden; resize: vertical;' rows='7' cols='50' type='textArea' name='content' id='text' placeholder='Comment...'></textArea>";
				echo '</label> <br/> <br/>';

				echo "<input type='hidden' name='postId' value='$postId'>";
				echo '<input type="submit" value="Enviar">';
			echo '</form>';
			echo "</div>";
		}
		$comments = returnCommentsByPostId($postId);
		if (isset($_GET['page'])) $page = $_GET['page'];
		else $page = 1;
		loadComments($comments, $page);
		echo "<br/>";
		loadCommentsLinks($comments);

		echo "</section>";
	}

	function loadComments($comments, $page) {
		if (count($comments)>0 && !isset($_SESSION['user'])) {
			echo "<h2>Comments</h4>";
		}
		if ($page==1) {
			$start=0;

		} else {
			$start = 5*($page-1);
		}

		$counter=0;

		for ($i=$start; $i<count($comments); $i++) {
			$counter++;
		}
		if ($counter<=5) $end = count($comments);
		else $end = $start + 5;

		for ($i=$start; $i<$end; $i++) {
			echo "<div id='comment'>";
				$auxComment = $comments[$i];
				echo $auxComment->author->name." | ";
				echo $auxComment->dateTime;
				echo "<br/> <br/>";
				echo "<p>".$auxComment->content."</p>";
			echo "</div>";
		}
	}

	function loadLinks($posts) {
		$amountPostsShowByPage = 5;
		$postsAmount = count($posts);
		$pages = ceil($postsAmount / $amountPostsShowByPage);

		if ($pages>1) {
			for ($i=1; $i<=$pages; $i++) {
				if ($i==1) $links .= "<a href='index.php?page=$i'> | $i | </a>";
				else $links .= "<a href='index.php?page=$i'> $i | </a>";
			}
			echo "<div style='text-align:center'>";
				echo $links;
			echo "</div>";
		}
	}

	function loadCommentsLinks($comments) {
		$amountCommentsShowByPage = 5;
		$commentsAmount = count($comments);
		$pages = ceil($commentsAmount / $amountCommentsShowByPage);

		if ($pages>1) {
			for ($i=1; $i<=$pages; $i++) {
				if ($i==1) $links .= "<a href='index.php?postId=".$_GET['postId']."&page=$i'> | $i | </a>";
				else $links .= "<a href='index.php?postId=".$_GET['postId']."&page=$i'> $i | </a>";
			}
			echo "<div style='text-align:center'>";
				echo $links;
			echo "</div>";
		}
	}


	function loadPosts($posts, $page) {

		if ($page==1) {
			$start=0;

		} else {
			$start = 5*($page-1);
		}

		$counter=0;
		for ($i=$start; $i<count($posts); $i++) {
			$counter++;
		}
		if ($counter<=5) $end = count($posts);
		else $end = $start + 5;

		for ($i=$start; $i<$end; $i++) {
			echo "<section class='container-fluid'>";
				echo "<div class='col-sm-9 col-xs-4 textBox'>";
					$auxPost = $posts[$i];
					echo "<h2>$auxPost->title</h2>";
					$firstParagraph = explode("\n", $auxPost->content);
					echo $firstParagraph[0];
					echo "<br/> <br/><a href='index.php?postId=$auxPost->postId'>Read more</a><br/> <br/>";

					echo $auxPost->dateTime;
				echo "</div>";

				echo "<div class='col-sm-3 col-xs-4'>";
					if (!empty($_SESSION) && isset($_SESSION['user'])) {
						$postId = $auxPost->postId;
						$userId = $_SESSION['user']['userId'];
						$user = createUserById($userId);
						$isFavourite = $user->isAFavouritePost($postId);

						echo "<form method='post' action=''>";
						echo "<input type='hidden' name='postIdFavourite' value='$postId'>";
							if (!$isFavourite) {
								echo "<div style='text-align: right'>";
								echo "<br/> <input type='image' src='images/no-favourite.png' width='40px' height='40px' alt='Submit Form' />";
								echo "</div>";
							} else {
								echo "<div style='text-align: right'>";
								echo "<br/> <input type='image' width='40px' height='40px' src='images/favourite.png' alt='Submit Form' />";
								echo "</div>";
							}
						echo "</form>";
					}
					if ($auxPost->image==null) {
						echo "<img id='postCover' src='images/default.jpeg'>";

					} else {
						echo "<img id='postCover' src='$auxPost->image'>";
					}
				echo "</div>";
				echo "</section>";
			}
		}

	if (isset($_SESSION['user']) && !empty($_POST) && isset($_POST['content'])) {
		$commentId = generateCommentId();
		$userId = $_SESSION['user']['userId'];
		$author = createUserById($userId);
		$dateTime = date("Y-m-d H:i:S");
		$content = $_POST['content'];
		$post = $_SESSION['postId'];

		$comment = new Comment($commentId, $post, $dateTime, $author, $content);
		$right = createComment($comment);
		if (!$right) echo "The comment could not be created";
	}

	if (!empty($_POST) && isset($_POST['postIdFavourite'])) {
		$postId = $_POST['postIdFavourite'];
		$userId = $_SESSION['user']['userId'];
		$user = createUserById($userId);

		$isFavourite = $user->isAFavouritePost($postId);

		if (!$isFavourite) {
			$user->favouritesPosts .= $postId.",";
		} else {
			$favouritesPosts = $user->favouritesPosts;
			$auxPostId = $postId.",";
			$favouritesPosts = str_replace($auxPostId,"",$favouritesPosts);
			$user->favouritesPosts = $favouritesPosts;
		}
		updateUser($user);
	}



 ?>

<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title></title>
		<style>
			@import url("styles/bootstrap/css/bootstrap.min.css");
			@import url("styles/main.css");
		</style>
		<script src="js/nav.js"></script>
		<!--<script src="js/jquery-3.3.1.min.js"></script>-->
		<script src="styles/bootstrap/js/jquery.min.js"></script>
		<?xml version="1.0" encoding="UTF-8"?>
	</head>

	<body>
		<?php
			require_once('php/header.php');
			require_once('php/nav.php');

			/*$now = new DateTime();
			$dateTime = $now->format('Y-m-d H:i:s');
			$path = $now->format("Y")."/".$now->format('F');
			echo $path;*/
		?>

		<main class="row">
			<?php require_once('php/aside.php');?>

			<div id="articleMain1" class="col-sm-9 col-xs-11">
				<?php

				if (!empty($_GET) && isset($_GET['year']) && !isset($_GET['month'])) {
					$year = $_GET['year'];
					$posts = returnPostByYear($year);

					echo "<h2>Posts</h2>";
					if (isset($_GET['page'])) $page = $_GET['page'];
					else $page=1;
					if (count($posts) > 1) {
						loadPosts($posts, $page);
						loadLinks($posts);
					} else {
						$_SESSION['postId'] = $posts[0]->postId;
						loadFullPost($_SESSION['postId']);
					}

				} else if (!empty($_GET) && isset($_GET['year']) && isset($_GET['month'])) {
					$year = $_GET['year'];
					$month = $_GET['month'];
					$posts = returnPostByYearAndMonth($year, $month);

					$dateObj   = DateTime::createFromFormat('!m', $month);
					$auxMonthName = $dateObj->format('F');
					echo "<h2>$auxMonthName Posts</h2>";
					if (isset($_GET['page'])) $page = $_GET['page'];
					else $page=1;
					if (count($posts) > 1) {
						loadPosts($posts, $page);
						loadLinks($posts);
					} else {
						$_SESSION['postId'] = $posts[0]->postId;
						loadFullPost($_SESSION['postId']);
					}

				} else if (!empty($_GET) && isset($_GET['postId'])) {
					$postId = $_GET['postId'];
					$_SESSION['postId'] = $_GET['postId'];
					loadFullPost($postId);

				} else if (isset($_SESSION['search'])) {
					$text = $_SESSION['search'];
					$posts = searchPostsByText($text);

					if ($posts!=false) {
						if (isset($_GET['page'])) $page = $_GET['page'];
						else $page=1;
						loadPosts($posts, $page);
						loadLinks($posts);
					}
					unset($_SESSION['search']);

				} else if (empty($_GET) || isset($_GET['page'])) {
					$posts = returnAllPosts();
					echo "<h2>Posts</h2>";
					if (isset($_GET['page'])) $page = $_GET['page'];
					else $page=1;
					if (count($posts) > 1) {
						loadPosts($posts, $page);
						loadLinks($posts);
					} else {
						$_SESSION['postId'] = $posts[0]->postId;
						loadFullPost($_SESSION['postId']);
					}
				}
				?>
			</div>

		</main> <!-- main -->


		<!--<script src="styles/bootstrap/js/bootstrap.min.js"></script>
		<script src="styles/bootstrap/js/jquery.min.js"></script>-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>
</html>
