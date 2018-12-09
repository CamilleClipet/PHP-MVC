<?php
include_once '../Config/core.php';

class Router
{

  public function parseUrl()
  {
    if(isset($_GET['url'])) {
        //echo $_GET['url'];
        return $url = explode('/',filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
    }
  }

}


 ?>
