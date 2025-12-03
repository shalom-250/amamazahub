<?php
 include_once 'db_helper.php';
 header("Content-Type:application/json");
 session_start();
/**
 * Get detailed info about a filesystem entry (file or directory).
 *
 * Returns an associative array with:
 *  - name
 *  - path (realpath)
 *  - type (mimetype)
 *  - is_file, is_dir
 *  - size_bytes, size_mb
 *  - inode
 *  - owner_uid, owner_name (if available)
 *  - group_gid, group_name (if available)
 *  - perms_octal (string like "0755")
 *  - perms_human (rwxr-xr-x)
 *  - created_at (timestamp or null)  -- on many Unix systems this is inode change time (ctime)
 *  - modified_at (timestamp)
 *  - accessed_at (timestamp)
 */









/**
 * all function must be here 
 */

function getNewFollowers() {
    $page = intval($_GET['page'] ?? 1);
    $limit = 14;
    $offset = ($page - 1) * $limit;

    // Replace '1' with current logged-in user ID
    $current_user = 1;

    $sql = "SELECT u.id, u.username, u.profile_image,
                   EXISTS(SELECT 1 FROM follows f WHERE f.follower_id = :current AND f.following_id = u.id) AS following
            FROM users u
            ORDER BY u.created_at DESC
            LIMIT :offset, :limit";

    $params = [
        ':current' => $current_user,
        ':offset' => $offset,
        ':limit' => $limit
    ];

    $res = executeQuery($sql, 'ASSOC', $params);

    if (!$res['success'] && $res['data'] === null) {
        echo json_encode(['followers' => []]);
        return;
    }

    $followers = $res['data'];

    // Get latest video for each follower
    foreach ($followers as &$follower) {
        $contentsRes = getLatestContents($follower['id'], 14);
        $follower['contents'] = $contentsRes;
        $latestVideo = array_filter($contentsRes, fn($c) => $c['media_type'] === 'video');
        if ($latestVideo) {
            $latestVideo = array_values($latestVideo)[0]; // first video
            $follower['latest_video_url'] = $latestVideo['media_url'];
            $follower['latest_video_thumbnail'] = $latestVideo['thumbnail_url'];
        } else {
            $follower['latest_video_url'] = null;
            $follower['latest_video_thumbnail'] = null;
        }
    }

    echo json_encode(['followers' => $followers]);
}

function getUserContents($user_id = null) {
    if (!$user_id) $user_id = intval($_GET['user_id'] ?? 0);
    $limit = intval($_GET['limit'] ?? 14);

    $contentsRes = getLatestContents($user_id, $limit);
    echo json_encode(['items' => $contentsRes]);
}

// Helper to fetch latest contents
function getLatestContents($user_id, $limit = 14) {
    $sql = "SELECT id, title, media_url, media_type, thumbnail_url, created_at
            FROM contents
            WHERE user_id = :uid AND status='active'
            ORDER BY created_at DESC
            LIMIT :limit";

    $params = [
        ':uid' => $user_id,
        ':limit' => $limit
    ];

    $res = executeQuery($sql, 'ASSOC', $params);
    return $res['data'] ?? [];
}

function toggleFollow() {
    $user_id = intval($_POST['user_id'] ?? 0);
    $current_user = 1; // replace with session user id

    // Check if already following
    $checkSql = "SELECT id FROM follows WHERE follower_id = :current AND following_id = :uid";
    $check = executeQuery($checkSql, 'ASSOC', [':current' => $current_user, ':uid' => $user_id]);

    if (!empty($check['data'])) {
        // Unfollow
        $delSql = "DELETE FROM follows WHERE follower_id = :current AND following_id = :uid";
        executeQuery($delSql, '', [':current' => $current_user, ':uid' => $user_id]);
    } else {
        // Follow
        $insSql = "INSERT INTO follows (follower_id, following_id) VALUES (:current, :uid)";
        executeQuery($insSql, '', [':current' => $current_user, ':uid' => $user_id]);
    }

    echo json_encode(['success' => true]);
}



 /**
 * all function must be here 
 */


$tables = executeQuery("SHOW TABLES","COLUMN")['data'];

