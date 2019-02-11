<!DOCTYPE html>

<?php
require_once('globalFunctions.php');

$links=null;
error_reporting(E_ALL ^ E_NOTICE);

function loadFavouritePosts($posts, $page) {
	
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
				echo "<br/><br/><a href='../index.php?postId=$auxPost->postId'>Read more</a>";
			echo "</div>";

			echo "<div class='col-sm-3 col-xs-4'>";
			if (!empty($_SESSION) && isset($_SESSION['user'])) {
				$user = createUserById($_SESSION['user']['userId']);
				$isFavourite = $user->isAFavouritePost($auxPost->postId);

				echo "<form method='post' action=''>";
					echo "<input type='hidden' name='postIdFavourite' value='$auxPost->postId'>";
					if ($isFavourite) {
						echo "<div style='text-align: right'>";
						echo "<br/> <input type='image' width='40px' height='40px' src='../images/favourite.png' alt='Submit Form' />";
						echo "</div>";
					}
				echo "</form>";
			}
				if ($auxPost->image==null) {
					echo "<img id='postCover' src='../images/default.jpeg'>";

				} else {
					echo "<img id='postCover' src='../$auxPost->image'>";
				}
			echo "</div>";
			echo "</section>";
		}



}

function loadLinks($posts) {
	$amountPostsShowByPage = 5;
	$postsAmount = count($posts);
	$pages = ceil($postsAmount / $amountPostsShowByPage);

	if ($pages>1) {
		for ($i=1; $i<=$pages; $i++) {
			if ($i==1) $links .= "<a href='favouritePosts.php?page=$i'> | $i | </a>";
			else $links .= "<a href='favouritePosts.php?page=$i'> $i | </a>";
		}
		echo "<div style='text-align:center'>";
			echo $links;
		echo "</div>";
	}
}

if (!empty($_POST) && isset($_POST['postIdFavourite'])) {
	$postId = $_POST['postIdFavourite'];
	$userId = $_SESSION['user']['userId'];
	$user = createUserById($userId);

	$isFavourite = $user->isAFavouritePost($postId);

	if ($isFavourite) {
		$favouritesPosts = $user->favouritesPosts;
		$auxPostId = $postId.",";
		$favouritesPosts = str_replace($auxPostId,"",$favouritesPosts);
		$user->favouritesPosts = $favouritesPosts;

		/*if (!is_array($posts)) {

		}*/

	}
	updateUser($user);
}

 ?>



 <html lang="en" dir="ltr">
 	<head>
 		<meta charset="utf-8">
 		<title></title>
 		<style>
 			@import url("../styles/bootstrap/css/bootstrap.min.css");
 			@import url("../styles/main.css");
 		</style>
 		<script src="../js/nav.js"></script>
 		<!--<script src="js/jquery-3.3.1.min.js"></script>-->
 		<script src="../styles/bootstrap/js/jquery.min.js"></script>
 	</head>

	<body>

		<?php
			require_once('header.php');
			require_once('nav.php');

			/*$now = new DateTime();
			$dateTime = $now->format('Y-m-d H:i:s');
			$path = $now->format("Y")."/".$now->format('F');
			echo $path;*/
		?>

		<main class="row">
			<?php require_once('aside.php');?>

			<div id="articleMain1" class="col-sm-9 col-xs-11">
				<?php
				$userId = $_SESSION['user']['userId'];
				$user = createUserById($userId);
				$posts = array();
				$favouritePosts = $user->favouritesPosts;
				$arrayFavouritePosts = explode(",",$favouritePosts);

				for ($i=0; $i<count($arrayFavouritePosts)-1; $i++) {
					$auxPost = returnPostById($arrayFavouritePosts[$i]);
					array_push($posts, $auxPost);
				}

				if (isset($_GET['page'])) $page = $_GET['page'];
				else $page=1;
				loadFavouritePosts($posts, $page);
				if (count($posts)<1) echo "<h2>None favourite post<h2/>";
				loadLinks($posts);
				 ?>
			</div>
		</main>
</html>
