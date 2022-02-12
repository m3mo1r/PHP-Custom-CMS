<?php // SHOW UPDATE CONTENT AND UPDATE FUNCTION
if(isset($_GET['u_id'])) {
    $user_id = $_GET['u_id'];
    
    $query = "SELECT * FROM users ";
    $query .= "WHERE user_id = '{$user_id}' ";
    $record = QueryDB($query);
    $row = mysqli_fetch_assoc($record);
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_role = $row['user_role'];
    $user_name = $row['user_name'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_password = $row['user_password'];
}

if(isset($_POST['update_user']))
    include 'includes/update_users.php';
?>

<?php include 'form_user.php'; ?>