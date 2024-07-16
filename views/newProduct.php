<div class="container">
        <h2>Formulario registro</h2>
        <h4>Permite mediante el API insertar productos al vendedor de pruebas, se muestra el json generado</h4>
    <div class="col-md-6 col-md-offset-3">
        <?php if (isset($newItem) && $newItem): ?>
            <h2>Json del Nuevo Ítem Agregado:</h2>
            <pre><?php print_r($newItem); ?></pre>
        <?php else: ?>
        <div class="form-horizontal" style="">           
            <form action="index.php?np=newProductApi" method="post">           
                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" class="form-control" id="title" name="title" value="Item de test - No Ofertar" required>
                </div>
                <div class="form-group">
                    <label for="category_id">ID de Categoría</label>
                    <input type="text" class="form-control" id="category_id" name="category_id" value="MLU3530" required>
                </div>
                <div class="form-group">
                    <label for="price">Precio</label>
                    <input type="number" class="form-control" id="price" name="price" value="1500" required>
                </div>
                <div class="form-group">
                    <label for="currency_id">ID de Moneda</label>
                    <input type="text" class="form-control" id="currency_id" name="currency_id" value="UYU" required>
                </div>
                <div class="form-group">
                    <label for="available_quantity">Cantidad Disponible</label>
                    <input type="number" class="form-control" id="available_quantity" name="available_quantity" value="10" required>
                </div>
                <div class="form-group">
                    <label for="buying_mode">Modo de Compra</label>
                    <input type="text" class="form-control" id="buying_mode" name="buying_mode" value="buy_it_now" required>
                </div>
                <div class="form-group">
                    <label for="condition">Condición</label>
                    <input type="text" class="form-control" id="condition" name="condition" value="new" required>
                </div>
                <div class="form-group">
                    <label for="listing_type_id">Tipo de Publicación</label>
                    <input type="text" class="form-control" id="listing_type_id" name="listing_type_id" value="gold_special" required>
                </div>
                <div class="form-group">
                    <label for="warranty_type">Tipo de Garantía</label>
                    <input type="text" class="form-control" id="warranty_type" name="warranty_type" value="Garantía del vendedor" required>
                </div>
                <div class="form-group">
                    <label for="warranty_time">Tiempo de Garantía</label>
                    <input type="text" class="form-control" id="warranty_time" name="warranty_time" value="90 días" required>
                </div>
                <div class="form-group">
                    <label for="picture_source">URL de la Imagen</label>
                    <input type="text" class="form-control" id="picture_source" name="picture_source" value="https://http2.mlstatic.com/D_NQ_NP_941568-MLU54924890509_042023-O.webp" required>
                </div>
                <div class="form-group">
                    <label for="brand">Marca</label>
                    <input type="text" class="form-control" id="brand" name="brand" value="Marca del producto" required>
                </div>
                <div class="form-group">
                    <label for="ean">EAN</label>
                    <input type="text" class="form-control" id="ean" name="ean" value="7898095297749" required>
                </div>             
                <div class="form-group">
                    <div class="col-md-12 col-md-off-set-3">                    
                        <input type="submit" class="btn btn-primary form-control" name="" value="registrar">                    
                    </div>
                </div>
            </form>            
        </div>
        <?php endif; ?>
    </div>    
</div>    

