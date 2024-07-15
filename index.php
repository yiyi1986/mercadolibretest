<?php
   require_once(__DIR__ . '/config/conex.php');
   require_once(__DIR__ . '/controllers/product_controller.php');

    $controller= new product_controller();

    if(!empty($_REQUEST['pa'])){
        $metodo=$_REQUEST['pa'];
        if (method_exists($controller, $metodo)) {
            $controller->$metodo();
        }else{
            $controller->index();
        }
    }else{    
    if(!empty($_REQUEST['m'])){
        $metodo=$_REQUEST['m'];
        if (method_exists($controller, $metodo)) {
            $controller->$metodo();
        }else{
            $controller->index();
        }
    }else{
        $controller->index();
    }
}




?>