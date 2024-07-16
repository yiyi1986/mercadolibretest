<div class="container">
    <h2>Formulario productos en DB</h2>
    <h4>Permite actualizar productos en la DB</h4>
    <div class="col-md-6 col-md-offset-3">
        <div class="form-horizontal" style="">
            <?php if(isset($data['id'])==""){ ?>
            <form action="index.php?m=get_datosE" method="post">
            <?php } ?>
            <?php if(isset($data['id'])!=""){ ?>
            <form action="index.php?m=get_datosE&id=<?php echo $data['id'];?>" method="post">
            <?php } ?>

                <div class="form-group">
                    <label class=" col-sm-2 control-label" for="txt_id">ID:</label>
                    <div class="col-sm-10">
                <input type="text" class="form-control" name="txt_id" value="<?php echo $data['id']; ?>">
                    </div>                    
                </div>
                <div class="form-group">
                    <label class=" col-sm-2 control-label" for="txt_title">NOMBRE:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="txt_title" value="<?php echo $data['title']; ?>">
                    </div>                    
                </div>               
                <div class="form-group">
                    <label class=" col-sm-2 control-label" for="txt_price">PRECIO:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="txt_price" value="<?php echo $data['price']; ?>">
                    </div>                    
                </div>
                <div class="form-group">
                    <label class=" col-sm-2 control-label" for="txt_status">ESTADO:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="txt_status" value="<?php echo $data['status']; ?>">
                    </div>                    
                </div>               
                <div class="form-group">
                    <div class="col-md-12 col-md-off-set-3">
                    <?php if(isset($data['id'])==""){ ?>
                        <input type="submit" class="btn btn-primary form-control" name="" value="registrar">
                    <?php }  ?>
                    <?php if(isset($data['id'])!=""){ ?>
                    <input type="submit" class="btn btn-primary form-control" name="" value="Actualizar">
                    <?php }  ?>
                    </div>
                </div>
            </form>            
        </div>
    </div>    
</div>