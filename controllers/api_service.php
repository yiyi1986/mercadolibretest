<?php
    /**
     * Clase Controladora principal para manipular el API 
     * @author Ysariol
     */
class ApiService {
    private $apiClient;
    private $config;

    public function __construct(ApiClient $apiClient, $config) {
        $this->apiClient = $apiClient;
        $this->config = $config;
    }

    public function executeRefreshToken() {
        $response = $this->apiClient->refreshToken();
        if ($response) {
            //print_r($response);
          
        } else {
            echo "Failed to refresh token.";
        }
    }

    public function fetchSellerItems() {
        $site_id = $this->config['site_id'];
        $seller_id = $this->config['seller_id'];
        return $this->apiClient->getSellerItems($site_id, $seller_id);
    }

    public function addItem($itemData) {
        return $this->apiClient->createItem($itemData);
    }

    public function getSellerOrders() {
        return $this->apiClient->getSellerOrders($this->config['seller_id']);
    }

    public function fetchUserItems() {
        $response = $this->apiClient->getUserItems($this->config['seller_id']);
        if (isset($response['results'])) {
            return $response['results'];
        }
        return null;
    }

    public function fetchItemsByIds($item_ids) {
        return $this->apiClient->getItemsByIds($item_ids);
    }
}
?>
