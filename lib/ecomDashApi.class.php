<?php

class ecomDashApi {

    public $url = "https://ecomdash.azure-api.net/api/";
    public $ocp_apim_Subscription_Key = "38cc68f8de3743d5888d660aa07dc742";
    public $ecd_Subscription_Key = "59de1ed8a37b481a8e3a6c25dbe764fc";

    public function doCall($url,$method = "GET",$body = '') {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if($method=="POST"){
            curl_setopt($ch, CURLOPT_POST, true);
        }else if($method=="PUT"){
            curl_setopt($ch, CURLOPT_PUT, true);
        }
        if($body!=''){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Ocp-Apim-Subscription-Key: '.$this->ocp_apim_Subscription_Key, 'ecd-subscription-key: '.$this->ecd_Subscription_Key));
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    
    public function getSuppliers(){
        $url = $this->url."/Suppliers?pageNumber=1&resultsPerPage=25";
        $data = $this->doCall($url);
        return json_decode($data,true);
    }
    public function getOrders($body){
        $body = json_encode($body);
        $url = $this->url."/orders/getOrders";
        $data = $this->doCall($url,"POST",$body);
        return json_decode($data,true);
    }
    public function getOrderById($body){
        $body = json_encode($body);
        $url = $this->url."/orders/getOrder";
        $data = $this->doCall($url,"POST",$body);
        return json_decode($data,true);
    }
    public function createShipments($body){
        $body = json_encode($body);
        $url = $this->url."/Shipments/Create";
        $data = $this->doCall($url,"POST",$body);
        return json_decode($data,true);
    }
    public function createShip($body){
        $body = json_encode($body);
        $url = $this->url."/Shipments/submitTrackingInfo";
        $data = $this->doCall($url,"POST",$body);
        return json_decode($data,true);
    }

}

?>
