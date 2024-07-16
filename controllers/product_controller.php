<?php 
    require_once(__DIR__ . '/../models/product_model.php');
    require_once(__DIR__ . '/../models/api_client.php');
    require_once(__DIR__ . '/../controllers/api_service.php');
    require_once(__DIR__ . '/../controllers/product_controller.php');
    
    class product_controller{

        private $model_e;
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
            $config =  require_once(__DIR__ . '/../config/config.php');
            $apiClient = new ApiClient($config);

            // Crear una instancia de ApiService
            $apiService = new ApiService($apiClient, $config);
            $apiService->executeRefreshToken();
            $items = null;
           
            $items = $apiService->fetchSellerItems();
            $control_p=new product_controller();
            $control_p->update_product_items($items);
           
        
            include_once('views/header.php');
            include_once('views/productApi.php');
            include_once('views/footer.php');
        }

        
        function ordersApi(){
            $config =  require_once(__DIR__ . '/../config/config.php');
            $apiClient = new ApiClient($config);

            $apiService = new ApiService($apiClient, $config);
            $apiService->executeRefreshToken();
            $sellerOrders = null;        
           
            $sellerOrders = $apiService->getSellerOrders();               
        
            include_once('views/header.php');
            include_once('views/ordersApi.php');
            include_once('views/footer.php');
        }

    

        function newProduct(){
            // Cargar la configuración
            //$config = require '/../config/config.php';
            $config =  require_once(__DIR__ . '/../config/config.php');

            // Crear una instancia de ApiClient con la configuración
            $apiClient = new ApiClient($config);

            // Crear una instancia de ApiService
            $apiService = new ApiService($apiClient, $config);
            $apiService->executeRefreshToken();

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
                                "source" => "https://http2.mlstatic.com/D_NQ_NP_941568-MLU54924890509_042023-O.webp"
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
        
            include_once('views/header.php');
            include_once('views/newProduct.php');
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

        function update_product_items($items)
        {
            $all_products = $this->model_e->get();
            $products_map = array();
    
            foreach ($all_products as $product) {
                $products_map[$product['id']] = $product;
            }
    
            // Iterar sobre los elementos a actualizar o insertar
            foreach ($items['results'] as $item) {
                $data['id']=$item['id'];
                $data['title']=$item['title'];
                $data['price']=$item['price'];
                $data['status']=$item['condition'];
                if (isset($products_map[$item['id']])) {
                    // El producto existe, actualizar
                    $this->model_e->update($data, $item['id']);
                } else {
                    // El producto no existe, insertar
                    $this->model_e->create($data);
                }
            }

        }

            

    }
?>