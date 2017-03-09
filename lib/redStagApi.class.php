<?php

class redStagApi {

    public $url = "https://redstagfulfillment.com/backend/api/jsonrpc";
    public $end_point = "";
    public $username = "littlefishaudio";
    public $password = "FjNN75PFfE9MrBEqekBz6daeiyOlOTv4";
    public $token = "8723adcbffd867442ee89e3d99e36fd9";
    public $obj = array("jsonrpc" => "2.0", "id" => 12345, "method" => "call", "params" => array());

    public function doPostCall($url, $body) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $output = curl_exec($ch);

        /* Error Checking */
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        if ($errno != '0' && $error != '') {
            writeLog("Output: " . $output);
            writeLog("Error No: " . $errno);
            writeLog("Error: " . $error);
        }
        /* Error Checking */

        curl_close($ch);
        return $output;
    }

    public function doLogin() {
        $this->obj['method'] = 'login';
        $this->obj['params'] = array($this->username, $this->password);

        $body = json_encode($this->obj);
        $data = $this->doPostCall($this->url, $body);
        $data = json_decode($data, true);
        $_SESSION['RED_STAG_SESSION'] = $data['result'];
        return $data['result'];
    }

    public function createOrder($product_data, $shipping_data, $additional_data) {
        $this->obj['method'] = 'call';
        $this->obj['params'] = array($this->token, 'order.create', array('', $product_data, $shipping_data, $additional_data));

        $body = json_encode($this->obj);
        $data = $this->doPostCall($this->url, $body);
        $data = json_decode($data, true);
        return $data;
    }

    public function getOrder($order_unique_id = '12345', $field_data = array()) {
        $this->obj['method'] = 'call';
        $this->obj['params'] = array($this->token, 'order.info', array($order_unique_id, $field_data));

        $body = json_encode($this->obj);
        $data = $this->doPostCall($this->url, $body);
        $data = json_decode($data, true);
        return $data;
    }

    public function getTrackingNumber($tracking_data) {
        if (count($tracking_data) > 0) {
            $tracking_no = '';
            foreach ($tracking_data as $each_tracking_data) {
                $tracking_no .= $each_tracking_data['number'] . ",";
            }
            $tracking_no = trim($tracking_no, ",");
            if ($tracking_no == '')
                return 0;
            else
                return $tracking_no;
        }
        return 0;
    }

    public function callm() {

        $data = array();
        $data['jsonrpc'] = '2.0';
        $data['id'] = 12344;
        $data['method'] = 'call';
        //$data['params'] = array('8723adcbffd867442ee89e3d99e36fd9',  'product.info', array('62ee5023-39f7-4acb-822e-dc8879423d6f'));
        $data['params'] = array($_SESSION['RED_STAG_SESSION'], 'order.create', array('', array("ISOL8R130" => "1"),
                array('firstname' => 'Tina', 'lastname' => 'Martorella', 'street1' => '5123 Mill Store Rd Farmhouse Restaurant', 'city' => 'Lake Park', 'region' => 'GA', 'postcode' => '31636-5103', 'country' => 'US', 'phone' => '229 630 8047'),
                array('shipping_method' => 'usps_US-PM', 'signature_required' => 'none')
        ));

        $body = json_encode($data);
        $data = $this->doPostCall($this->url, $body);
        $data = json_decode($data, true);

        /* Validate Token Expiration */
        if (isset($data['error']['code'])) {
            if ((($data['error']['code'] * -1) - 32000) == 5) {
                echo "<br>first: " . $_SESSION['RED_STAG_SESSION'];
                $this->doLogin();
                echo "<br>Second: " . $_SESSION['RED_STAG_SESSION'];
                $data = $this->callm();
            }
        }
        /* Validate Token Expiration */

        return $data;
    }

    public function search() {

        $data = array();
        $data['jsonrpc'] = '2.0';
        $data['id'] = 12344;
        $data['method'] = 'call';
        //$data['params'] = array('8723adcbffd867442ee89e3d99e36fd9',  'product.info', array('62ee5023-39f7-4acb-822e-dc8879423d6f'));
        $data['params'] = array($_SESSION['RED_STAG_SESSION'], 'product.search', array(null, array("limit" => 100)));
        //$data['params'] = array($_SESSION['RED_STAG_SESSION'], 'product.search', array(array("sku" => array("eq"=>"mg10xuc"))));
        //$data['params'] = array($_SESSION['RED_STAG_SESSION'], 'order.search', array(array("status" => array("eq"=>"2")),null,array("sku")));
        //$data['params'] = array($_SESSION['RED_STAG_SESSION'], 'order.search', array(null,null,array("sku" => array("eq"=>"mg10xuc"))));

        $body = json_encode($data);
        $data = $this->doPostCall($this->url, $body);
        $data = json_decode($data, true);

        return $data;
    }

}

?>
