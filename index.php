<?php
require_once(__DIR__ . '/config/conex.php');
require_once(__DIR__ . '/controllers/product_controller.php');

$controller = new product_controller();

$metodo = !empty($_REQUEST['pa']) ? $_REQUEST['pa'] : 
          (!empty($_REQUEST['np']) ? $_REQUEST['np'] : 
          (!empty($_REQUEST['so']) ? $_REQUEST['so'] : 
          (!empty($_REQUEST['m']) ? $_REQUEST['m'] : 'index')));

if (method_exists($controller, $metodo)) {
    $controller->$metodo();
} else {
    $controller->index();
}
?>