<?php
session_start();
define("BASE_URL", "http://agendarse.com.br");
define("ASSETS_URL", "http://agendarse.com.br/public");
//print_r($_SERVER);
if (isset($_SERVER['PATH_INFO'])){
  $parts = explode("/", $_SERVER['PATH_INFO']);
  
  if (count($parts) == 2){
    $class = $parts[1];
    $method = "";
    $value = "";
    $value1 = "";
  } else if (count($parts) == 3){
    $class = $parts[1];
    $method = $parts[2];
    $value = "";
    $value1 = "";
  } else if (count($parts) == 4){
    $class = $parts[1];
    $method = $parts[2];
    $value = $parts[3];
    $value1 = "";
  } else if (count($parts) >= 5){
    $class = $parts[1];
    $method = $parts[2];
    $value = $parts[3];
    $value1 = $parts[4];
  }

  if (file_exists("./controller/{$class}.php")){
    require_once("./controller/{$class}.php");
    $obj = new $class();

    if (!empty($method)){
      if (method_exists($obj, $method)){
        if (empty($value)) $obj->$method();
        else if (empty($value1)) $obj->$method($value);
        else $obj->$method($value, $value1);
      } else {
        echo "Método não existe, por favor contrui-lo.";
      }
    } else {
      $obj->index();
    }
  } else {
    require_once("./controller/page404.php");
    $obj = new page404();
    $obj->index();
  }
} else {
  require_once("./controller/main.php");
  $obj = new main();
  $obj->index();
}