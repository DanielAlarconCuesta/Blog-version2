<?php
	class Comment {

	    private $commentId;
	    private $post;
	    private $dateTime;
	    private $author;
	    private $content;

	    function __construct($commentId, $post, $dateTime, $author, $content) {
	        $this->commentId=$commentId;
	        $this->post=$post;
	        $this->dateTime=$dateTime;
	        $this->author=$author;
	        $this->content=$content;
	    }

		function __get($attribute) {
	        switch ($attribute) {
	            case 'commentId':
	                return $this->commentId;
	                break;
	            case 'post':
	                return $this->post;
	                break;
	            case 'dateTime':
	                return $this->dateTime;
	            case 'author':
	                return $this->author;
	                break;
	            case 'content':
	                return $this->content;
	                break;
	        }
	    }

    function __set($attribute, $newValue) {
        switch ($attribute) {
            case 'commentId':
                $this->commentId=$newValue;
                break;
            case 'post':
                $this->post=$newValue;
                break;
            case 'dateTime':
                $this->dateTime=$newValue;
            case 'author':
                $this->author=$newValue;
                break;
            case 'content':
                $this->content=$newValue;
                break;
        }
    }
	}
?>
