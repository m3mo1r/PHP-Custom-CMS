<?php
function QueryDB($query) { // CHECK ERROR QUERY
    global $connection;
    
    $result = mysqli_query($connection, $query);
    if(!$result)
        echo "QUERY FAILED. " . mysqli_error($connection);
    
    return $result;
}

function UsersOnlineCount() { // CHECK ONLINE USERS
    if(isset($_GET['onl_users'])) {
        global $connection;
        if(!$connection) {
            session_start();
            include 'db.php';
            
            $session             = session_id();
            $time                = time();
            $time_out_in_seconds = 5;
            $time_out            = $time - $time_out_in_seconds;

            $query  = "SELECT * FROM users_online ";
            $query .= "WHERE session = '{$session}' ";
            $record = QueryDB($query);

            $user_online = mysqli_num_rows($record);

            if($user_online == NULL) {
                $query  = "INSERT INTO users_online (session, time) ";
                $query .= "VALUES ('{$session}', {$time}) ";
                $record = QueryDB($query);
            } else {
                $query  = "UPDATE users_online ";
                $query .= "SET time = {$time} ";
                $query .= "WHERE session = '{$session}' ";
                $record = QueryDB($query);
            }

            $query   = "SELECT * FROM users_online ";
            $query  .= "WHERE time > {$time_out} ";
            $records = QueryDB($query);

            echo mysqli_num_rows($records);
        }
    }
}

UsersOnlineCount();

function Escape($parameter) { // ESCAPE STRING
    global $connection;
    
    return mysqli_real_escape_string($connection, trim(strip_tags($parameter)));
}

function Redirect($location) { // HEADER LOCATION
    header("Location: {$location}");
    exit();
}

function Login_User($username, $password) {
    $query  = "SELECT * FROM users ";
    $query .= "WHERE user_name = '{$username}' ";
    $record = QueryDB($query);
    
    $row               = mysqli_fetch_assoc($record);
    $db_user_id        = $row['user_id'];
    $db_user_firstname = $row['user_firstname'];
    $db_user_lastname  = $row['user_lastname'];
    $db_user_role      = $row['user_role'];
    $db_user_name      = $row['user_name'];
    $db_user_password  = $row['user_password'];
    
    if(password_verify($password, $db_user_password)) {
        $_SESSION['id']        = $db_user_id;
        $_SESSION['username']  = $db_user_name;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname']  = $db_user_lastname;
        $_SESSION['role']      = $db_user_role;
        
        Redirect('/cms/admin');
    } else
        Redirect('/cms/login');
}

function Existed_User($username) { // CHECK USERNAME EXISTED
    global $connection;
    
    $query  = "SELECT user_name FROM users ";
    $query .= "WHERE user_name = '{$username}' ";
    $record = QueryDB($query);
    
    if(mysqli_num_rows($record) === 1)
        return true;
    else
        return false;
}

function Existed_Email($email) { // CHECK EMAIL EXISTED
    global $connection;
    
    $query  = "SELECT user_email FROM users ";
    $query .= "WHERE user_email = '{$email}' ";
    $record = QueryDB($query);
    
    if(mysqli_num_rows($record) === 1)
        return true;
    else
        return false;
}

function Check_Length($username, $password) { // CHECK LENGTH USERNAME AND PASSWORD
    if(strlen($username) < 3 || strlen($password) < 5)
        return true;
    else
        return false;
}

function Check_Errors($username, $email, $password) { // CHECK REGISTRATION ERRORS
    $message = '';
        
    if(Existed_User($username) || Existed_Email($email))
        return $message = 'Your username or email has been used.';
    elseif(Check_Length($username, $password))
        return $message = 'Your username or password is not strong enough.';
    elseif(empty($username) || empty($email) || empty($password))
        return $message = 'Are you kidding me?';
    else
        return $message;
}

function Is_Method($method = NULL) { // CHECK FORM METHOD
    if(strtolower($_SERVER['REQUEST_METHOD']) === $method)
        return true;
    
    return false;
}

function Is_LoggedIn() { // CHECK USER LOGGED IN
    if(isset($_SESSION['role']))
        return true;
    
    return false;
}

function LoggedIn_And_Redirect($location) { // REDIRECT LOGGED USER
    if(Is_LoggedIn())
        Redirect($location);
}

function Current_UserId() { // CHECK LOGGED IN USER ID - USE SESSION['ID']
    if(Is_LoggedIn()) {
        $query  = "SELECT user_id FROM users ";
        $query .= "WHERE user_name = '{$_SESSION['username']}' ";
        $record = QueryDB($query);
        
        return mysqli_fetch_assoc($record)['user_id'];
    }
    
    return 0;
}

function User_Like_This_Post($post_id = 0) {
    if(Current_UserId()) {
        $user_id = Current_UserId();
        $query   = "SELECT like_id FROM likes ";
        $query  .= "WHERE like_user_id = {$user_id} AND like_post_id = {$post_id} ";
        $record  = QueryDB($query);
        
        return mysqli_num_rows($record) === 1 ? true : false;
    }
    
    return false;
}

function Get_Num_Likes($post_id) {
    $query   = "SELECT post_likes_count FROM posts ";
    $query  .= "WHERE post_id = {$post_id} ";
    $record  = QueryDB($query);
    
    return mysqli_fetch_assoc($record)['post_likes_count'];
}
?>