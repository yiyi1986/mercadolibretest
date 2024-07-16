    <div class="container">
    <h1 class="mb-4">Consulta productos en MercadoLibre</h1>
        <h4>Permite mediante el API mostrar los productos del vendedor de pruebas y actualiza la base de datos Mysql con los productos de mercado libre</h4>
        <?php if (isset($items) && $items): ?>
            <h2 class="mb-3">Resultados:</h2>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Precio</th>
                        <th>Disponibilidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php                   
                    foreach ($items as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['body']['id']); ?></td>
                            <td><?php echo htmlspecialchars($item['body']['title']); ?></td>
                            <td><?php echo htmlspecialchars($item['body']['price']); ?></td>
                            <td><?php echo htmlspecialchars($item['body']['condition']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>     
    </div>


