<?php
  /**
   * App Core Class
   * Creates URL and loads core controller
   * URL format: /controller/method/params
   */
  class Core {
    protected $currentController = 'Pages'; // default controller
    protected $currentMethod = 'index'; // default method
    protected $params = [];

    public function __construct(){
      $url = $this->getUrl();

      // Setting up current controller based on first element in $url 
      if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')) {
        $this->currentController = ucwords($url[0]);
        unset($url[0]);
      }

      // Require the controller
      require_once '../app/controllers/'.$this->currentController.'.php';

      // Instantiate controller class
      $this->currentController = new $this->currentController;

      // Setting up current method based on second element of $url
      if (isset($url[1])){
        if(method_exists($this->currentController, $url[1])){
          $this->currentMethod = $url[1];
          unset($url[1]);
        }
      }

      // Get leftover values and set as params
      $this->params = $url ? array_values($url) : [];

      // Call a callback with array of params 
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(){
      if (isset($_GET['url'])){
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
      }

      return ['pages'];
    }
  }
