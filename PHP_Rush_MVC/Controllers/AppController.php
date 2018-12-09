<?php

//une page = un controller, une table = un modele

class AppController
{
  public function loadModel($model)
  {
    require_once '../Models/'.$model.'.php';

    return new $model;

  }

  public function render($file = null, $data = [])
  {
    if ($file != null) {
      require_once '../Views/'.$file.'.php';
    }

  }

  // public function beforeRender()
  // {
  //
  // }

  public static function redirect($param)
  {
  $param = implode("/", $param);
  //echo $param;
  //$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/' . $param;
  $url = 'localhost:8888/?url='.$param;
  //echo  $url;
  header("Location: ".$url);
  exit();
  }

  public function hello()
  {
    echo "Controllers/AppController";
  }

  public function hellomodel($model)
  {
    return "hellomodel";
  }


}

 ?>
