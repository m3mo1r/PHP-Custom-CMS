<?php // FILTER VALUES BY JAVASCRIPT
$user_firstname = $_POST['firstname'];
$user_lastname  = $_POST['lastname'];
$user_role      = $_POST['role'];
$user_name      = $_POST['name'];
$user_email     = $_POST['email'];

$user_image     = $_FILES['image']['name'];
$user_image_tmp = $_FILES['image']['tmp_name'];
move_uploaded_file($user_image_tmp, "../images/{$user_image}");

$user_password  = $_POST['password'];
if(!empty($user_password))
    $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, ['cost' => 12]);
else
    $hashed_password = $row['user_password'];


if(empty($user_image)) {
    $query  = "SELECT * FROM users ";
    $query .= "WHERE user_id = '{$user_id}' ";
    $record = QueryDB($query);

    $row        = mysqli_fetch_assoc($record);
    $user_image = $row['user_image'];
}

$query  = "UPDATE users SET ";
$query .= "user_firstname = '{$user_firstname}', ";
$query .= "user_lastname = '{$user_lastname}', ";
$query .= "user_role = '{$user_role}', ";
$query .= "user_name = '{$user_name}', ";
$query .= "user_email = '{$user_email}', ";
$query .= "user_image = '{$user_image}', ";
$query .= "user_password = '{$hashed_password}' ";
$query .= "WHERE user_id = {$user_id}";
$record = QueryDB($query);

echo "<p class='bg-success'>User Edited.</p>";

?>