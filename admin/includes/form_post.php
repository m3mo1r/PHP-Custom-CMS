<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" id="title" value="<?php if(isset($post_id)) echo str_replace('\\', '', $post_title); ?>" required>
    </div>
    <div class="form-group">
        <label for="category_id">Post Category Id</label>
        <select name="category_id" id="category_id" class="form-control">
<?php
$query   = "SELECT * FROM categories ";
$records = QueryDB($query);
            
while ($row = mysqli_fetch_assoc($records)) {
    $cat_id    = $row['cat_id'];
    $cat_title = $row['cat_title'];
    
    if($post_category_id === $cat_id)
        echo "<option value='{$cat_id}' selected>{$cat_title}</option>";
    else
        echo "<option value='{$cat_id}'>{$cat_title}</option>";
}
?>
        </select>
    </div>
    <div class="form-group">
        <label for="user">User</label>
        <select name="user" id="user" class="form-control">
<?php
$query   = "SELECT * FROM users ";
$records = QueryDB($query);
            
while ($row = mysqli_fetch_assoc($records)) {
    $user_id   = $row['user_id'];
    $user_name = $row['user_name'];
    
    if($user_name === $_SESSION['username'])
        echo "<option value='{$user_name}' selected>{$user_name}</option>";
    else
        if($_SESSION['role'] !== 'admin')
            echo "<option value='{$user_name}' style='display:none'>{$user_name}</option>";
        else
            echo "<option value='{$user_name}'>{$user_name}</option>";
}
?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author" id="author" value="<?php if(isset($post_id)) echo str_replace('\\', '', $post_author); ?>" required>
    </div>
    <div class="form-group">
        <label for="status">Post Status</label>
        <select name="status" id="status" class="form-control">
            <option value="draft">Draft</option>
            <option value="published" <?php if(isset($post_id) && $post_status === 'published') echo "selected"; ?>>Publish</option>
        </select>
    </div>
    <div class="form-group">
        <label for="image">Post Image</label>
<?php if(isset($post_id) && !empty($post_image)) echo "<br><img src='../images/{$post_image}' alt='post_image' width='100'>"; ?>
        <input type="file" name="image" id="image">
    </div>
    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="tags" id="tags" value="<?php if(isset($post_id)) echo str_replace('\\', '', $post_tags); ?>">
    </div>
    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea class="form-control content" name="content" id="content" cols="70" rows="30" style="resize: none;" required><?php if(isset($post_id)) echo str_replace('\\', '', $post_content); ?></textarea>
    </div>
    <div class="form-group">
<?php
if(isset($post_id))
    echo "<input type='submit' class='btn btn-primary' name='update_post' value='Update Post'>";
else
    echo "<input type='submit' class='btn btn-primary' name='create_post' value='Publish Post'>";
?>
    </div>
</form>
