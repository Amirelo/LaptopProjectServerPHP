<?php 
class Response{
    public $response_code;
    public $message;
    public $data;

    public function __construct($response_code, $message, $data){
        $this->response_code = $response_code;
        $this->message = $message;
        $this->data = $data;
    }

    public function getResponseCode() {
        return $this->response_code;
    }

    public function setResponseCode($response_code) {
        $this->response_code = $response_code;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function getData(){
        return $this->data;
    }
    
    public function setData($data){
        $this->data = $data;
    }

}

?>