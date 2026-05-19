<?php

session_start();

define("ROOT", dirname(__DIR__));

require_once ROOT . "/config/database.php";

require_once ROOT . "/controllers/ProductController.php";
require_once ROOT . "/controllers/OrderController.php";
require_once ROOT . "/controllers/AdminController.php";

$route = isset($_GET['route']) ? $_GET['route'] : 'product/catalogue';

$routeParts = explode('/', $route);

$controllerName = ucfirst($routeParts[0]) . "Controller";

$method = isset($routeParts[1]) ? $routeParts[1] : "catalogue";

$id = isset($routeParts[2]) ? $routeParts[2] : null;

if(class_exists($controllerName)){

    $controller = new $controllerName();

    if(method_exists($controller, $method)){

        if($id){

            $controller->$method($id);

        }else{

            $controller->$method();

        }

    }else{

        echo "Method Not Found";

    }

}else{

    echo "Controller Not Found";

}
?>