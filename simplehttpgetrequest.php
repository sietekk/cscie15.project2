<?php

/*
 * A simple HTTP GET request wrapper class on cURL for
 * parameterless RESTful APIs that return JSON.
 *
 * @author Michael Conroy
*/

class SimpleHttpGetRequest {

    protected $__url;
    protected $__options;
    protected $__timeout = 30;
    protected $__http;
    protected $__data;
    protected $__status;
    protected $__transactionInfo;

    public function __construct() {
        $this->__options = $this->generateOptions($this->__url, $this->__timeout);
        $this->__http = curl_init();
        curl_setopt_array($this->__http, $this->__options);
    }

    public function __destruct() {
        if (is_resource($this->__http)) {
            curl_close($this->__http);
        }

        $this->__http = null;
    }

    private function generateOptions($url, $timeout) {
        $useragent;
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $useragent = $_SERVER['HTTP_USER_AGENT'];
        } else {
            $useragent = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2';
        }

        return array(
            CURLOPT_HTTPGET => true,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => $timeout,
            CURLOPT_HEADER => false,
            CURLOPT_USERAGENT => $useragent
        );
    }

    public function reset() {
        $this->__destruct();
        $this->__url = null;
        $this->__data = null;
        $this->__status = null;
        $this->__transactionInfo = null;
        $this->__construct();
    }

    public function get() {
        if (!$this->__url) {
            throw new SimpleHttpGetRequestException('URL not set. Please set a valid URL.');
        }

        $this->__data = curl_exec($this->__http);

        if ($this->__data === false) {
            throw new SimpleHttpGetRequestCurlException($this->__http);
        }
        $this->__status = curl_getinfo($this->__http, CURLINFO_HTTP_CODE);
        $this->__transactionInfo = curl_getinfo($this->__http);

        return $this->__data;
    }

    public function setURL($url = null) {
        if ($url === null) {
            throw new SimpleHttpGetRequestException('Expected a URL. Please specify a valid URL.');
        }

        $this->__url = $url;

        curl_setopt($this->__http, CURLOPT_URL, $url);
    }

    public function getData() {
        if (empty($this->__data)) {
            throw new SimpleHttpGetRequestException('No data. Make sure the request was performed.');
        }

        return $this->__data;
    }

    public function getStatus() {
        if (empty($this->__data)) {
            throw new SimpleHttpGetRequestException('No status. Make sure the request was performed.');
        }

        return $this->__status;
    }

    public function getTransactionInfo($key = null) {
        if (empty($this->__data)) {
            throw new SimpleHttpGetRequestException('No transaction info. Make sure the request was performed.');
        }

        if ($key === null) {
            return $this->__transactionInfo;
        } elseif (isset($this->__transactionInfo[$key])) {
            return $this->__transactionInfo[$key];
        } else {
            throw new SimpleHttpGetRequestException('There is no such key: '.$key);
        }
    }
}


/**
 * Exception Classes
 */
class SimpleHttpGetRequestException extends Exception {
    public function __construct($message)
    {
        $this->message = $message;
    }
}

class SimpleHttpGetRequestCurlException extends SimpleHttpGetRequestException {
    public function __construct($curlHandler)
    {
        $this->message = curl_error($curlHandler);
        $this->code = curl_errno($curlHandler);
    }
}
?>
