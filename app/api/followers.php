<?php
include_once 'database.php';
require_once 'response.php';
require_once '../auth/action.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

class FollowAPI {
    private $conn;
    private $table_name = "follows";
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    // Follow user
    public function followUser($follower_id, $following_id) {
        try {
            if ($follower_id == $following_id) {
                throw new Exception('Cannot follow yourself', 400);
            }
            
            // Check if already following
            $check_query = "SELECT id FROM " . $this->table_name . " 
                           WHERE follower_id = :follower_id AND following_id = :following_id AND status = 'active'";
            $check_stmt = $this->conn->prepare($check_query);
            $check_stmt->bindParam(':follower_id', $follower_id);
            $check_stmt->bindParam(':following_id', $following_id);
            $check_stmt->execute();
            
            if ($check_stmt->rowCount() > 0) {
                throw new Exception('Already following this user', 409);
            }
            
            // Check if user exists
            $user_query = "SELECT id FROM users WHERE id = :following_id AND status = 'active'";
            $user_stmt = $this->conn->prepare($user_query);
            $user_stmt->bindParam(':following_id', $following_id);
            $user_stmt->execute();
            
            if ($user_stmt->rowCount() == 0) {
                throw new Exception('User not found', 404);
            }
            
            $query = "INSERT INTO " . $this->table_name . " 
                     SET follower_id=:follower_id, following_id=:following_id";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':follower_id', $follower_id);
            $stmt->bindParam(':following_id', $following_id);
            
            if ($stmt->execute()) {
                // Update followers/following counts
                $this->updateFollowCounts($follower_id, $following_id, 'follow');
                
                return new ApiResponse(true, 'User followed successfully');
            }
            
            throw new Exception('Unable to follow user', 500);
            
        } catch (Exception $e) {
            return new ApiError($e->getMessage(), $e->getCode());
        }
    }
    
    // Unfollow user
    public function unfollowUser($follower_id, $following_id) {
        try {
            $query = "UPDATE " . $this->table_name . " SET status = 'removed' 
                     WHERE follower_id = :follower_id AND following_id = :following_id";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':follower_id', $follower_id);
            $stmt->bindParam(':following_id', $following_id);
            
            if ($stmt->execute() && $stmt->rowCount() > 0) {
                // Update followers/following counts
                $this->updateFollowCounts($follower_id, $following_id, 'unfollow');
                
                return new ApiResponse(true, 'User unfollowed successfully');
            }
            
            throw new Exception('Not following this user', 404);
            
        } catch (Exception $e) {
            return new ApiError($e->getMessage(), $e->getCode());
        }
    }
    
    // Get user followers
    public function getFollowers($user_id, $page = 1, $limit = 20) {
        try {
            $offset = ($page - 1) * $limit;
            
            $count_query = "SELECT COUNT(*) as total FROM " . $this->table_name . " 
                           WHERE following_id = :user_id AND status = 'active'";
            $count_stmt = $this->conn->prepare($count_query);
            $count_stmt->bindParam(':user_id', $user_id);
            $count_stmt->execute();
            $total = $count_stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            $query = "SELECT f.*, u.username, u.display_name, u.profile_pic_url, u.bio 
                      FROM " . $this->table_name . " f
                      JOIN users u ON f.follower_id = u.id
                      WHERE f.following_id = :user_id AND f.status = 'active'
                      ORDER BY f.created_at DESC 
                      LIMIT :limit OFFSET :offset";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            
            $followers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $pagination = [
                'current_page' => (int)$page,
                'per_page' => (int)$limit,
                'total_items' => (int)$total,
                'total_pages' => ceil($total / $limit)
            ];
            
            return new ApiResponse(true, 'Followers retrieved successfully', $followers, $pagination);
            
        } catch (Exception $e) {
            return new ApiError($e->getMessage(), $e->getCode());
        }
    }
    
