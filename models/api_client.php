<?php
    /**
     * Clase principal para manipular el API 
     * @author Ysariol
     */

class ApiClient {
    private $app_id;
    private $secret_key;
    private $refresh_token;
    private $api_base_url;
    private $access_token;

    public function __construct($config) {
        $this->app_id = $config['app_id'];
        $this->secret_key = $config['secret_key'];
        $this->refresh_token = $config['refresh_token'];
        $this->api_base_url = rtrim($config['api_base_url'], '/');
        $this->access_token = null;
    }

    public function request($endpoint, $params = [], $headers = [], $method = 'POST') {
        $url = $this->api_base_url . '/' . ltrim($endpoint, '/');

        $ch = curl_init($url);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        } elseif ($method === 'GET') {
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            if (!empty($params)) {
                $url .= '?' . http_build_query($params);
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge([
            'accept: application/json',
            'content-type: application/json'
        ], $headers));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
            return null;
        } else {
            $response_data = json_decode($response, true);
            return $response_data;
        }

        curl_close($ch);
    }

    public function refreshToken() {
        $params = [
            'grant_type' => 'refresh_token',
            'client_id' => $this->app_id,
            'client_secret' => $this->secret_key,
            'refresh_token' => $this->refresh_token
        ];

        $response = $this->request('/oauth/token', $params);
        if ($response && isset($response['access_token'])) {
            $this->access_token = $response['access_token'];
        }

        return $response;
    }

    public function getSellerItems($site_id, $seller_id) {
        $endpoint = "/sites/$site_id/search";
        $params = ['seller_id' => $seller_id];
        $headers = ['Authorization: Bearer ' . $this->access_token];

        return $this->request($endpoint, $params, $headers, 'GET');
    }

    public function createItem($itemData) {
        $endpoint = "/items";
        $headers = ['Authorization: Bearer ' . $this->access_token];

        return $this->request($endpoint, $itemData, $headers, 'POST');
    }

    public function getSellerOrders($seller_id) {
        $endpoint = "/orders/search";
        $params = ['seller' => $seller_id];
        $headers = ['Authorization: Bearer ' . $this->access_token];

        return $this->request($endpoint, $params, $headers, 'GET');
    }

    public function getUserItems($seller_id) {
        $endpoint = "/users/$seller_id/items/search";
        $headers = ['Authorization: Bearer ' . $this->access_token];

        return $this->request($endpoint, [], $headers, 'GET');
    }

    public function getItemsByIds($item_ids) {
        $endpoint = "/items";
        $params = ['ids' => implode(',', $item_ids)];
        $headers = ['Authorization: Bearer ' . $this->access_token];

        return $this->request($endpoint, $params, $headers, 'GET');
    }
    
    public function getAccessToken() {
        return $this->access_token;
    }

}
?>