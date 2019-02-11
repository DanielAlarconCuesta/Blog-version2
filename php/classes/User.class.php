<?php
	require_once('classes.php');

	class User {

		private $userId;
		private $name;
		private $password;
		private $role;
		private $favouritesPosts;

		function __construct($userId, $name, $password, $role, $favouritesPosts) {
			$this->userId=$userId;
			$this->name=$name;
			$this->password=$password;
			$this->role=$role;
			$this->favouritesPosts=$favouritesPosts;
		}

		function __get($attribute) {
	        switch($attribute) {
	            case 'userId':
	                return $this->userId;
	                break;
	            case 'name':
	                return $this->name;
	                break;
	            case 'password':
	                return $this->password;
	                break;
	            case 'role':
	                return $this->role;
	                break;
				case 'favouritesPosts':
	                return $this->favouritesPosts;
	                break;
	        }
	    }

	    function __set($attribute, $newValue) {
	        switch($attribute) {
	            case 'userId':
	                $this->userId=$newValue;
	                break;
	            case 'name':
	                $this->name=$newValue;
	                break;
	            case 'password':
	                $this->password=$newValue;
	                break;
	            case 'role':
	                $this->role=$newValue;
	                break;
				case 'favouritesPosts':
	                $this->favouritesPosts=$newValue;
	                break;
	        }
    	}

		function isAFavouritePost($postId) {

			$favouritesPosts = $this->favouritesPosts;
			$isFavourite = strpos($favouritesPosts, $postId);
			if ($isFavourite===false) return false;
			else return true;
		}
	}
?>