    // Get user following
    public function getFollowing($user_id, $page = 1, $limit = 20) {
        try {
            $offset = ($page - 1) * $limit;
            
            $count_query = "SELECT COUNT(*) as total FROM " . $this->table_name . " 
                           WHERE follower_id = :user_id AND status = 'active'";
            $count_stmt = $this->conn->prepare($count_query);
            $count_stmt->bindParam(':user_id', $user_id);
            $count_stmt->execute();
            $total = $count_stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            $query = "SELECT f.*, u.username, u.display_name, u.profile_pic_url, u.bio 
                      FROM " . $this->table_name . " f
                      JOIN users u ON f.following_id = u.id
                      WHERE f.follower_id = :user_id AND f.status = 'active'
                      ORDER BY f.created_at DESC 
                      LIMIT :limit OFFSET :offset";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            
            $following = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $pagination = [
                'current_page' => (int)$page,
                'per_page' => (int)$limit,
                'total_items' => (int)$total,
                'total_pages' => ceil($total / $limit)
            ];
            
            return new ApiResponse(true, 'Following retrieved successfully', $following, $pagination);
            
        } catch (Exception $e) {
            return new ApiError($e->getMessage(), $e->getCode());
        }
    }
    
    // Check follow status
    public function checkFollowStatus($follower_id, $following_id) {
        try {
            $query = "SELECT id FROM " . $this->table_name . " 
                     WHERE follower_id = :follower_id AND following_id = :following_id AND status = 'active'";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':follower_id', $follower_id);
            $stmt->bindParam(':following_id', $following_id);
            $stmt->execute();
            
            $is_following = $stmt->rowCount() > 0;
            
            return new ApiResponse(true, 'Follow status retrieved', ['is_following' => $is_following]);
            
        } catch (Exception $e) {
            return new ApiError($e->getMessage(), $e->getCode());
        }
    }
    
    // Helper methods
    private function updateFollowCounts($follower_id, $following_id, $action) {
        if ($action === 'follow') {
            // Increment follower's following count and following user's followers count
            $query1 = "UPDATE users SET following_count = following_count + 1 WHERE id = :follower_id";
            $query2 = "UPDATE users SET followers_count = followers_count + 1 WHERE id = :following_id";
        } else {
            // Decrement follower's following count and following user's followers count
            $query1 = "UPDATE users SET following_count = GREATEST(following_count - 1, 0) WHERE id = :follower_id";
            $query2 = "UPDATE users SET followers_count = GREATEST(followers_count - 1, 0) WHERE id = :following_id";
        }
        
        $stmt1 = $this->conn->prepare($query1);
        $stmt1->bindParam(':follower_id', $follower_id);
        $stmt1->execute();
        
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->bindParam(':following_id', $following_id);
        $stmt2->execute();
    }
}

// Handle requests
$method = $_SERVER['REQUEST_METHOD'];
$followAPI = new FollowAPI();

switch($method) {
    case 'GET':
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 20;
        
        if (isset($_GET['user_id']) && isset($_GET['type']) && $_GET['type'] === 'followers') {
            $response = $followAPI->getFollowers($_GET['user_id'], $page, $limit);
        } elseif (isset($_GET['user_id']) && isset($_GET['type']) && $_GET['type'] === 'following') {
            $response = $followAPI->getFollowing($_GET['user_id'], $page, $limit);
        } elseif (isset($_GET['follower_id']) && isset($_GET['following_id'])) {
            $response = $followAPI->checkFollowStatus($_GET['follower_id'], $_GET['following_id']);
        } else {
            $response = new ApiError('Invalid parameters', 400);
        }
        break;
        
    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);
        if (!isset($input['follower_id']) || !isset($input['following_id'])) {
            $response = new ApiError('Follower ID and Following ID are required', 400);
        } else {
            $response = $followAPI->followUser($input['follower_id'], $input['following_id']);
        }
        break;
        
    case 'DELETE':
        $input = json_decode(file_get_contents('php://input'), true);
        if (!isset($input['follower_id']) || !isset($input['following_id'])) {
            $response = new ApiError('Follower ID and Following ID are required', 400);
        } else {
            $response = $followAPI->unfollowUser($input['follower_id'], $input['following_id']);
        }
        break;
        
    default:
        $response = new ApiError('Method not allowed', 405);
}

sendResponse($response);
echo "FOLLOWERS API REACHED";
?>
