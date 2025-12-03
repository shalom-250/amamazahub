<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

class MessageAPI {
    private $initialized;
    private $db_connection;
    
    public function __construct($init_param = true) {
        $this->initialized = $init_param;
        $this->initializeDatabase();
    }
    
    private function initializeDatabase() {
        // Database configuration - replace with your actual credentials
        $host = 'localhost';
        $dbname = 'message_system';
        $username = 'username';
        $password = 'password';
        
        try {
            $this->db_connection = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                $username,
                $password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            $this->db_connection = null;
        }
    }
    
    /**
     * Main API function that handles the workflow
     */
    public function handleRequest() {
        try {
            // Check if API is initialized
            if (!$this->initialized) {
                return $this->sendResponse(false, 'API not initialized', null, 400);
            }
            
            // Get request method and data
            $method = $_SERVER['REQUEST_METHOD'];
            $input = json_decode(file_get_contents('php://input'), true);
            
            switch ($method) {
                case 'POST':
                    return $this->handlePostRequest($input);
                case 'GET':
                    return $this->handleGetRequest($_GET);
                default:
                    return $this->sendResponse(false, 'Method not allowed', null, 405);
            }
            
        } catch (Exception $e) {
            return $this->sendResponse(false, 'Server error: ' . $e->getMessage(), null, 500);
        }
    }
    
    private function handlePostRequest($data) {
        if (!isset($data['action'])) {
            return $this->sendResponse(false, 'Action parameter required', null, 400);
        }
        
        switch ($data['action']) {
            case 'check_email':
                return $this->checkEmailAndGetMessages($data);
            case 'send_message':
                return $this->sendMessage($data);
            default:
                return $this->sendResponse(false, 'Invalid action', null, 400);
        }
    }
    
    private function handleGetRequest($params) {
        if (isset($params['action']) && $params['action'] === 'get_messages') {
            return $this->getMessages($params);
        }
        
        return $this->sendResponse(false, 'Invalid GET action', null, 400);
    }
    
    /**
     * Check email and retrieve messages
     */
    private function checkEmailAndGetMessages($data) {
        // Validate email
        if (!isset($data['email']) || empty($data['email'])) {
            return $this->sendResponse(false, 'Email parameter is required', null, 400);
        }
        
        $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->sendResponse(false, 'Invalid email format', null, 400);
        }
        
        // Check if email exists in database
        $userExists = $this->checkUserExists($email);
        
        if (!$userExists) {
            return $this->sendResponse(false, 'Email not found in system', null, 404);
        }
        
        // Get messages for the user
        $messages = $this->getUserMessages($email);
        
        return $this->sendResponse(
            true, 
            'Email verified successfully', 
            [
                'email' => $email,
                'message_count' => count($messages),
                'messages' => $messages
            ],
            200
        );
    }
    
    /**
     * Send a new message
     */
    private function sendMessage($data) {
        if (!isset($data['email']) || !isset($data['message'])) {
            return $this->sendResponse(false, 'Email and message are required', null, 400);
        }
        
        $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
        $message = filter_var($data['message'], FILTER_SANITIZE_STRING);
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->sendResponse(false, 'Invalid email format', null, 400);
        }
        
        if (empty($message)) {
            return $this->sendResponse(false, 'Message cannot be empty', null, 400);
        }
        
        // Save message to database
        $messageId = $this->saveMessage($email, $message);
        
        if ($messageId) {
            return $this->sendResponse(
                true,
                'Message sent successfully',
                ['message_id' => $messageId, 'email' => $email, 'message' => $message],
                201
            );
        } else {
            return $this->sendResponse(false, 'Failed to send message', null, 500);
        }
    }
    
    /**
     * Get messages with optional filters
     */
    private function getMessages($params) {
        $email = isset($params['email']) ? filter_var($params['email'], FILTER_SANITIZE_EMAIL) : null;
        $limit = isset($params['limit']) ? intval($params['limit']) : 50;
        
        if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->sendResponse(false, 'Invalid email format', null, 400);
        }
        
        $messages = $this->getUserMessages($email, $limit);
        
        return $this->sendResponse(
            true,
            'Messages retrieved successfully',
            [
                'email' => $email,
                'limit' => $limit,
                'message_count' => count($messages),
                'messages' => $messages
            ],
            200
        );
    }
    
    // Database helper methods
    private function checkUserExists($email) {
        if (!$this->db_connection) return false;
        
        try {
            $stmt = $this->db_connection->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            return $stmt->fetch() !== false;
        } catch (PDOException $e) {
            error_log("Error checking user: " . $e->getMessage());
            return false;
        }
    }
    
    private function getUserMessages($email = null, $limit = 50) {
        if (!$this->db_connection) return [];
        
        try {
            if ($email) {
                $stmt = $this->db_connection->prepare("
                    SELECT id, email, message, created_at 
                    FROM messages 
                    WHERE email = ? 
                    ORDER BY created_at DESC 
                    LIMIT ?
                ");
                $stmt->execute([$email, $limit]);
            } else {
                $stmt = $this->db_connection->prepare("
                    SELECT id, email, message, created_at 
                    FROM messages 
                    ORDER BY created_at DESC 
                    LIMIT ?
                ");
                $stmt->execute([$limit]);
            }
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting messages: " . $e->getMessage());
            return [];
        }
    }
    
    private function saveMessage($email, $message) {
        if (!$this->db_connection) return false;
        
        try {
            $stmt = $this->db_connection->prepare("
                INSERT INTO messages (email, message, created_at) 
                VALUES (?, ?, NOW())
            ");
            $stmt->execute([$email, $message]);
            return $this->db_connection->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error saving message: " . $e->getMessage());
            return false;
        }
    }
    
    private function sendResponse($success, $message, $data = null, $httpCode = 200) {
        http_response_code($httpCode);
        
        $response = [
            'success' => $success,
            'message' => $message,
            'data' => $data,
            'timestamp' => date('c')
        ];
        
        echo json_encode($response, JSON_PRETTY_PRINT);
        return $response;
    }
}

// Initialize API with parameter set to true
$api = new MessageAPI(true);
$api->handleRequest();
?>