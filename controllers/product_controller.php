<?php 
    require_once(__DIR__ . '/../models/product_model.php');
    
    class product_controller{

        private $model_e;
        private $model_p;

        function __construct(){
            $this->model_e=new products_model();
        }

        function index(){
            $query =$this->model_e->get();

            include_once('views/header.php');
            include_once('views/index.php');
            include_once('views/footer.php');
        }

        function productApi(){
            $query =$this->model_e->get();

            include_once('views/header.php');
            include_once('views/productApi.php');
            include_once('views/footer.php');
        }
        function product(){
            $data=NULL;
            if(isset($_REQUEST['id'])){
                $data=$this->model_e->get_id($_REQUEST['id']);    
            }
            $query=$this->model_e->get();
            include_once('views/header.php');
            include_once('views/product.php');
            include_once('views/footer.php');
        }

        function get_datosE(){

            
            $data['id']=$_REQUEST['txt_id'];
            $data['title']=$_REQUEST['txt_title'];
            $data['price']=$_REQUEST['txt_price'];
            $data['status']=$_REQUEST['txt_status'];

            if ($_REQUEST['id']=="") {
                $this->model_e->create($data);
            }
            
            if($_REQUEST['id']!=""){
                $date=$_REQUEST['id'];
                $this->model_e->update($data,$date);
            }
            
            header("Location:index.php");

        }

        function confirmarDelete(){

            $data=NULL;

            if ($_REQUEST['id']!=0) {
               $data=$this->model_e->get_id($_REQUEST['id']);
            }

            if ($_REQUEST['id']==0) {
                $date['id']=$_REQUEST['txt_id'];
                $this->model_e->delete($date['id']);
                header("Location:index.php");
            }

            include_once('views/header.php');
            include_once('views/confirm.php');
            include_once('views/footer.php');
            


        }


    }
?>