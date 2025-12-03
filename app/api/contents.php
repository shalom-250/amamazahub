<?php
require_once '../config/database.php';
require_once '../config/response.php';
require_once '../middleware/auth.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

class ContentAPI {
    private $conn;
    private $table_name = "contents";
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    // Create new content
    public function createContent($user_id, $data) {
        try {
            if (!isset($data['media_type'])) {
                throw new Exception('Media type is required', 400);
            }
            
            $query = "INSERT INTO " . $this->table_name . " 
                     SET user_id=:user_id, title=:title, description=:description, 
                         media_url=:media_url, media_type=:media_type, thumbnail_url=:thumbnail_url,
                         visibility=:visibility, tags=:tags, location=:location, language=:language";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':title', $data['title'] ?? null);
            $stmt->bindParam(':description', $data['description'] ?? null);
            $stmt->bindParam(':media_url', $data['media_url'] ?? null);
            $stmt->bindParam(':media_type', $data['media_type']);
            $stmt->bindParam(':thumbnail_url', $data['thumbnail_url'] ?? null);
            $stmt->bindParam(':visibility', $data['visibility'] ?? 'public');
            $stmt->bindParam(':location', $data['location'] ?? null);
            $stmt->bindParam(':language', $data['language'] ?? 'en');
            
            $tags = isset($data['tags']) ? json_encode($data['tags']) : null;
            $stmt->bindParam(':tags', $tags);
            
            if ($stmt->execute()) {
                $content_id = $this->conn->lastInsertId();
                $content = $this->getContentById($content_id);
                return new ApiResponse(true, 'Content created successfully', $content);
            }
            
            throw new Exception('Unable to create content', 500);
            
        } catch (Exception $e) {
            return new ApiError($e->getMessage(), $e->getCode());
        }
    }
    
    // Get all contents with pagination
    public function getContents($page = 1, $limit = 10, $filters = []) {
        try {
            $offset = ($page - 1) * $limit;
            
            $where_clause = "WHERE status = 'active'";
            $params = [];
            
            if (isset($filters['user_id'])) {
                $where_clause .= " AND user_id = :user_id";
                $params[':user_id'] = $filters['user_id'];
            }
            
            if (isset($filters['media_type'])) {
                $where_clause .= " AND media_type = :media_type";
                $params[':media_type'] = $filters['media_type'];
            }
            
            // Get total count
            $count_query = "SELECT COUNT(*) as total FROM " . $this->table_name . " " . $where_clause;
            $count_stmt = $this->conn->prepare($count_query);
            $count_stmt->execute($params);
            $total = $count_stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            // Get contents
            $query = "SELECT c.*, u.username, u.display_name, u.profile_pic_url 
                      FROM " . $this->table_name . " c 
                      LEFT JOIN users u ON c.user_id = u.id 
                      " . $where_clause . " 
                      ORDER BY c.created_at DESC 
                      LIMIT :limit OFFSET :offset";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            
            $stmt->execute();
            $contents = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Parse JSON fields
            foreach ($contents as &$content) {
                if ($content['tags']) {
                    $content['tags'] = json_decode($content['tags'], true);
                }
            }
            
            $pagination = [
                'current_page' => (int)$page,
                'per_page' => (int)$limit,
                'total_items' => (int)$total,
                'total_pages' => ceil($total / $limit)
            ];
            
            return new ApiResponse(true, 'Contents retrieved successfully', $contents, $pagination);
            
        } catch (Exception $e) {
            return new ApiError($e->getMessage(), $e->getCode());
        }
    }
    
    // Get single content
    public function getContent($content_id) {
        try {
            $content = $this->getContentById($content_id);
            if (!$content) {
                throw new Exception('Content not found', 404);
            }
            
            // Increment view count
            $this->incrementViewCount($content_id);
            
            return new ApiResponse(true, 'Content retrieved successfully', $content);
            
        } catch (Exception $e) {
            return new ApiError($e->getMessage(), $e->getCode());
        }
    }
    
