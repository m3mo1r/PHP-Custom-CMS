<?php // SHOW UPDATE CONTENT AND UPDATE FUNCTION
if(isset($_GET['p_id'])) {
    $post_id = Escape($_GET['p_id']);
    
    $query   = "SELECT * FROM posts ";
    $query  .= "WHERE post_id = {$post_id} ";
    $record  = QueryDB($query);
    $row     = mysqli_fetch_assoc($record);
    
    $post_category_id    = $row['post_category_id'];
    $post_title          = $row['post_title'];
    $post_author         = $row['post_author'];
    $post_user           = $row['post_user'];
    $post_image          = $row['post_image'];
    $post_content        = $row['post_content'];
    $post_tags           = $row['post_tags'];
    $post_status         = $row['post_status'];
    $post_comments_count = $row['post_comments_count'];
    $post_date           = $row['post_date'];
}

if(isset($_POST['update_post'])) {
    $post_title       = Escape($_POST['title']);
    $post_category_id = $_POST['category_id'];
    $post_author      = Escape($_POST['author']);
    $post_user        = $_POST['user'];
    $post_user_id     = Post_User_Id($post_user);
    $post_status      = $_POST['status'];
    
    $post_image       = $_FILES['image']['name'];
    $post_image_tmp   = $_FILES['image']['tmp_name'];
    
    $post_tags        = Escape($_POST['tags']);
    $post_content     = Escape($_POST['content']);
    
    move_uploaded_file($post_image_tmp, "../images/{$post_image}");
    
    if(empty($post_image)) {
        $query      = "SELECT * FROM posts ";
        $query     .= "WHERE post_id = {$post_id} ";
        $record     = QueryDB($query);
        $row        = mysqli_fetch_assoc($record);
        $post_image = $row['post_image'];
    }
    
    
    
    $query  = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = {$post_category_id}, ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_user = '{$post_user}', ";
    $query .= "post_user_id = '{$post_user_id}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_image = '{$post_image}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_date = now() ";
    $query .= "WHERE post_id = {$post_id}";
    $record = QueryDB($query);
    
    echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$post_id}'>View Post</a></p>";
}
?>

<?php include 'form_post.php'; ?>