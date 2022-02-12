<?php // CREATE USER
if(isset($_POST['create_user'])) {
    $user_firstname  = $_POST['firstname'];
    $user_lastname   = $_POST['lastname'];
    $user_role       = $_POST['role'];
    $user_name       = $_POST['name'];
    $user_email      = $_POST['email'];
    
    $user_image      = $_FILES['image']['name'];
    $user_image_tmp  = $_FILES['image']['tmp_name'];
    move_uploaded_file($user_image_tmp, "../images/{$user_image}");
    
    $user_password   = $_POST['password'];
    $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, ['cost' => 12]);
    
    $query  = "INSERT INTO users (user_firstname, user_lastname, user_role, user_name, user_email, user_image, user_password) ";
    $query .= "VALUES ('{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$user_name}', '{$user_email}', '{$user_image}', '{$hashed_password}') ";
    
    $record = QueryDB($query);
}
?>


<?php include 'form_user.php'; ?>