    // Update content
    public function updateContent($content_id, $user_id, $data) {
        try {
            // Verify ownership
            $content = $this->getContentById($content_id);
            if (!$content || $content['user_id'] != $user_id) {
                throw new Exception('Content not found or access denied', 404);
            }
            
            $allowed_fields = ['title', 'description', 'media_url', 'thumbnail_url', 'visibility', 'tags', 'location'];
            $update_fields = [];
            $params = [':id' => $content_id];
            
            foreach ($allowed_fields as $field) {
                if (isset($data[$field])) {
                    $update_fields[] = "$field = :$field";
                    $params[":$field"] = $field === 'tags' ? json_encode($data[$field]) : $data[$field];
                }
            }
            
            if (empty($update_fields)) {
                throw new Exception('No valid fields to update', 400);
            }
            
            $query = "UPDATE " . $this->table_name . " SET " . implode(', ', $update_fields) . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            
            if ($stmt->execute($params)) {
                $content = $this->getContentById($content_id);
                return new ApiResponse(true, 'Content updated successfully', $content);
            }
            
            throw new Exception('Unable to update content', 500);
            
        } catch (Exception $e) {
            return new ApiError($e->getMessage(), $e->getCode());
        }
    }
    
    // Delete content
    public function deleteContent($content_id, $user_id) {
        try {
            // Verify ownership
            $content = $this->getContentById($content_id);
            if (!$content || $content['user_id'] != $user_id) {
                throw new Exception('Content not found or access denied', 404);
            }
            
            $query = "UPDATE " . $this->table_name . " SET status = 'deleted' WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $content_id);
            
            if ($stmt->execute()) {
                return new ApiResponse(true, 'Content deleted successfully');
            }
            
            throw new Exception('Unable to delete content', 500);
            
        } catch (Exception $e) {
            return new ApiError($e->getMessage(), $e->getCode());
        }
    }
    
    // Helper methods
    private function getContentById($content_id) {
        $query = "SELECT c.*, u.username, u.display_name, u.profile_pic_url 
                  FROM " . $this->table_name . " c 
                  LEFT JOIN users u ON c.user_id = u.id 
                  WHERE c.id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $content_id);
        $stmt->execute();
        
        $content = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($content && $content['tags']) {
            $content['tags'] = json_decode($content['tags'], true);
        }
        
        return $content;
    }
    
    private function incrementViewCount($content_id) {
        $query = "UPDATE " . $this->table_name . " SET views_count = views_count + 1 WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $content_id);
        $stmt->execute();
    }
}

// Handle requests
$method = $_SERVER['REQUEST_METHOD'];
$contentAPI = new ContentAPI();

switch($method) {
    case 'GET':
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $filters = array_filter($_GET, function($key) {
            return in_array($key, ['user_id', 'media_type']);
        }, ARRAY_FILTER_USE_KEY);
        
        if (isset($_GET['id'])) {
            $response = $contentAPI->getContent($_GET['id']);
        } else {
            $response = $contentAPI->getContents($page, $limit, $filters);
        }
        break;
        
    case 'POST':
        try {
            $user = AuthMiddleware::authenticate();
            $input = json_decode(file_get_contents('php://input'), true);
            $response = $contentAPI->createContent($user['id'], $input);
        } catch (Exception $e) {
            $response = new ApiError($e->getMessage(), $e->getCode());
        }
        break;
        
    case 'PUT':
        try {
            $user = AuthMiddleware::authenticate();
            $input = json_decode(file_get_contents('php://input'), true);
            $content_id = isset($_GET['id']) ? $_GET['id'] : null;
            
            if (!$content_id) {
                throw new Exception('Content ID is required', 400);
            }
            
            $response = $contentAPI->updateContent($content_id, $user['id'], $input);
        } catch (Exception $e) {
            $response = new ApiError($e->getMessage(), $e->getCode());
        }
        break;
        
    case 'DELETE':
        try {
            $user = AuthMiddleware::authenticate();
            $content_id = isset($_GET['id']) ? $_GET['id'] : null;
            
            if (!$content_id) {
                throw new Exception('Content ID is required', 400);
            }
            
            $response = $contentAPI->deleteContent($content_id, $user['id']);
        } catch (Exception $e) {
            $response = new ApiError($e->getMessage(), $e->getCode());
        }
        break;
        
    default:
        $response = new ApiError('Method not allowed', 405);
}

sendResponse($response);
?>