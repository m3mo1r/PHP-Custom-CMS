<?php include 'includes/modals.php'; ?>

<?php
if(isset($_POST['checkBoxArray'])) {
    foreach($_POST['checkBoxArray'] as $postId) {
        $bulk_options = $_POST['bulk_options'];
        
        switch($bulk_options) {
            case 'published':
                $query  = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postId} ";
                $record = QueryDB($query);
                break;
                
            case 'draft':
                $query  = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postId} ";
                $record = QueryDB($query);
                break;
                
            case 'delete':
                $query  = "DELETE FROM posts WHERE post_id = {$postId} ";
                $record = QueryDB($query);
                break;
                
            case 'clone': // BUG ESCAPE CHARACTERS - BUG EMPTY FIELDS - USE DEFAULT VALUES IN DB
                $query  = "SELECT * FROM posts WHERE post_id = {$postId} ";
                $record = QueryDB($query);
                $row    = mysqli_fetch_assoc($record);
                
                $post_category_id = $row['post_category_id'];
                $post_title       = Escape($row['post_title']);
                $post_author      = Escape($row['post_author']);
                $post_user        = $row['post_user'];
                $post_image       = $row['post_image'];
                $post_tags        = Escape($row['post_tags']);
                $post_status      = $row['post_status'];
                $post_content     = Escape($row['post_content']);
                
                echo $post_title;
                
                $query  = "INSERT INTO posts (post_category_id, post_title, post_author, post_user, post_image, post_content, post_tags, post_status, post_date) ";
                $query .= "VALUES ({$post_category_id}, '{$post_title}', '{$post_author}', '{$post_user}', '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}', curdate()) ";
                $record = QueryDB($query);
                break;
                
        }
    }
}
?> 
                          
                      <form action="" method="post">
                           <table class="table table-hover">
                               
                               <div id="bulkOptionsContainer" class="col-xs-4">
                                   <select name="bulk_options" id="" class="form-control">
                                       <option value="">Select Options</option>
                                       <option value="published">Publish</option>
                                       <option value="draft">Draft</option>
                                       <option value="delete">Delete</option>
                                       <option value="clone">Clone</option>
                                   </select>
                               </div>
                               
                               <div class="col-xs-4">
                                   <input type="submit" name="submit" class="btn btn-success" value="Apply">
                                   <a href="posts.php?source=add_posts" class="btn btn-primary">Add New</a>
                               </div>
                               
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" name="" id="checkAllBoxes"></th>
                                        <th>Id</th>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Image</th>
                                        <th>Tags</th>
                                        <th>Status</th>
                                        <th>Comments</th>
                                        <th>Views</th>
                                        <th>Date</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$username   = $_SESSION['username'];    
$query      = "SELECT * FROM posts ";
if(!Is_Admin($username))
    $query .= "WHERE post_user = '{$username}' ";
                                    
$query     .= "ORDER BY post_id DESC ";
$records    = QueryDB($query);
                                    
while ($row = mysqli_fetch_assoc($records)) {
    $post_id          = $row['post_id'];
    $post_category_id = $row['post_category_id'];
    $post_title       = $row['post_title'];
    $post_author      = $row['post_author'];
    $post_image       = $row['post_image'];
    $post_tags        = $row['post_tags'];
    $post_status      = $row['post_status'];
    $post_views_count = $row['post_views_count'];
    $post_date        = $row['post_date'];
    
    echo "<tr>";
?>
                                        <td><input type="checkbox" name="checkBoxArray[]" class="checkBox" value="<?php echo $post_id; ?>"></td>
<?php
    echo "<td>{$post_id}</td>";
    
    $query     = "SELECT * FROM categories ";
    $query    .= "WHERE cat_id = {$post_category_id} ";
    $record    = QueryDB($query);
    
    $row       = mysqli_fetch_assoc($record);
    $cat_id    = $row['cat_id'];
    $cat_title = $row['cat_title'];
    
    echo "<td>{$cat_title}</td>";
    
    echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
    echo "<td>{$post_author}</td>";
    echo "<td><img src='../images/{$post_image}' alt='post-image' class='img-responsive' width='100'></td>";
    echo "<td>{$post_tags}</td>";
    echo "<td>{$post_status}</td>";
    
    $query  = "SELECT * FROM comments ";
    $query .= "WHERE comment_post_id = {$post_id} ";
    $record = QueryDB($query);
    $post_comments_count = mysqli_num_rows($record);
    echo "<td><a href='post_comments.php?p_id={$post_id}'>{$post_comments_count}</a></td>";
    
    echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
    echo "<td>{$post_date}</td>";
    
    echo "<td><a href='posts.php?source=edit_posts&p_id={$post_id}'>Edit</a></td>";
    echo "<td><a rel='{$post_id}' href='javascript:void(0)' class='delete_link'>Delete</a></td>";
    echo "</tr>";
}
?>
                                </tbody>
                            </table>
                        </form>
                        
<?php // BUG IDOR
if(isset($_GET['delete'])) {
    $post_id = Escape($_GET['delete']);
    
    $query   = "DELETE FROM posts ";
    $query  .= "WHERE post_id = {$post_id}";
    $record  = QueryDB($query);
    
    
    $query  = "DELETE FROM comments ";
    $query .= "WHERE comment_post_id = {$post_id}";
    $record = QueryDB($query);
    
    header('Location: posts.php');
}
?>


<?php
if(isset($_GET['reset'])) {
    $post_id = Escape($_GET['reset']);
    
    $query   = "UPDATE posts ";
    $query  .= "SET post_views_count = {$post_views_count} ";
    $query  .= "WHERE post_id = {$post_id}";
    $record  = QueryDB($query);
    
    header('Location: posts.php');
}
?>

<script>
    $(document).ready(function () {
        $('.delete_link').on('click', function () {
            var postId     = $(this).attr('rel');
            var deleteLink = 'posts.php?delete=' + postId;
            
            $('.modal_delete_link').attr('href', deleteLink);
            $('#myModal').modal('show');
        });
    });
</script>
