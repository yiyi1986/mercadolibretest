<?php
    /**
     * Clase principal para manipular productos 
     * @author Ysariol
     */
    class products_model{
        private $DB;
        private $productss;

        function __construct(){
            $this->DB=Database::connect();
        }

        /**
         * Metodo para consultar todos los productos de la base de datos
         * 
         */
        function get(){
            $sql= 'SELECT * FROM products ORDER BY id DESC';
            $fila=$this->DB->query($sql);
            $this->productss=$fila;
            return  $this->productss;
        }

        /**
         * Metodo para insertar productos en la base de datos
         * @param Datos del producto
         * 
         */
        function create($data){

            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql="INSERT INTO products(id,title,price,status)VALUES (?,?,?,?)";

            $query = $this->DB->prepare($sql);
            $query->execute(array($data['id'],$data['title'],$data['price'],$data['status']));
            Database::disconnect();       

        }

          /**
         * Metodo para obtener producto la base de datos
         * @param Id del producto
         * 
         */
        function get_id($id){
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM products where id = ?";
            $q = $this->DB->prepare($sql);
            $q->execute(array($id));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            return $data;
        }

          /**
         * Metodo para actualizar productos en la base de datos
         * @param Datos para actualizar y Id del producto 
         * 
         */
        function update($data,$id){
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE products  set  title=?, price=?,status=? WHERE id = ? ";
            $q = $this->DB->prepare($sql);
            $q->execute(array($data['title'],$data['price'],$data['status'], $id));
            Database::disconnect();

        }

          /**
         * Metodo para borrar producto en la base de datos
         * @param Id del producto
         * 
         */

        function delete($id){
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql="DELETE FROM products where id=?";
            $q=$this->DB->prepare($sql);
            $q->execute(array($id));
            Database::disconnect();
        }
    }
?>

