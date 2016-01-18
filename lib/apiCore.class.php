<?php

class apiCore {

    public function doCall($url, $data = array(), $method = "GET") {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        if (strtolower($method) == "post") {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }
        if (strtolower($method) == "put") {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0');
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
    
}

?>