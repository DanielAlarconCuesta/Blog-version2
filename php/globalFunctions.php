<?php
	session_start();
	require_once('classes/classes.php');


	function returnCommentsByPostId($postId) {

		try {
			$dbh = createDatabaseConnection();
			$query =   	"SELECT *
						 FROM Comments
						 WHERE post = ?
						 ORDER BY dateTime DESC;";

			$stmt = $dbh->prepare($query);
			$stmt->bindParam(1, $postId);
			$stmt->execute();

			$comments = array();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$commentId = $row['commentId'];
				$post = $row['post'];
				$dateTime = strtotime($row['dateTime']);
				$dateTime = date("Y-m-d H:i:s", $dateTime);
				$author = createUserById($row['author']);
				$content = nl2br($row['content']);

				$auxComment = new Comment($commentId, $post, $dateTime, $author, $content);
				array_push($comments, $auxComment);
			}
			return $comments;

		} catch (PDOException $exception) {

		}
	}

	function createDatabaseConnection() {
			try {
				$user="blogdwes";
				$password="1234";
				$dbname="blogdwes"; //database name

				$dsn = "mysql:host=localhost;dbname=$dbname"; //indicate database ip and database name
				$dbh = new PDO($dsn, $user, $password); //construct pdo (database) object
				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //set error attribute

				return $dbh;

			} catch (PDOException $exception) {
				echo $exception->getMessage();
			}
		}

	function returnAllPosts() {

		try {
			$dbh = createDatabaseConnection();
			$query =   	"SELECT *
						FROM Posts
						ORDER BY dateTime DESC;";

			$stmt = $dbh->prepare($query);
			$stmt->execute();

			$posts = array();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$postId = $row['postId'];
				$content = nl2br($row['content']); //replace \r\n with <br>
				//$dateTime = new DateTime($row['dateTime']);
				$dateTime = strtotime($row['dateTime']);
				$dateTime = date("Y-m-d H:i:s", $dateTime);
				$labels = $row['labels'];
				$title = $row['title'];
				$author = createUserById($row['author']);
				$image = $row['image'];

				$auxPost = new Post($postId, $dateTime, $content, $title, $author, $image);
				array_push($posts, $auxPost);
			}

			return $posts;

		} catch (PDOException $exception) {
			echo $exception->getMessage();
		}
		$dbh = null;

	}

	function createUserById($userId) {

		try {
			$dbh = createDatabaseConnection();
			$query =   	"SELECT *
						FROM Users
						WHERE userId=?;";

			$stmt = $dbh->prepare($query);
			$stmt->bindParam(1, $userId);
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			$name = $row['name'];
			$password = $row['password'];
			$role = $row['role'];
			$user = $row['userId'];
			$favouritesPosts = $row['favouritesPosts'];

			$user = new User($user, $name, $password, $role, $favouritesPosts);

			return $user;

		} catch (PDOException $exception) {
			echo $exception->getMessage();
		}
		$dbh = null;
	}

	function login($userId, $password) {
		$hashPassword = encryptPassword($password);
		$rightLogin = false;
		try {
			$dbh = createDatabaseConnection();
			$query =   	"SELECT *
						FROM Users
						WHERE userId=?
						AND password=?;";

			$stmt = $dbh->prepare($query);
			$stmt->bindParam(1, $userId);
			$stmt->bindParam(2, $hashPassword);
			$stmt->execute();

			if($stmt->rowCount()) {
				$rightLogin = true;
				$row = $stmt->fetch(PDO::FETCH_ASSOC);

				$_SESSION['user']['name'] = $row['name'];
				$_SESSION['user']['userId'] = $row['userId'];
				$_SESSION['user']['role'] = $row['role'];

			} else {
				$rightLogin = false;
			}

			return $rightLogin;

		} catch (PDOException $exception) {
			echo $exception->getMessage();
		}
		$dbh = null;

	}

	function signUp($user) {
		$hashPassword = encryptPassword($user->password);
		$userId = $user->userId;
		$name = $user->name;
		$role = $user->role;
		$favouritesPosts = $user->favouritesPosts;

		try {
			$dbh = createDatabaseConnection();
			$query =   	"INSERT INTO Users(userId, name, password, role, favouritesPosts)
						 VALUES(?, ?, ?, ?, ?);";


		   	$stmt = $dbh->prepare($query);
			$stmt->bindParam(1, $userId);
			$stmt->bindParam(2, $name);
			$stmt->bindParam(3, $hashPassword);
			$stmt->bindParam(4, $role);
			$stmt->bindParam(5, $favouritesPosts);
			$stmt->execute();

			return true;

		} catch (PDOException $exception) {
			return false;
		}
		$dbh = null;

	}

	function encryptPassword($password) {
		$salt = '$5$'; //sha256
		$salt .= '10$'; //cost
		$salt_chars = array_merge(range('A','Z'), range('a','z'), range(0,9), array('/', '.'));

		for($i=0; $i < 22; $i++) {
			$salt .= $salt_chars[array_rand($salt_chars)];
		}

		$hashPassword = crypt($password, $salt);

		return $hashPassword;
	}

	function returnsYearsOfPosts() {
		try {
			$dbh = createDatabaseConnection();
			$query = "SELECT DISTINCT YEAR(dateTime) as year
					  FROM Posts
					  ORDER BY dateTime DESC;";

			$stmt = $dbh->prepare($query);
			$stmt->execute();

			$years = array();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				array_push($years, $row['year']);
			}

			return $years;

		} catch (PDOException $exception) {
			echo $exception->getMessage();
		}
		$dbh = null;
	}

	function returnsMonthsOfAYearOfPosts($year) {
		try {
			$dbh = createDatabaseConnection();
			$query = "SELECT DISTINCT MONTH(dateTime) as month
					  FROM Posts
					  WHERE YEAR(dateTime)=?
					  ORDER BY dateTime DESC;";

			$stmt = $dbh->prepare($query);
			$stmt->bindParam(1, $year);
			$stmt->execute();

			$months = array();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				array_push($months, $row['month']);
			}

			return $months;

		} catch (PDOException $exception) {
			echo $exception->getMessage();
		}
		$dbh = null;
	}

	function returnPostByYear($year) {

		try {
			$dbh = createDatabaseConnection();
			$query = "SELECT *
					  FROM Posts
					  WHERE YEAR(dateTime)=?
					  ORDER BY dateTime DESC;";

			$stmt = $dbh->prepare($query);
			$stmt->bindParam(1, $year);
			$stmt->execute();

			$posts = array();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$postId = $row['postId'];
				$content = nl2br($row['content']); //replace \r\n with <br>
				$dateTime = strtotime($row['dateTime']);
				$dateTime = date("Y-m-d H:i:s", $dateTime);
				$labels = $row['labels'];
				$title = $row['title'];
				$author = createUserById($row['author']);
				$image = $row['image'];

				$auxPost = new Post($postId, $dateTime, $content, $title, $author, $image);
				array_push($posts, $auxPost);
			}

			return $posts;

		} catch (PDOException $exception) {
			echo $exception->getMessage();
		}
		$dbh = null;

	}

	function returnPostByYearAndMonth($year, $month) {

		try {
			$dbh = createDatabaseConnection();
			$query = "SELECT *
					  FROM Posts
					  WHERE YEAR(dateTime)=?
					  AND MONTH(dateTime)=?
					  ORDER BY dateTime DESC;";

			$stmt = $dbh->prepare($query);
			$stmt->bindParam(1, $year);
			$stmt->bindParam(2, $month);
			$stmt->execute();

			$posts = array();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$postId = $row['postId'];
				$content = nl2br($row['content']); //replace \r\n with <br>
				$dateTime = strtotime($row['dateTime']);
				$dateTime = date("Y-m-d H:i:s", $dateTime);
				$labels = $row['labels'];
				$title = $row['title'];
				$author = createUserById($row['author']);
				$image = $row['image'];

				$auxPost = new Post($postId, $dateTime, $content, $title, $author, $image);
				array_push($posts, $auxPost);
			}

			return $posts;

		} catch (PDOException $exception) {
			echo $exception->getMessage();
		}
		$dbh = null;
	}

	function returnPostById($postId) {
		try {
			$dbh = createDatabaseConnection();
			$query = "SELECT *
					  FROM Posts
					  WHERE postId=?;";

			$stmt = $dbh->prepare($query);
			$stmt->bindParam(1, $postId);
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$postId = $row['postId'];
			$content = $row['content']; //replace \r\n with <br>
			$dateTime = strtotime($row['dateTime']);
			$dateTime = date("Y-m-d H:i:s", $dateTime);
			$labels = $row['labels'];
			$title = $row['title'];
			$author = createUserById($row['author']);
			$image = $row['image'];

			$post = new Post($postId, $dateTime, $content, $title, $author, $image);

			return $post;

		} catch (PDOException $exception) {
			echo $exception->getMessage();
		}
		$dbh = null;
	}

	function updatePost($post) {
		$postId = $post->postId;
		$title = $post->title;
		$content = $post->content;
		$labels = $post->labels;
		$image = $post->image;
		$rightUpdated=false;

		try {
			$dbh = createDatabaseConnection();
			$query = "UPDATE Posts
					  SET title=?, content=?, labels=?
					  WHERE postId=?;";

			$stmt = $dbh->prepare($query);
			$stmt->bindParam(1, $title);
			$stmt->bindParam(2, $content);
			$stmt->bindParam(3, $labels);
			$stmt->bindParam(4, $postId);
			$stmt->execute();

			if ($image!=null) {
				$query = "UPDATE Posts
						  SET image=?
						  WHERE postId=?;";

				$stmt = $dbh->prepare($query);
				$stmt->bindParam(1, $image);
				$stmt->bindParam(2, $postId);
				$stmt->execute();
				$rightUpdated = true;
			}

		} catch (PDOException $exception) {
			$rightUpdated = false;
		}

		$dbh = null;
		return $rightUpdated;
	}

	function generatePostId() {
		$availablePostId = false;

		while ($availablePostId==false) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    	$postId = '';


		    for ($i = 0; $i < 10; $i++) {
		        $postId .= $characters[rand(0, strlen($characters))];
		    }

			try {
				$dbh = createDatabaseConnection();
				$query =   	"SELECT postId
							 FROM Posts
							 WHERE postId=?;";

				$stmt = $dbh->prepare($query);
				$stmt->bindParam(1, $postId);
				$stmt->execute();

				if(!$stmt->rowCount()) {
					$availablePostId = true;
				}

			} catch (PDOException $exception) {
				echo $exception->getMessage();
			}
			$dbh = null;
		}
		return $postId;
	}

	function generateCommentId() {
		$availableCommentId = false;

		while ($availableCommentId==false) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    	$commentId = '';


		    for ($i = 0; $i < 15; $i++) {
		        $commentId .= $characters[rand(0, strlen($characters))];
		    }

			try {
				$dbh = createDatabaseConnection();
				$query =   	"SELECT commentId
							 FROM Comments
							 WHERE commentId=?;";

				$stmt = $dbh->prepare($query);
				$stmt->bindParam(1, $commentId);
				$stmt->execute();

				if (!$stmt->rowCount()) {
					$availableCommentId = true;
				}

			} catch (PDOException $exception) {
				echo $exception->getMessage();
			}
			$dbh = null;
		}
		return $commentId;
	}

	function createDirectory($path) {
		//$path = "images/2020/February";

		$arrayPath = explode("/", $path);
		for ($i=0; $i<count($arrayPath); $i++) {
			$j=0;
			$auxPath="";
			while ($j<=$i) {
				$auxPath.= $arrayPath[$j]."/";
				$j++;
			}

			if (!file_exists($auxPath)) {
				mkdir($auxPath, 0777);
			}
		}
	}

	function createPost($post) {

		$rightUpload;

		$postId = $post->postId;
		$title = $post->title;
		$content = $post->content;
		$dateTime = $post->dateTime;
		$image = $post->image;
		$labels = $post->labels;
		$author = $post->author->userId;

		try {
			$dbh = createDatabaseConnection();
			$query = "INSERT INTO Posts (postId, title, content, dateTime, image, labels, author)
					  VALUES (?, ?, ?, ?, ?, ?, ?);";

			$stmt = $dbh->prepare($query);

			$stmt->bindParam(1, $postId);
			$stmt->bindParam(2, $title);
			$stmt->bindParam(3, $content);
			$stmt->bindParam(4, $dateTime);
			$stmt->bindParam(5, $image);
			$stmt->bindParam(6, $labels);
			$stmt->bindParam(7, $author);
			$stmt->execute();

			$rightUpload = true;

		} catch (PDOException $exception) {
			$rightUpload = false;
		}

		$dbh = null;
		return $rightUpload;

	}

	function createComment($comment) {
		$rightUpload;

		$post = $comment->post;
		$commentId = $comment->commentId;
		$dateTime = $comment->dateTime;
		$author = $comment->author->userId;
		$content = $comment->content;

		try {
			$dbh = createDatabaseConnection();
			$query = "INSERT INTO comments (commentId, post, dateTime, author, content)
					  VALUES (?, ?, ?, ?, ?);";

			$stmt = $dbh->prepare($query);

			$stmt->bindParam(1, $commentId);
			$stmt->bindParam(2, $post);
			$stmt->bindParam(3, $dateTime);
			$stmt->bindParam(4, $author);
			$stmt->bindParam(5, $content);
			$stmt->execute();

			$rightUpload = true;

		} catch (PDOException $exception) {
			$rightUpload = false;
		}

		$dbh = null;
		return $rightUpload;
	}

	function updateUser($user) {

		$rightUpload = false;
		$userId = $user->userId;
		$name = $user->name;
		$password = $user->password;
		$role = $user->role;
		$favouritesPosts = $user->favouritesPosts;

		try {
			$dbh = createDatabaseConnection();
			$query = "UPDATE Users
					  SET userId=?, name=?, password=?, role=?, favouritesPosts=?
					  WHERE userId=?;";

			$stmt = $dbh->prepare($query);

			$stmt->bindParam(1, $userId);
			$stmt->bindParam(2, $name);
			$stmt->bindParam(3, $password);
			$stmt->bindParam(4, $role);
			$stmt->bindParam(5, $favouritesPosts);
			$stmt->bindParam(6, $userId);
			$stmt->execute();

			$rightUpload = true;

		} catch (PDOException $exception) {
			$rightUpload = false;
		}

		return $rightUpload;
	}

	function searchPostsByText($text) {
		$text = '%'.$text.'%';
		try {
			$dbh = createDatabaseConnection();
			$query = "SELECT DISTINCT *
					  FROM Posts
					  WHERE title LIKE ?
					  OR content LIKE ?
					  OR labels LIKE ?;";

			$stmt = $dbh->prepare($query);

			$stmt->bindParam(1, $text);
			$stmt->bindParam(2, $text);
			$stmt->bindParam(3, $text);
			$stmt->execute();

			$posts = array();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$postId = $row['postId'];
				$content = nl2br($row['content']); //replace \r\n with <br>
				//$dateTime = new DateTime($row['dateTime']);
				$dateTime = strtotime($row['dateTime']);
				$dateTime = date("Y-m-d H:i:s", $dateTime);
				$labels = $row['labels'];
				$title = $row['title'];
				$author = createUserById($row['author']);
				$image = $row['image'];

				$auxPost = new Post($postId, $dateTime, $content, $title, $author, $image);
				array_push($posts, $auxPost);
			}

			$rightUpload = true;

		} catch (PDOException $exception) {
			$rightUpload = false;
		}
		$dbh = null;

		if ($rightUpload===false) return false;
		else return $posts;
	}

	function deletePostById($postId) {
		$deleteSuccessfully=true;

		$comments = returnCommentsByPostId($postId);

		try {
			$dbh = createDatabaseConnection();

			if ($comments!=null) {
				$query =   	"DELETE FROM Comments
							 WHERE post=?;";

				$stmt = $dbh->prepare($query);
				$stmt->bindParam(1, $postId);
				$stmt->execute();
			}
			$query =   	"DELETE FROM Posts
						 WHERE postId=?;";

			$stmt = $dbh->prepare($query);
			$stmt->bindParam(1, $postId);
			$stmt->execute();

		} catch (PDOException $exception) {
			$deleteSuccessfully = false;
		}

		return $deleteSuccessfully;
	}
?>