function get_file_details(string $path): array
{
    $result = [
        'exists' => false,
        'name' => null,
        'path' => null,
        'type' => null,
        'is_file' => false,
        'is_dir' => false,
        'size_bytes' => null,
        'size_mb' => null,
        'inode' => null,
        'owner_uid' => null,
        'owner_name' => null,
        'group_gid' => null,
        'group_name' => null,
        'perms_octal' => null,
        'perms_human' => null,
        'created_at' => null,
        'modified_at' => null,
        'accessed_at' => null,
    ];

    // basic existence check
    if (!file_exists($path)) {
        return $result;
    }

    $result['exists'] = true;

    // full canonical path (if available)
    $real = realpath($path);
    $pth = $real !== false ? $real : $path;
    $result['path'] = str_replace('\\', "/\n",$pth);
    $result['name'] = basename($path);
    $result['is_file'] = is_file($path);
    $result['is_dir']  = is_dir($path);

    // size
    if (is_file($path)) {
        $size = filesize($path);
        $result['size_bytes'] = $size === false ? null : $size;
        $result['size_mb'] = ($size === false) ? null : round($size / 1024 / 1024, 3);
    } else {
        $result['size_bytes'] = null;
        $result['size_mb'] = null;
    }

    // inode & times via stat
    $st = @stat($path);
    if ($st !== false) {
        $result['inode'] = $st['ino'] ?? null;
        $result['modified_at'] = $st['mtime'] ?? null;
        $result['accessed_at'] = $st['atime'] ?? null;
        // NOTE: on many Unix systems filectime is inode-change-time, not creation time.
        $result['created_at'] = $st['ctime'] ?? null;
    }

    // owner/group
    $owner = @fileowner($path);
    if ($owner !== false) {
        $result['owner_uid'] = $owner;
        // try to resolve name if posix functions exist
        if (function_exists('posix_getpwuid')) {
            $pw = posix_getpwuid($owner);
            $result['owner_name'] = $pw['name'] ?? null;
        }
    }
    $group = @filegroup($path);
    if ($group !== false) {
        $result['group_gid'] = $group;
        if (function_exists('posix_getgrgid')) {
            $gr = posix_getgrgid($group);
            $result['group_name'] = $gr['name'] ?? null;
        }
    }

    // permissions
    $perms = fileperms($path);
    if ($perms !== false) {
        $result['perms_octal'] = sprintf('%04o', $perms & 0x0FFF);
        $result['perms_human'] = perms_to_string($perms);
    }

    // mime/type detection (for files)
    if (is_file($path)) {
        if (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            if ($finfo !== false) {
                $mt = finfo_file($finfo, $path);
                finfo_close($finfo);
                $result['type'] = $mt ?: null;
            }
        }
        // fallback
        if (empty($result['type']) && function_exists('mime_content_type')) {
            $result['type'] = @mime_content_type($path) ?: null;
        }
    } else {
        // directories can be reported as "directory"
        $result['type'] = 'directory';
    }

    return $result;
}

/**
 * Convert fileperms() int to rwxr-xr-x string.
 * Source: adapted common implementation.
 */
function perms_to_string(int $perms): string
{
    $info = '';

    // file type
    if (($perms & 0xC000) === 0xC000) {
        $info .= 's'; // socket
    } elseif (($perms & 0xA000) === 0xA000) {
        $info .= 'l'; // symbolic link
    } elseif (($perms & 0x8000) === 0x8000) {
        $info .= '-'; // regular
    } elseif (($perms & 0x6000) === 0x6000) {
        $info .= 'b'; // block special
    } elseif (($perms & 0x4000) === 0x4000) {
        $info .= 'd'; // directory
    } elseif (($perms & 0x2000) === 0x2000) {
        $info .= 'c'; // character special
    } elseif (($perms & 0x1000) === 0x1000) {
        $info .= 'p'; // fifo pipe
    } else {
        $info .= 'u'; // unknown
    }

    // owner
    $info .= (($perms & 0x0100) ? 'r' : '-');
    $info .= (($perms & 0x0080) ? 'w' : '-');
    $info .= (($perms & 0x0040) ?
                (($perms & 0x0800) ? 's' : 'x') :
                (($perms & 0x0800) ? 'S' : '-'));

    // group
    $info .= (($perms & 0x0020) ? 'r' : '-');
    $info .= (($perms & 0x0010) ? 'w' : '-');
    $info .= (($perms & 0x0008) ?
                (($perms & 0x0400) ? 's' : 'x') :
                (($perms & 0x0400) ? 'S' : '-'));

    // world
    $info .= (($perms & 0x0004) ? 'r' : '-');
    $info .= (($perms & 0x0002) ? 'w' : '-');
    $info .= (($perms & 0x0001) ?
                (($perms & 0x0200) ? 't' : 'x') :
                (($perms & 0x0200) ? 'T' : '-'));

    return $info;
}

/**
 * Recursively list a directory and return details for each entry.
 * - $path must be a directory
 * - returns array of file detail arrays
 */
// function list_directory_details(string $path, bool $recursive = false): array
// {
//     $out = [];
//     if (!is_dir($path)) return $out;

//     $it = new DirectoryIterator($path);
//     foreach ($it as $node) {
//         if ($node->isDot()) continue;
//         $p = $node->getPathname();
//         $out[] = get_file_details($p);
//         if ($recursive && $node->isDir()) {
//             $out = array_merge($out, list_directory_details($p, true));
//         }
//     }
//     return $out;
// }

/* Example usage */
// single file
// $info = get_file_details('/path/to/file.txt');
// echo json_encode($info, JSON_PRETTY_PRINT);

// directory recursive
// $all = list_directory_details('/path/to/dir', true);
// echo json_encode($all, JSON_PRETTY_PRINT);


// api.php

