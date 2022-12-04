<?php
  class Pages {
    public function __construct(){
      echo 'Pages.php controller ran...<br /><br />';
    }

    public function index(){
      
    }

    public function about($id){
      echo 'This is about';
      echo $id;
    }
  }