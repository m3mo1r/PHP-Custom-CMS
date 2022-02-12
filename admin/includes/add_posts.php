<?php // CREATE POST
if(isset($_POST['create_post'])) {
    $post_title       = Escape($_POST['title']);
    $post_category_id = $_POST['category_id'];
    $post_author      = Escape($_POST['author']);
    $post_user        = $_POST['user'];
    $post_user_id     = Post_User_Id($post_user);
    $post_status      = $_POST['status'];
    
    $post_image       = $_FILES['image']['name'];
    $post_image_tmp   = $_FILES['image']['tmp_name'];
    move_uploaded_file($post_image_tmp, "../images/{$post_image}");
    
    $post_tags        = Escape($_POST['tags']);
    $post_content     = Escape($_POST['content']);
    
    $query   = "INSERT INTO posts (post_title, post_category_id, post_author, post_user, post_user_id, post_status, post_image, post_tags, post_content, post_date) ";
    $query  .= "VALUES ('{$post_title}', {$post_category_id}, '{$post_author}', '{$post_user}', {$post_user_id}, '{$post_status}', '{$post_image}', '{$post_tags}', '{$post_content}', now()) ";
    $record  = QueryDB($query);
    
    $post_id = mysqli_insert_id($connection);
    
    echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$post_id}'>View Post</a></p>";
}
?>


<?php include 'form_post.php'; ?>