$action = $_POST['action'] ?? $_GET['action'] ?? '';
try{
switch ($action) {







//===================================================================
// this is new API


// ---------------- FUNCTIONS ----------------




    case 'get_new_followers':
        getNewFollowers();
        break;
    case 'get_user_contents':
        getUserContents();
        break;
    case 'toggle_follow':
        toggleFollow();
        break;




//===================================================================




























    // 1️⃣ Latest 5 blogs
    case 'get_latest_blogs':
        $stmt = $pdo->query("SELECT Blog_id, Title, Slug, Publish_Date 
                             FROM blog 
                             WHERE Status='Published' 
                             ORDER BY Publish_Date DESC 
                             LIMIT 5");
        echo json_encode(['success' => true, 'data' => $stmt->fetchAll()]);
        exit;

    case 'get_roles':
        $stmt = $pdo->query("SELECT * FROM roles WHERE status='active' ORDER BY id DESC");
        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['success' => true, 'data' => $roles]);
        exit;

    case 'get_role_permissions':
        $role_id = (int)$_POST['role_id'];
        $stmt = $pdo->prepare("SELECT table_name, can_access FROM role_permissions WHERE role_id=?");
        $stmt->execute([$role_id]);
        $perms = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
        echo json_encode(['success' => true, 'data' => $perms]);
        exit;

    case 'create_role':
        $name = trim($_POST['name'] ?? '');
        if ($name === '') exit(json_encode(['success' => false, 'error' => 'Role name required']));
        $stmt = $pdo->prepare("INSERT INTO roles (name) VALUES (?)");
        $stmt->execute([$name]);
        add_notification([
            'title'=>'Create role',
            'message'=>"Role $name has been created",
            'type'=>'add data',
            'link'=>'content?e=roles&data='.$name,
        ]);
        echo json_encode(['success' => true]);
        exit;

    case 'update_role_permissions':
        $role_id = (int)$_POST['role_id'];
        $permissions = json_decode($_POST['permissions'] ?? '{}', true);
        if (!$role_id || !$permissions) exit(json_encode(['success' => false]));

        $pdo->prepare("DELETE FROM role_permissions WHERE role_id=?")->execute([$role_id]);
        $stmt = $pdo->prepare("INSERT INTO role_permissions (role_id, table_name, can_access) VALUES (?, ?, ?)");
        foreach ($permissions as $table => $can) {
            $stmt->execute([$role_id, $table, (int)$can]);
        }

        add_notification([
            'title'=>"Updating role $role_id",
            'message'=>"Role $role_id has been updated, New data is added in table role_permissions",
            'type'=>'edit data',
            'link'=>'content',
        ]);
        echo json_encode(['success' => true]);
        exit;


    // 2️⃣ Categories list
    case 'get_categories':
        $stmt = $pdo->query("SELECT blog_category_name AS category, COUNT(b.Blog_id) AS total
                             FROM blog_categories c
                             LEFT JOIN blog b ON b.Category = c.blog_category_id
                             GROUP BY c.blog_category_id
                             ORDER BY total DESC");
        echo json_encode(['success' => true, 'data' => $stmt->fetchAll()]);
        exit;

    // 3️⃣ Latest comments
    case 'get_latest_comments':
        $stmt = $pdo->query("SELECT firstname, lastname, Email, message, createdDate
                             FROM blog_comments 
                             WHERE Status='active' 
                             ORDER BY createdDate DESC 
                             LIMIT 5");
        echo json_encode(['success' => true, 'data' => $stmt->fetchAll()]);
        exit;

    // 4️⃣ Top 5 authors
    case 'get_top_authors':
        $stmt = $pdo->query("SELECT a.blog_author_name AS author, COUNT(b.Blog_id) AS posts
                             FROM blog_author a
                             LEFT JOIN blog b ON b.Author = a.blog_author_id
                             GROUP BY a.blog_author_id
                             ORDER BY posts DESC
                             LIMIT 5");
        echo json_encode(['success' => true, 'data' => $stmt->fetchAll()]);
        exit;

    // 5️⃣ Blog page settings
    case 'get_blog_page_settings':
        $stmt = $pdo->query("SELECT view_search,view_categories,view_recent_blog,recent_blog_number,view_blog_tags,custom_html,img_after_recent_post,img_after_tag,Plain_Text_title,Plain_Text_description,blog_style,pagination_style,show_author,show_author_img,show_single_category,title_limit,description_limit,cta_label,go-to-page,show-date,show-pagination,show-comment,showCategoryIcon,number_of_post FROM blog_page LIMIT 1");
        echo json_encode(['success' => true, 'data' => $stmt->fetch(PDO::FETCH_ASSOC)]);
        exit;
    case 'update_blog_settings':
            try {
                $fields = $_POST;
                unset($fields['action']); // remove the action key

                $setParts = [];
                $params = [];
                $ntf ='';

                foreach ($fields as $key => $val) {
                    // replace invalid characters with underscore for placeholder
                    $placeholder = str_replace('-', '_', $key);
                    $setParts[] = "$key = :$placeholder";
                    $params[$placeholder] = $val;
                    $ntf.="$key, ";
                }

                $sql = "UPDATE blog_page SET " . implode(', ', $setParts) . " ORDER BY blog_page_id ASC LIMIT 1";
                $stmt = $pdo->prepare($sql);

                foreach ($params as $placeholder => $value) {
                    $stmt->bindValue(":$placeholder", $value);
                }

                $stmt->execute();
                echo json_encode(['success' => true, 'message' => 'Settings updated successfully']);
                add_notification([
            'title'=>'Blog_page data updated successfully',
            'message'=>"Data in Blog_page table has been updated columns: $ntf",
            'type'=>'Updating data',
            'link'=>'content?e=blog_page',
        ]);
            } catch (PDOException $e) {
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        add_notification([
            'title'=>'They was error in Updating blog_page table data',
            'message'=>"Role $name has been created",
            'type'=>'error',
            'link'=>'content?e=blog_page',
        ]);
            }
            exit;
        case 'get_settings':
            $stmt = $pdo->query("SELECT name, value FROM settings WHERE status = 'active'");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data = [];
            foreach ($rows as $r) $data[$r['name']] = $r['value'];
            echo json_encode(['success' => true, 'data' => $data]);
            exit;
        case 'get_table_weekly_counts':
                $counts = [];
                $days = ['mon','tue','wed','thu','fri','sat','sun'];

                try {
                    foreach ($tables as $table) {
                        $tableCounts = array_fill_keys($days, 0);

                        // Count rows per weekday (assuming created_at exists)
                            $stmt = $pdo->prepare("
                                SELECT 
                                DAYOFWEEK(created_at) AS dow, COUNT(*) AS cnt
                                FROM $table
                                WHERE created_at IS NOT NULL AND status != 'deleted'
                                GROUP BY dow
                            ");
                        $stmt->execute();

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            // MySQL DAYOFWEEK(): 1=Sun, 2=Mon, 3=Tue...7=Sat
                            $map = [1=>'sun',2=>'mon',3=>'tue',4=>'wed',5=>'thu',6=>'fri',7=>'sat'];
                            $dayName = $map[$row['dow']] ?? null;
                            if ($dayName) $tableCounts[$dayName] = (int)$row['cnt'];
                        }

                        // Add total
                        $tableCounts['total'] = array_sum($tableCounts);
                        $counts[$table] = $tableCounts;
                    }

                    echo json_encode(['success' => true, 'data' => $counts]);
                } catch (PDOException $e) {
                    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
                }
                exit;

            case 'get_new_feedback':
                try {
                    // Fetch the latest 10 active feedback entries
                    $stmt = $pdo->query("
                        SELECT name, subject, message, rating, type, created_at
                        FROM feedback
                        WHERE status = 'active'
                        ORDER BY created_at DESC 
                        LIMIT 5
                    ");
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    echo json_encode(['success' => true, 'data' => $rows]);
                } catch (PDOException $e) {
                    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
                }
                exit;
            case 'get_latest_newsletters':
                    try {
                        // Fetch latest 5 subscribers
                        $stmt = $pdo->prepare("
                            SELECT email, status, created_at
                            FROM subscribers
                            ORDER BY created_at DESC limit 10
                        ");
                        $stmt->execute();
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        echo json_encode(['success' => true, 'data' => $rows]);
                    } catch (PDOException $e) {
                        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
                    }
                    exit;

                // Save message (as sent or draft)
            case 'save_message':
                    try {
                        $recipient = trim($_POST['recipient'] ?? '');
                        $subject   = trim($_POST['subject'] ?? '');
                        $message   = trim($_POST['message'] ?? '');
                        $status    = ($_POST['status'] ?? 'draft') === 'sent' ? 'sent' : 'draft';

                        if (empty($recipient) || empty($message)) {
                            echo json_encode(['success' => false, 'error' => 'Recipient and message are required.']);
                            exit;
                        }

                        $stmt = $pdo->prepare("
                            INSERT INTO messages (recipient, subject, message, status)
                            VALUES (:recipient, :subject, :message, :status)
                        ");
                        $stmt->execute([
                            ':recipient' => $recipient,
                            ':subject' => $subject,
                            ':message' => $message,
                            ':status' => $status
                        ]);


                        add_notification(['title'=>'Message saved successfully.', 'message'=>"Message recipient:$recipient; subject:$subject; message:$message; status:$status  has been saved inserted id was ".$pdo->lastInsertId(), 'type'=>'insert data', 'link'=>'content?e=messages' ]);


                        echo json_encode(['success' => true, 'message' => 'Message saved successfully.', 'data' => [
                            'id' => $pdo->lastInsertId(),
                            'status' => $status
                        ]]);
                    } catch (PDOException $e) {
                        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
                        add_notification(['title'=>'Message not saved.', 'message'=>"Message with recipient:$recipient; subject:$subject; message:$message; status:$status  was not inserted.", 'type'=>'error insert', 'link'=>'content?e=messages' ]);
                    }
                    exit;

                // (Optional) Fetch all messages
            case 'get_messages':
                    try {
                        $stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC");
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        echo json_encode(['success' => true, 'data' => $rows]);
                    } catch (PDOException $e) {
                        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
                    }
                    exit;
            case 'get_icons':
                $file ='../system/api/icons.json';
                if (!file_exists($file)) {
                    echo json_encode(['success' => false, 'error' => 'icons.json not found']);
                    exit;
                }

                $json = json_decode(file_get_contents($file), true);
                echo json_encode(['success' => true, 'data' => $json]);
                exit;

            case 'update_icon':
                $file ='../system/api/icons.json';
                $table = $_POST['table'] ?? '';
                $icon  = $_POST['icon'] ?? '';

                if (!$table || !$icon) {
                    echo json_encode(['success' => false, 'error' => 'Missing parameters']);
                    exit;
                }

                $data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
                $data[$table] = $icon;

                file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

                echo json_encode(['success' => true, 'message' => 'Icon updated', 'data' => $data]);
                add_notification(['title'=>"Table $table Icon updated successfully.", 'message'=>"Table $table Icon updated successfully ", 'type'=>'changing icons' ]);
                exit;

        case 'get_tasks':
            $stmt = $pdo->query("SELECT id, task, completed FROM todos WHERE status='active' ORDER BY created_at DESC LIMIT 10");
            echo json_encode(['success' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
            exit;

        case 'add_task':
            $task = trim($_POST['task'] ?? '');
            if ($task === '') exit(json_encode(['success' => false, 'error' => 'Empty task']));
            $stmt = $pdo->prepare("INSERT INTO todos (task) VALUES (?)");
            $stmt->execute([$task]);
             add_notification(['title'=>"Task $task inserted successfully.", 'message'=>"Your task has been inserted successfully table: todos, task was:$task and inserted id was:".$pdo->lastInsertId(), 'type'=>'insert', 'link'=>'content?e=todos' ]);
            echo json_encode(['success' => true]);

            exit;

        case 'toggle_task':
            $id = (int)$_POST['id'];
            $completed = (int)$_POST['completed'];
            $stmt = $pdo->prepare("UPDATE todos SET completed=? WHERE id=?");
            $stmt->execute([$completed, $id]);
            echo json_encode(['success' => true]);
            add_notification(['title'=>"Task with id $id modified successfully.", 'message'=>"Task with id:$id and  status:$completed was modify from old status to $completed status", 'type'=>'modify', 'link'=>'content?e=todos' ]);
            exit;

        case 'delete_task':
            $id = (int)$_POST['id'];
            $stmt = $pdo->prepare("DELETE FROM todos WHERE id=?");
            $stmt->execute([$id]);
            add_notification(['title'=>"Task with id $id was deleted successfully.", 'message'=>"Task with id:$id was deleted this is undone action", 'type'=>'delete', 'link'=>'content?e=todos' ]);
            echo json_encode(['success' => true]);
            exit;
         case 'save_content':
                try {
                    $title     = trim($_POST['title'] ?? '');
                    $path      = trim($_POST['path'] ?? '');
                    $extension = trim($_POST['extension'] ?? 'txt');
                    $body      = trim($_POST['body'] ?? '');
                    $status    = $_POST['status'] === 'publish' ? 'publish' : 'draft';

                    if (empty($title) || empty($body)) {
                        echo json_encode(['success' => false, 'error' => 'Title and content are required.']);
                        exit;
                    }

                    $stmt = $pdo->prepare("
                        INSERT INTO contents (title, path, extension, body, status)
                        VALUES (:title, :path, :extension, :body, :status)
                    ");
                    $stmt->execute([
                        ':title' => $title,
                        ':path' => $path,
                        ':extension' => $extension,
                        ':body' => $body,
                        ':status' => $status
                    ]);

                    add_notification(['title'=>"Content saved successfully.", 'message'=>"Content with title:$title, path:$path, extension:$extension, status:$status was saved", 'type'=>'insert', 'link'=>'content?e=contents' ]);

                    echo json_encode(['success' => true, 'message' => 'Content saved successfully.']);
                } catch (PDOException $e) {
                    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
                     add_notification(['title'=>"Saving Content Error.", 'message'=>"We failed to save Content with title:$title, path:$path, extension:$extension, status:$status was saved error:".$e->getMessage(), 'type'=>'error' ]);
                }
                exit;


        case 'change_password':
            if (!isset($_SESSION['user_id'])) {
                add_notification(['title'=>"Failed to change password", 'message'=>"User Not authenticated.", 'type'=>'error' ]);
              echo json_encode(['success' => false, 'error' => 'Not authenticated.']);
              exit;
            }

            $user_id = $_SESSION['user_id']; // the logged-in user’s ID
            $current = $_POST['current'] ?? '';
            $new     = $_POST['new'] ?? '';
            $confirm = $_POST['confirm'] ?? '';

            if (empty($current) || empty($new) || empty($confirm)) {
              echo json_encode(['success' => false, 'error' => 'All fields are required.']);
              exit;
            }

            if ($new !== $confirm) {
              echo json_encode(['success' => false, 'error' => 'New passwords do not match.']);
              add_notification(['title'=>"Failed to change password", 'message'=>"New passwords do not match.", 'type'=>'error' ]);
              exit;
            }

            try {
              // Fetch current hashed password
              $stmt = $pdo->prepare("SELECT password FROM users WHERE id = :id");
              $stmt->execute([':id' => $user_id]);
              $user = $stmt->fetch(PDO::FETCH_ASSOC);

              if (!$user || !password_verify($current, $user['password'])) {
                echo json_encode(['success' => false, 'error' => 'Current password is incorrect.']);
                add_notification(['title'=>"Failed to change password", 'message'=>"Current password is incorrect.", 'type'=>'error' ]);
                exit;
              }

              // Hash new password
              $hashed = password_hash($new, PASSWORD_DEFAULT);

              // Update password
              $update = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
              $update->execute([':password' => $hashed, ':id' => $user_id]);

              echo json_encode(['success' => true, 'message' => 'Password changed successfully.']);
              add_notification(['title'=>"Password changed successfully.", 'message'=>"Password changed successfully. Logout to try new password", 'type'=>'modify' ]);
            } catch (PDOException $e) {
                add_notification(['title'=>"Password not changed.", 'message'=>"Password was not modified error:".$e->getMessage(), 'type'=>'error']);
              echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }

            exit;
        case 'filetree':
            function listDir($dir) {
                $result = [];
                $files = scandir($dir);
                foreach ($files as $file) {
                    if ($file === '.' || $file === '..') continue;
                    $path = $dir . DIRECTORY_SEPARATOR . $file;
                    $pathx = str_replace('../../\\', '', $path);
                    $pathx = str_replace('\\', '/', $pathx);
                    if (is_dir($path)) {
                        $result[] = [
                            "type" => "folder",
                            "name" => $file,
                            "path" => $path,
                            "children" => listDir($path)
                        ];

                    } else {
                        $result[] = [
                            "type" => "file",
                            "name" => $file,
                            "path" => $pathx
                        ];
                    }
                }
                return $result;
            }

            header("Content-Type: application/json");
            echo json_encode(listDir('../../'), JSON_PRETTY_PRINT);

            exit;


        case 'loadfile':
             $path = $_POST['file'] ?? $_GET['file']??'';
             echo file_get_contents('../../'.$path);
            exit;
        case 'savefile':
             $path = $_POST['path'] ?? $_GET['path']??'';
             $content = $_POST['content'] ?? $_GET['content']??'';
             if (!empty($content) && !empty($path)) {
                if (file_exists("../../$path")) {
                     $file = basename($path);
                     file_put_contents("../../$path", $content);
                     file_put_contents("../../app/system/settings/backup/files/$file", $content);
                    echo json_encode([
                        'success' => true, 
                        'message'=>'Change saved!', 
                        'text' => 'success'
                    ]);

                    add_notification(['title'=>"File $file Content changed", 'message'=>"File new content saved!, Path:$path You can find backup here app/system/settings/backup/files/$file ", 'type'=>'edit file']);
                 } else{
                    file_put_contents("../../$path", $content);
                    echo json_encode([
                    'success' => false, 
                    'message'=>'New file was created', 
                    'text' => 'error'
                ]);
                     add_notification(['title'=>"File $file was not found", 'message'=>"Path:$path not found, we created a new one on that path,you previous data are here app/system/settings/backup/files/$file ", 'type'=>'edit file']);
                 }
             }else{
                echo json_encode([
                    'success' => false, 
                    'message'=>'path and content are required', 
                    'text' => 'error'
                ]);

                     add_notification(['title'=>"Missing parameter path and content", 'message'=>"Path and content are required, in order to create file", 'type'=>'error']);
             }
            exit;


        case 'get_new_users':
            try {
                $stmt = $pdo->prepare("SELECT  username, email FROM users ORDER BY created_at DESC LIMIT 10");
                $stmt->execute();
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo json_encode(['success' => true, 'data' => $users]);
            } catch (PDOException $e) {
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }
            exit;
        case 'add_user':
            try {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $stmt = $pdo->prepare("INSERT INTO users (username, email, password, status) VALUES (:username, :email, :password, 'active')");
                $stmt->execute([
                    ':username' => $username,
                    ':email' => $email,
                    ':password' => $password
                ]);

                echo json_encode(['success' => true]);

                 add_notification(['title'=>"New user registed", 'message'=>"New user with username:$username and email:$email registed!", 'type'=>'register']);


            } catch (PDOException $e) {
                add_notification(['title'=>"New user not registed", 'message'=>"New user with username:$username and email:$email was not registed! error:".$e->getMessage(), 'type'=>'register error']);
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }
            exit;

        case 'update_settings':
            try {
                $fields = $_POST;
                unset($fields['action']);

                $stmt = $pdo->prepare("UPDATE settings SET value = :value, updated_at = NOW() WHERE name = :name");

                foreach ($fields as $key => $val) {
                    $stmt->execute([':value' => $val, ':name' => $key]);
                }

                echo json_encode(['success' => true]);
                add_notification(['title'=>"Settings Update", 'message'=>"Settings Update value=$value; name =$name", 'type'=>'modify settings']);
            } catch (PDOException $e) {
                add_notification(['title'=>"Error in Updating Settings", 'message'=>"Settings Update with value=$value; name =$name not updated error:".$e->getMessage(), 'type'=>'modify settings']);
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }
            exit;
    case 'like_user':
            try {
                $fields = $_POST;
                unset($fields['action']);

                $data = excuteQuery("UPDATE settings SET value = ?, updated_at = NOW() WHERE name = ?",'assoc',[
                    $value,$name
                ])['success'];

                foreach ($fields as $key => $val) {
                    $stmt->execute([':value' => $val, ':name' => $key]);
                }

                echo json_encode(['success' => true]);
                add_notification(['title'=>"Settings Update", 'message'=>"Settings Update value=$value; name =$name", 'type'=>'modify settings']);
            } catch (PDOException $e) {
                add_notification(['title'=>"Error in Updating Settings", 'message'=>"Settings Update with value=$value; name =$name not updated error:".$e->getMessage(), 'type'=>'modify settings']);
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }
            exit;
            // New Users Summary
    case 'get_new_users_summary':
        try {
            // --- Total users ---
            $stmt = $pdo->query("SELECT COUNT(*) AS total FROM users");
            $totalUsers = (int)$stmt->fetchColumn();

            // --- Active users ---
            $stmt = $pdo->query("SELECT COUNT(*) AS active FROM users WHERE status = 'active'");
            $activeUsers = (int)$stmt->fetchColumn();

            // --- Not active users ---
            $stmt = $pdo->query("SELECT COUNT(*) AS not_active FROM users WHERE status = 'not-active'");
            $notActiveUsers = (int)$stmt->fetchColumn();

            // --- Users registered today ---
            $stmt = $pdo->query("SELECT COUNT(*) AS day_users 
                                 FROM users 
                                 WHERE DATE(created_at) = CURDATE()");
            $dayUsers = (int)$stmt->fetchColumn();

            // --- Users registered this week ---
            $stmt = $pdo->query("SELECT COUNT(*) AS week_users 
                                 FROM users 
                                 WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1)");
            $weekUsers = (int)$stmt->fetchColumn();

            // --- Users registered this month ---
            $stmt = $pdo->query("SELECT COUNT(*) AS month_users 
                                 FROM users 
                                 WHERE YEAR(created_at) = YEAR(CURDATE()) 
                                 AND MONTH(created_at) = MONTH(CURDATE())");
            $monthUsers = (int)$stmt->fetchColumn();

            // --- Registration trend (last 30 days) ---
            $stmt = $pdo->query("
                SELECT DATE(created_at) AS date, COUNT(*) AS count
                FROM users
                WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
                GROUP BY DATE(created_at)
                ORDER BY DATE(created_at) ASC
            ");
            $trendData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // --- Response ---
            $data = [
                'summary' => "User statistics overview with registration trends over the last 30 days.",
                'metrics' => [
                    ['label' => 'Total Users', 'value' => $totalUsers],
                    ['label' => 'Active Users', 'value' => $activeUsers],
                    ['label' => 'Not Active Users', 'value' => $notActiveUsers],
                    ['label' => 'Today\'s Sign-ups', 'value' => $dayUsers],
                    ['label' => 'This Week', 'value' => $weekUsers],
                    ['label' => 'This Month', 'value' => $monthUsers]
                ],
                'chart' => $trendData
            ];

            echo json_encode(['success' => true, 'data' => $data]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        exit;




}

}catch (Exception $e){
  switch (true) {
    case preg_match('/^(.+)Base table or view not found:/', $e->getMessage()):
        echo json_encode(['success' => false, "Table not found"]);
        exit;
        break;
    default:
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        break;
  }
  exit; 
}


if ($action === 'get_visitor_stats') {
    $period = $_POST['period'] ?? 'day'; // default grouping

    // Build SQL dynamically based on period
    switch ($period) {
        case 'hour':
            $groupBy = "DATE_FORMAT(visit_time, '%Y-%m-%d %H:00')";
            break;
        case 'day':
            $groupBy = "DATE(visit_time)";
            break;
        case 'week':
            $groupBy = "YEARWEEK(visit_time, 1)";
            break;
        case 'month':
            $groupBy = "DATE_FORMAT(visit_time, '%Y-%m')";
            break;
        case 'year':
            $groupBy = "YEAR(visit_time)";
            break;
        default:
            $groupBy = "DATE(visit_time)";
    }

    $sql = "SELECT $groupBy AS label, COUNT(*) AS visits
            FROM website_visitors
            GROUP BY label
            ORDER BY label ASC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll();

    echo json_encode(['success' => true, 'data' => $data]);
    exit;
}

elseif (isset($_POST['action']) && $_POST['action'] == 'get_tables') {
    $data = executeQuery("SHOW TABLES","COLUMN")['data'];
    echo json_encode(['success' => true, 'message' => 'data fetched successfully','data'=>$data]);
    exit;

}elseif (isset($_POST['action']) && $_POST['action'] == 'get_active_users') {
    $sql = "SELECT status, COUNT(*) AS count FROM users GROUP BY status";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $data = [];
    while ($row = $stmt->fetch()) {
        $data[$row['status']] = (int)$row['count'];
    }

    echo json_encode([
        'success' => true,
        'data' => $data
    ]);
    exit;

}
// Make sure a file path is provided
elseif (!isset($_GET['action'])  || empty($_GET['action']) ) {
    http_response_code(400);
    echo json_encode(['error' => 'No action specified']);
    exit;
}

// Sanitize input to prevent directory traversal attacks
// $file = basename($_GET['file']); // Only allow the file name, no directories
// $directory = _DIR_ . '/uploads/'; // Path to your files folder
// $fullPath = $directory . $file;

$fullPath = $_GET['file']??'./';
$fullPath = ltrim($fullPath,'./');
if ($_GET['action'] == 'file_detail') {
    $info = get_file_details('../../'.$fullPath);
    echo json_encode($info, JSON_PRETTY_PRINT);
}elseif ($_GET['action'] == 'file_delete') {
    $fullPath = '../../' . ltrim($_GET['file'], './');

    if (!file_exists($fullPath)) {
        echo json_encode(['message' => 'File or folder not found', 'success' => false]);
        exit;
    }

    // If it's a directory, recursively delete
    if (is_dir($fullPath)) {
        $deleted = delete_directory($fullPath);
        if ($deleted) {
            echo json_encode(['message' => 'Folder deleted successfully', 'success' => true]);
        } else {
            echo json_encode(['message' => 'Failed to delete folder', 'success' => false]);
        }
    } else {
        // It's a file
        if (unlink($fullPath)) {
            echo json_encode(['message' => 'File deleted successfully', 'success' => true]);
        } else {
            echo json_encode(['message' => 'Failed to delete file', 'success' => false]);
        }
    }
    exit;
}

elseif ($_GET['action'] == 'download_folder') {
    $fullPath = '../../' . ltrim($_GET['file'], './');

    if (!is_dir($fullPath)) {
        http_response_code(404);
        echo json_encode(['message' => 'Folder not found', 'success' => false]);
        exit;
    }

    $zipName = basename($fullPath) . '.zip';
    $zipPath = sys_get_temp_dir() . '/' . $zipName;
    include_once"../system/cogs/functions.php";
    $zip = zipFolder($fullPath,"$fullPath.zip");
    echo json_encode($zip);

    exit;
}elseif ($_GET['action'] == 'delete_download_folder') {
    $fullPath = trim($_GET['file']);

    if (!is_dir($fullPath)) {
        http_response_code(404);
        echo json_encode(['message' => 'Folder not found', 'success' => false]);
        exit;
    }

    header('Content-Disposition: attachment; filename="' . $fullPath . '"');
    header('Content-Length: ' . filesize($zipPath));
    readfile($zipPath);

    // Delete the temporary zip after sending
    unlink($zipPath);
    echo json_encode(['message'=>'done',"success"=>true]);
    exit;
}


elseif ($_GET['action'] == 'file_edit') {
    if (is_dir('../../'.$fullPath)) {
        echo json_encode(['message'=>'Failed to edit given file','success'=>false]);
        exit;
    }
    if (file_exists('../../'.$fullPath)) {
        $content = file_get_contents('../../'.$fullPath);
        $content = htmlentities($content);
        // echo json_encode(['message'=>'Data fetched from file '.$fullPath,'success'=>true,'data'=>$content]);
        if ($content && !empty($content)) {
            add_notification(['title'=>"Data fetched from file", 'message'=>"Data fetched from file $fullPath", 'type'=>'fetch data']);


            echo json_encode(['message'=>'Data fetched from file '.$fullPath,'success'=>true,'data'=>$content]);
        }else{
            echo json_encode(['message'=>'File is Empty','success'=>false,'data'=>$content]);
        }
    }else{
        add_notification(['title'=>"File not found $fullPath", 'message'=>"Data not found file: $fullPath", 'type'=>'file-not-found']);
        echo json_encode(['message'=>'File not found','success'=>false]);
    }
}elseif ($_GET['action'] == 'save_file_edited_content') {
    $fullPath = trim($_GET['file']);
    if (is_dir('../../'.$fullPath)) {
        add_notification(['title'=>"Failed to edit given file $fullPath", 'message'=>"We Failed to edit given file: $fullPath please try again", 'type'=>'file-not-modified']);
        echo json_encode(['message'=>'Failed to edit given file','success'=>false]);
        exit;
    }
    if (file_exists('../../'.$fullPath)) {
        $content = $_POST['content']??'';
        if (file_put_contents('../../'.$fullPath,$content)) {
            echo json_encode(['message'=>'Content changed: '.$fullPath,'success'=>true]);
            add_notification(['title'=>"Content changed $fullPath", 'message'=>"Data changed successfully path: $fullPath", 'type'=>'file-modified']);

        }else{
            echo json_encode(['message'=>'Content not changed','success'=>false]);
            add_notification(['title'=>"Content not changed $fullPath", 'message'=>"Content not changed path:$fullPath you can try again later", 'type'=>'file-not-modified']);
        }
    }else{
        add_notification(['title'=>"File not found.", 'message'=>"File not found  path:$fullPath", 'type'=>'file-not-found']);
        echo json_encode(['message'=>'File not found','success'=>false]);
    }
}elseif ($_GET['action'] == 'create_folder') {
    // Example: ?action=create_folder&file=path/to/dir&name=NewFolder
    $basePath = '../../' . ltrim($_GET['file'], './');
    $folderName = $_GET['name'] ?? '';
    $targetPath = rtrim($basePath, '/') . '/' . $folderName;

    if (empty($folderName)) {
        echo json_encode(['message' => 'Folder name cannot be empty', 'success' => false]);
        exit;
    }

    if (file_exists($targetPath)) {
        echo json_encode(['message' => 'A folder or file with that name already exists', 'success' => false]);
        exit;
    }

    if (mkdir($targetPath, 0777, true)) {
        echo json_encode(['message' => 'Folder created successfully', 'success' => true]);
        add_notification(['title'=>"Folder created successfully", 'message'=>"Folder created successfully path:$folderName", 'type'=>'folder-created']);
    } else {
         add_notification(['title'=>"Folder not created", 'message'=>"Folder not created  path:$folderName", 'type'=>'folder-not-created']);
        echo json_encode(['message' => 'Failed to create folder', 'success' => false]);
    }

}elseif ($_GET['action'] == 'create_file') {
    // POST: name, content; GET: file (path)
    $basePath = '../../' . ltrim($_POST['path'] ?? $_GET['file'], './');
    $fileName = $_POST['name'] ?? '';
    $content = $_POST['content'] ?? '';
    $targetPath = rtrim($basePath, '/') . '/' . $fileName;

    if (empty($fileName)) {
        echo json_encode(['message' => 'File name cannot be empty', 'success' => false]);
        exit;
    }

    if (file_exists($targetPath)) {
        echo json_encode(['message' => 'A file or folder with that name already exists', 'success' => false]);
        exit;
    }

    if (file_put_contents($targetPath, $content) !== false) {
        echo json_encode(['message' => 'File created successfully', 'success' => true]);
        add_notification(['title'=>"File created successfully", 'message'=>"File created successfully path:$folderName", 'type'=>'file-created']);
    } else {
        echo json_encode(['message' => 'Failed to create file', 'success' => false]);
        add_notification(['title'=>"File not created", 'message'=>"File not created. Path:$folderName", 'type'=>'file-not-created']);
    }

}elseif ($_GET['action'] == 'file_upload') {
    // Handles Dropzone uploads
    $basePath = '../../' . ltrim($_GET['path'] ?? $_GET['file'], './');

    if (!is_dir($basePath)) {
        echo json_encode(['success' => false, 'message' => 'Invalid upload directory']);
        exit;
    }

    if (!empty($_FILES['file']['name'])) {
        $tmp = $_FILES['file']['tmp_name'];
        $name = basename($_FILES['file']['name']);
        $target = rtrim($basePath, '/') . '/' . $name;

        if (move_uploaded_file($tmp, $target)) {
            echo json_encode(['success' => true, 'message' => 'File uploaded successfully']);
            add_notification(['title'=>"File $name uploaded successfully", 'message'=>"File $name uploaded successfully basePath = $basePath", 'type'=>'file-uploaded']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save uploaded file']);
            add_notification(['title'=>"Failed to save  uploaded file", 'message'=>"Failed to save  uploaded file $target DIRECTORY and file $name", 'type'=>'file-not-uploaded']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No file uploaded']);
    }

}else{
    http_response_code(400);
    echo json_encode(['error' => 'Unknown action']);
}
// if (!file_exists($fullPath)) { 
//     http_response_code(404);
//     echo json_encode(['error' => 'File not found']);
//     exit;
// }

// Set headers to force download
// header('Content-Description: File Transfer');
// header('Content-Type: application/octet-stream');
// header('Content-Disposition: attachment; filename="' . $file . '"');
// header('Expires: 0');
// header('Cache-Control: must-revalidate');
// header('Pragma: public');
// header('Content-Length: ' . filesize($fullPath));

// Clear output buffer and read the file
// ob_clean();
// flush();
// readfile($fullPath);
exit;

?>