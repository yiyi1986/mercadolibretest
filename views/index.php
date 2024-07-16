<div class="container">
<h1 class="mb-4">Consulta Productos MySql</h1>
    <h4>Muestra los productos guardados en la DB, puede modificarlos o eliminarlos, pero cuando se consulte el api se vuelven actualizar</h4>
    <?php if (isset($query) && $query): ?>
        <h2 class="mb-3">Resultados:</h2>
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($query as $data): ?>
                    <tr>
                        <td><?php echo $data['id']; ?></td>
                        <td><?php echo $data['title']; ?></td>
                        <td><?php echo $data['price']; ?></td>
                        <td><?php echo $data['status']; ?></td>
                        <td>
                            <a href="index.php?m=product&id=<?php echo $data['id']; ?>" class="btn btn-primary btn-sm">Editar</a>
                            <a href="index.php?m=confirmarDelete&id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    </div>
