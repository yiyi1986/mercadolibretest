<?php 
    /**
     * Clase Controladora principal para manipular productos 
     * @author Ysariol
     */
    require_once(__DIR__ . '/../models/product_model.php');
    require_once(__DIR__ . '/../models/api_client.php');
    require_once(__DIR__ . '/../controllers/api_service.php');
    require_once(__DIR__ . '/../controllers/product_controller.php');
    
    class product_controller{

        private $model_e;
        function __construct(){
            $this->model_e=new products_model();          

        }
        //cargar vista de listado de productos de la DB
        function index(){
            $query =$this->model_e->get();

            include_once('views/header.php');
            include_once('views/index.php');
            include_once('views/footer.php');
        }

         //cargar vista de listado de productos de la API
        function productApi(){
            $config =  require_once(__DIR__ . '/../config/config.php');
            $apiClient = new ApiClient($config);

            // Crear una instancia de ApiService
            $apiService = new ApiService($apiClient, $config);
            $apiService->executeRefreshToken();
            $items = null;
           
         //   $items = $apiService->fetchSellerItems();
             $userItems = $apiService->fetchUserItems();
             if ($userItems) {
                $items = $apiService->fetchItemsByIds($userItems);
             }
            if($items != null){
                $control_p=new product_controller();
                $control_p->update_product_items($items);
            }  
        
            include_once('views/header.php');
            include_once('views/productApi.php');
            include_once('views/footer.php');
        }

         //cargar vista de listado de pedidos de la API
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

         //cargar vista de formulario para insertar producto
        function newProduct(){
            $newItem = null;
        
            include_once('views/header.php');
            include_once('views/newProduct.php');
            include_once('views/footer.php');
        }  

        //insertar producto por API y mostrar json
        function newProductApi(){
            // Cargar la configuración
            $config =  require_once(__DIR__ . '/../config/config.php');

            // Crear una instancia de ApiClient con la configuración
            $apiClient = new ApiClient($config);

            // Crear una instancia de ApiService
            $apiService = new ApiService($apiClient, $config);
            $apiService->executeRefreshToken();
            $newItem =null;             
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $itemData = [
                        "title" => $_POST['title'],
                        "category_id" => $_POST['category_id'],
                        "price" => $_POST['price'],
                        "currency_id" => $_POST['currency_id'],
                        "available_quantity" => $_POST['available_quantity'],
                        "buying_mode" => $_POST['buying_mode'],
                        "condition" => $_POST['condition'],
                        "listing_type_id" => $_POST['listing_type_id'],
                        "sale_terms" => [
                            [
                                "id" => "WARRANTY_TYPE",
                                "value_name" => $_POST['warranty_type']
                            ],
                            [
                                "id" => "WARRANTY_TIME",
                                "value_name" => $_POST['warranty_time']
                            ]
                        ],
                        "pictures" => [
                            [
                                "source" => $_POST['picture_source']
                            ]
                        ],
                        "attributes" => [
                            [
                                "id" => "BRAND",
                                "value_name" => $_POST['brand']
                            ],
                            [
                                "id" => "EAN",
                                "value_name" => $_POST['ean']
                            ]
                        ]
                    ];

                    $newItem = $apiService->addItem($itemData);
                }
        
            include_once('views/header.php');
            include_once('views/newProduct.php');
            include_once('views/footer.php');
        }

        //Obtener producto por Id
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

        //Update datos del producto en DB desde el formulario
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
        // Borrar producto en DB
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

        //Insertar o Actualizar datos del producto en DB desde el API
        function update_product_items($items)
        {
            $all_products = $this->model_e->get();
            $products_map = array();
    
            foreach ($all_products as $product) {
                $products_map[$product['id']] = $product;
            }
    
            foreach ($items as $item) {
                $data['id']=$item['body']['id'];
                $data['title']=$item['body']['title'];
                $data['price']=$item['body']['price'];
                $data['status']=$item['body']['condition'];
                if (isset($products_map[$item['body']['id']])) {
                    // El producto existe, actualizar
                    $this->model_e->update($data, $item['body']['id']);
                } else {
                    // El producto no existe, insertar
                    $this->model_e->create($data);
                }
            }

        }

    }
?>