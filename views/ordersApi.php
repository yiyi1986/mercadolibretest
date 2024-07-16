    <div class="container">
        <h1 class="mb-4">Consulta pedidos en MercadoLibre</h1>
        <h4>Permite mediante el API mostrar los pedidos del vendedor de pruebas</h4>
        <?php if (isset($sellerOrders) && $sellerOrders): ?>
            <h2 class="mb-3">Resultados:</h2>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Código de Orden</th>
                        <th>Nombre del Producto</th>
                        <th>Cantidad de Artículos</th>                        
                    </tr>
                </thead>               
                <tbody>
                    <?php foreach ($sellerOrders['results'] as $order): ?>
                        <?php foreach ($order['order_items'] as $item): ?>
                            <tr>
                                <td><?php echo  htmlspecialchars($order['id']); ?></td>
                                <td><?php echo $item['item']['title']; ?></td>
                                <td><?php echo $item['quantity']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>                   
            </table>
        <?php endif; ?>
      
    </div>


