<?php
	require_once('classes.php');
	class Post {

	    private $postId;
	    private $dateTime;
	    private $content;
	    private $title;
		private $labels;
	    private $author;
		private $image;

		function __get($attribute) {
	        switch($attribute) {
	            case 'postId':
	                return $this->postId;
	                break;
	            case 'dateTime':
	                return $this->dateTime;
	                break;
	            case 'content':
	                return $this->content;
	                break;
	            case 'title':
	                return $this->title;
	                break;
	            case 'author':
	                return $this->author;
	                break;
				case 'labels':
	                return $this->labels;
	                break;
				case 'image':
	                return $this->image;
	                break;
	        }
	    }

		function __set($attribute, $newValue) {
        switch($attribute) {
            case 'postId':
                $this->postId=$newValue;
                break;
            case 'dateTime':
                $this->dateTime=$newValue;
                break;
            case 'content':
                $this->content=$newValue;
                break;
            case 'title':
                $this->title=$newValue;
                break;
            case 'author':
                $this->author=$newValue;
                break;
            case 'comments':
                $this->comments=$newValue;
                break;
			case 'labels':
                $this->labels=$newValue;
                break;
			case 'image':
                $this->image=$newValue;
                break;
        }
    }

	    function __construct($postId, $dateTime, $content, $title, $author, $image) {
	        $this->postId=$postId;
	        $this->dateTime=$dateTime;
	        $this->content=$content;
	        $this->title=$title;
	        $this->author=$author;
			$this->image=$image;
	    }
	}

?>
