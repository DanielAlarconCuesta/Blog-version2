<?php
	require_once('globalFunctions.php');

	$post=null;

	function uploadPostImage($postId) {

			$rightUploaded = false;

			$errors = array();
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_tmp = $_FILES['image']['tmp_name'];
			$file_type = $_FILES['image']['type'];

			$file_ext = strtolower($file_name);
			$file_ext = explode(".", $file_name);
			$file_ext = end($file_ext);
			$file_name = $postId.".".$file_ext;

			$extensions= array("jpeg","jpg","png");

			if (in_array($file_ext, $extensions)=== false) {
				array_push($errors, "extension not allowed, please choose a JPEG or PNG file.");
			}

			if ($file_size > 2097152) {
				array_push($errors, 'File size must be excately 2 MB');
			}

			if (empty($errors)==true) {
				$now = new DateTime();
				$path = "../images/".$now->format("Y")."/".$now->format('F');
				createDirectory($path);

				move_uploaded_file($file_tmp, $path."/".$file_name);
				$rightUploaded = true;
				$imagePath = "images/".$now->format("Y")."/".$now->format('F')."/".$file_name;
				$_SESSION['imagePath'] = $imagePath;

			} else {
				$rightUploaded = false;
			}

			return $rightUploaded;
		}

	function constructPost() {
		$postId = generatePostId();
		$title = $_POST['title'];
		$content = $_POST['content'];
		$now = new DateTime();
		$dateTime = $now->format('Y-m-d H:i:s');
		$author = createUserById($_SESSION['user']['userId']);
		$image='';

		//image part
		if (isset($_FILES['image'])) {
			$rightUploaded = uploadPostImage($postId);
			if ($rightUploaded && isset($_SESSION['imagePath'])) $image = $_SESSION['imagePath'];
			else $image = "";

		} else {
			$image = "";
		}

		$auxPost = new Post($postId, $dateTime, $content, $title, $author, $image);
		return $auxPost;
	}

	function constructAnUpdatePost() {
		$postId = $_GET['postId'];
		$title = $_POST['title'];
		$content = $_POST['content'];
		$now = new DateTime();
		$dateTime = $now->format('Y-m-d H:i:s');
		$author = createUserById($_SESSION['user']['userId']);
		$image = null;

		//image part
		if (isset($_FILES['image'])) {
			$rightUploaded = uploadPostImage($postId);
			if ($rightUploaded && isset($_SESSION['imagePath'])) $image = $_SESSION['imagePath'];
		}

		$auxPost = new Post($postId, $dateTime, $content, $title, $author, $image);
		return $auxPost;
	}

	if (!isset($_SESSION['user'])) {
		header("Location: ../index.php");

	} else if (isset($_SESSION['user']) && !$_SESSION['user']['role']="root") {
		header("Location: ..index.php");
	}

	$post=null;
	if (!empty($_GET) && isset($_GET['postId'])) {
		$postId = $_GET['postId'];
		$post = returnPostById($postId);

	}

	if ($post!=null && !empty($_POST) && isset($_POST['title']) && isset($_POST['content'])) {
		$post->title = $_POST['title'];
		$post->content = $_POST['content'];
		$post->labels = $_POST['labels'];
		$post->dateTime = date("Y-m-d H:i:s");

		if (isset($_FILES['image'])) {
			$rightPicture = uploadPostImage($post->postId);
			if ($rightPicture) $post->image = $_SESSION['imagePath'];
		}

		$rightUpdated = updatePost($post);
		if ($rightUpdated) header("Location: ../index.php");
		else $error = "Post could not be updated";

	} else if (!empty($_POST) && isset($_POST['title']) && isset($_POST['content'])) {
		$title = $_POST['title'];
		$content = $_POST['content'];
		$labels = $_POST['labels'];
		$postId = generatePostId();
		$dateTime = date("Y-m-d H:i:s");
		$author = createUserById($_SESSION['user']['userId']);

		if (isset($_FILES['image'])) {
			echo "<script>alert('if')</script>";
			$rightPicture = uploadPostImage($postId);
			if ($rightPicture) $image = $_SESSION['imagePath'];
			else $image="";

		} else {
			echo "<script>alert('else')</script>";
			$image="";
		}

		$post = new Post($postId, $dateTime, $content, $title, $author, $image);
		$rightUpload = createPost($post);
		if ($rightUpload) header("Location: ../index.php");
		else echo "Post could not be created";

	}
?>

<!DOCTYPE html>
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

		<main class="container-fluid">
			<article id="articleCreatePost"class="col-sm-11 col-xs-10">
				<form id="uploadImage" action="" method="post" enctype="multipart/form-data">

					<h2>Add Post</h2>
					<?php
						//if (!empty($_POST) && $error!=null) echo $error;
					?>
					<label for="title"> Title <br/>
						<input type="text" id="inputTextTitle" size="120" value="<?php if($post!=null) echo $post->title; ?>" name="title" id="title">
					</label> <br/> <br/>

					<label for="content"> Content
						<textarea id='textAreaContenido' placeholder='Escribe aquí...' rows='20' cols='121' type='textArea' name='content'><?php if ($post!=null) echo $post->content; ?></textarea>
					</label> <br/> <br/>

					<label for="image"> Image <br/>
						<input type="file" name="image" accept="image/x-png,image/gif,image/jpeg" />
					</label> <br/> <br/>

					<label for="labels"> Tags <br/>
						<textarea placeholder="Tags separated by commas" rows="5" cols="40" type="textArea" name="labels" id="labels"><?php if($post!=null) echo $post->labels; ?></textarea>
					</label> <br/> <br/>

					<input type="hidden" value="<?php if($post!=null) echo $post->postId; ?>" name="action">

					<input type="submit" form="uploadImage">

				</form>

			</article>
		</main>

	</body>
</html>
