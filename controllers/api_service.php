<?php

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
            print_r($response);
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
}
?>
