<?php

class dearSystemApi {

    public $url = "https://inventory.dearsystems.com/ExternalApi/";
    public $end_point = "";
    public $api_id = "cf27b49e-56e4-4023-9946-8e592e96a3f5";
    public $api_key = "96998997-f5d8-5f61-c79d-8f2724311c5b";

    public function doCall($url, $method = 'GET', $body = array()) {
        $ch = curl_init();
        if ($method == "POST") {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }
        else if ($method == "PUT") {
            curl_setopt($ch, CURLOPT_PUT, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'api-auth-accountid: '.$this->api_id, 'api-auth-applicationkey: '.$this->api_key));
        $output = curl_exec($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        curl_close($ch);
        return $output;
    }
    
    public function getSaleById($Id){
        $url = $this->url."Sale?ID=".$Id;
        $data = $this->doCall($url);
        $data = json_decode($data,true);
        return $data;
    }
    public function getSalesList($page="1",$limit="10",$from_date=''){
        if($from_date!=''){
            $filter = "createdSince={$from_date}&";
        }
        $url = $this->url."SaleList?".$filter."page=".$page."&Limit".$limit;
        $data = $this->doCall($url);
        $data = json_decode($data,true);
        return $data;
    }
    public function createShip($ship_data = array()){
        if($from_date!=''){
            $filter = "createdSince={$from_date}&";
        }
        $url = $this->url."SaleShip";
        $body = json_encode($ship_data);
        $data = $this->doCall($url,"POST",$body);
        return $data;
        //$data = json_decode($data,true);
        //return $data;
    }

}

?>
