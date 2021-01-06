<?php
date_default_timezone_set('UTC');

class Persistence {
  
  private $data = array();
  
  function __construct() {
    session_start();
    
    if( isset($_SESSION['comment_form']) == true ){
      $this->data = $_SESSION['comment_form'];
    }
  }
  
  /**
   * Get all comments for the given post.
   */
  function get_comments($comment_post_ID) {
    $comments = array();
    if( isset($this->data[$comment_post_ID]) == true ) {
      $comments = $this->data[$comment_post_ID];
    }
    return $comments;
  }
  
  /**
   * Get all comments.
   */
  function get_all_comments() {
    return $this->data;
  }
  
  /**
   * Store the comment.
   */
  function add_comment($vars) {
    
    $added = false;
    
    $comment_post_ID = $vars['comment_post_ID'];
    $input = array(
     'name' => $vars['name'],
     'email' => $vars['email'],
     'comments' => $vars['comments'],
     'comment_post_ID' => $comment_post_ID,
     'date' => date('r'));
    
    if($this->validate_input($input) == true) {
      if( isset($this->data[$comment_post_ID]) == false ) {
        $this->data[$comment_post_ID] = array();
      }
      
      $input['id'] = uniqid('comment_');
      
      $this->data[$comment_post_ID][] = $input;
      
      $this->sync();
      
      $added = $input;
    }
    return $added;
  }
  
  function delete_all() {
    $this->data = array();
    $this->sync();
  }
  
  private function sync() {
    $_SESSION['comment_form'] = $this->data;    
  }
  
  /**
   * TODO: much more validation and sanitization. Use a library.
   */  
  private function validate_input($input) {
    $input['email'] = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
    if (filter_var($input['email'], FILTER_VALIDATE_EMAIL) == false) {
      return false;
    }
    
    $input['name'] = substr($input['name'], 0, 70);
    if($this->check_string($input['name']) == false) {
      return false;
    }
    $input['name'] = htmlentities($input['name']);

    $input['comments'] = substr($input['comments'], 0, 300);
    if($this->check_string($input['comments'], 5) == false) {
      return false;
    }
    $input['comments'] = htmlentities($input['comments']);

    $input['comment_post_ID'] = filter_var($input['comment_post_ID'], FILTER_VALIDATE_INT);  
    if (filter_var($input['comment_post_ID'], FILTER_VALIDATE_INT) == false) {
      return false;
    }

    return true;
  }
  
  private function check_string($string, $min_size = 1) {
    return strlen(trim($string)) >= $min_size;
  }
}

?>