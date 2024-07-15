<div class="container" style="margin-top: 80px">
    <div class="jumbotron">
        <h2>registro de productos</h2>
        
    </div>
    <div class="container">
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>price</th>                
                    <th>status</th>
           
                </tr>
            </thead>
            <tbody>
                <?php foreach($query as $data): ?>
                    <tr>
                        <th><?php echo $data['id']; ?></th>
                        <th><?php echo $data['title']; ?></th>
                        <th><?php echo $data['price']; ?></th>
                        <th><?php echo $data['status']; ?></th>
         
                        <th>
                            <a href="index.php?m=product&id=<?php echo $data['id']?>" class="btn btn-primary">Editar</a>
                            <a href="index.php?m=confirmarDelete&id=<?php echo $data['id']?>" class="btn btn-danger">Eliminar</a>
                        </th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
</div>