<?php

/**
 *  Class file to provide core
 *  functions for API Calls
 * 
 *  i.e. 
 *  Curl requests
 *  Handling SOAP Calls
 *  Handling XML Responses
 *  Handling JSON Responses
 *  
 * @author dave.jay90@gmail.com
 * @since January 17, 2017
 * @version 1.0
 * 
 * 
 */
class apiCore {

    public function doCall($url) {
        $ch = curl_init();
        $timeout = 5;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);        
        //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Ocp-Apim-Subscription-Key: 38cc68f8de3743d5888d660aa07dc742','ecd-subscription-key: 59de1ed8a37b481a8e3a6c25dbe764fc'));
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public function prepareApiUrl() {
        $params = array();
        foreach ($this->params as $option => $value) {
            $params[] = "{$option}=" . urlencode($value);
        }
        return $this->apiURL . $this->apiEndpoint . "?" . (implode("&", $params));
    }

    public function doPostCall($url, $body) { 
        //$body = json_encode($body);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Ocp-Apim-Subscription-Key: 38cc68f8de3743d5888d660aa07dc742','ecd-subscription-key: 59de1ed8a37b481a8e3a6c25dbe764fc'));
        $output = curl_exec($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);        
        curl_close($ch);
        return $output;
    }

    public function doJSONCall($url, $body) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);

        $output = curl_exec($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($output, 0, $header_size);
        $body = substr($output, $header_size);

        curl_close($ch);
        return array($output, $body, $header);
    }
    
    public function doFormCall($url, $body) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $output = curl_exec($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);

        curl_close($ch);
        if($errno!='0'){
            writeLog("Error Code: ".$errno."\nError: ".$error);
        }
        return $output;
    }
    
    public function doDearCall($url, $body) {
        echo $body;
        
        $ch = curl_init();
        //curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: '.  strlen($body),'api-auth-accountid: josh@littlefishaudio.com','api-auth-applicationkey: Bbibbitt76!'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','api-auth-accountid: cf27b49e-56e4-4023-9946-8e592e96a3f5','api-auth-applicationkey: 96998997-f5d8-5f61-c79d-8f2724311c5b'));
        $output = curl_exec($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);        
        curl_close($ch);
        writeLog("1".$output);
        writeLog("2".$errno);
        writeLog("3".$error);
        return $output;
    }

}

?>
