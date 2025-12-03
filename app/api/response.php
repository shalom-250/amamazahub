<?php
class ApiResponse {
    public $success;
    public $message;
    public $data;
    public $timestamp;
    public $pagination;
    
    public function __construct($success, $message = '', $data = null, $pagination = null) {
        $this->success = $success;
        $this->message = $message;
        $this->data = $data;
        $this->pagination = $pagination;
        $this->timestamp = date('c');
    }
}

class ApiError {
    public $error;
    public $code;
    public $details;
    public $timestamp;
    
    public function __construct($error, $code = 400, $details = null) {
        $this->error = $error;
        $this->code = $code;
        $this->details = $details;
        $this->timestamp = date('c');
    }
}

function sendResponse($response, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json');
    
    if ($response instanceof ApiError) {
        echo json_encode($response, JSON_PRETTY_PRINT);
    } else {
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
    exit;
}
?>