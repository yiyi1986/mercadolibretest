<?php

require_once(__DIR__ . '/../models/api_client.php');
require_once(__DIR__ . '/../controllers/api_service.php');

// Cargar la configuración
//$config = require '/../config/config.php';
$config =  require_once(__DIR__ . '/../config/config.php');

// Crear una instancia de ApiClient con la configuración
$apiClient = new ApiClient($config);

// Crear una instancia de ApiService
$apiService = new ApiService($apiClient, $config);
$apiService->executeRefreshToken();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   if (isset($_POST['fetch_items'])) {
        // Obtener los ítems del vendedor
        $items = $apiService->fetchSellerItems();
    } elseif (isset($_POST['add_item'])) {
        // Crear un nuevo ítem
        $itemData = [
            "title" => "Item de test - No Ofertar1",
            "category_id" => "MLU3530",
            "price" => 1500,
            "currency_id" => "UYU",
            "available_quantity" => 10,
            "buying_mode" => "buy_it_now",
            "condition" => "new",
            "listing_type_id" => "gold_special",
            "sale_terms" => [
                [
                    "id" => "WARRANTY_TYPE",
                    "value_name" => "Garantía del vendedor"
                ],
                [
                    "id" => "WARRANTY_TIME",
                    "value_name" => "90 días"
                ]
            ],
            "pictures" => [
                [
                    "source" => "http://mla-s2-p.mlstatic.com/968521-MLA20805195516_072016-O.jpg"
                ]
            ],
            "attributes" => [
                [
                    "id" => "BRAND",
                    "value_name" => "Marca del producto"
                ],
                [
                    "id" => "EAN",
                    "value_name" => "7898095297749"
                ]
            ]
        ]; 
        $newItem = $apiService->addItem($itemData);
    }
} else {
    $items = null;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>MercadoLibre API</title>
</head>
<body>
    <h1>Consulta API de MercadoLibre</h1>
    <form method="POST">
        
        <button type="submit" name="fetch_items">Obtener Productos</button>
        <button type="submit" name="add_item">Agregar Producto</button>
    </form>

    <?php if (isset($items) && $items): ?>
        <h2>Resultados:</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Precio</th>
                    <th>Disponibilidad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items['results'] as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['id']); ?></td>
                        <td><?php echo htmlspecialchars($item['title']); ?></td>
                        <td><?php echo htmlspecialchars($item['price']); ?></td>
                        <td><?php echo htmlspecialchars($item['condition']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if (isset($newItem) && $newItem): ?>
        <h2>Nuevo Ítem Agregado:</h2>
        <pre><?php print_r($newItem); ?></pre>
    <?php endif; ?>
</body>
</html>