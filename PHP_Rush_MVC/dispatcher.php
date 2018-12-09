<?php
include_once "Config/core.php";

class Dispatcher extends Router
{

  protected $controller  = 'ArticlesController';

  protected $method = 'allArticles';

  protected $params = [];

  public function __construct()
  {
    $url = $this->parseUrl();

    if(file_exists('../Controllers/'.$url[0].'.php'))
    {
      $this->controller = $url[0];
      unset($url[0]);
    }

    require_once '../Controllers/'.$this->controller.'.php';

    $this->controller = new $this->controller;

    if (isset($url[1]))
    {
      if(method_exists($this->controller, $url[1]))
      {
        $this->method = $url[1];
        unset($url[1]);
      }
    }
    //var_dump($url);
    $this->params = $url ? array_values($url) : [];
    call_user_func_array([$this->controller, $this->method], $this->params);

  }


}


 ?>
