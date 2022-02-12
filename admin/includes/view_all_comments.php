                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Email</th>
                                    <th>In response to</th>
                                    <th>Comment</th>
                                    <th>Status</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
<?php 
$query   = "SELECT * FROM comments ";
$records = QueryDB($query);
while($row = mysqli_fetch_assoc($records)) {
    $comment_id      = $row['comment_id'];
    $comment_author  = $row['comment_author'];
    $comment_email   = $row['comment_email'];
    $comment_post_id = $row['comment_post_id'];
    $comment_content = $row['comment_content'];
    $comment_status  = $row['comment_status'];
    $comment_date    = $row['comment_date'];
    
    echo "<tr>";
    echo "<td>{$comment_id}</td>";
    echo "<td>{$comment_author}</td>";
    echo "<td>{$comment_email}</td>";
    
    $query  = "SELECT * FROM posts ";
    $query .= "WHERE post_id = {$comment_post_id} ";
    $record = QueryDB($query);
    $row = mysqli_fetch_assoc($record);
    
    $post_id    = $row['post_id'];
    $post_title = $row['post_title'];
    
    echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
    echo "<td>{$comment_content}</td>";
    echo "<td>{$comment_status}</td>";
    
    if($comment_status === 'approved') {
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
    } else {
        echo "<td><a class='btn btn-success' href='comments.php?approve={$comment_id}'>Approve</a></td>";
        echo "<td><a class='btn btn-info' href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";   
    }
?>

            <form action="" method="post">
                <input type="hidden" name="comment_id" value="<?php echo $comment_id; ?>">
                <td><input type="submit" class="btn btn-danger" name="delete" value="Delete"></td>
            </form>

<?php
    echo "<td>{$comment_date}</td>";
    echo "</tr>";
}
?>
                            </tbody>
                        </table>
 
<?php // BUG IDOR
if(isset($_GET['approve'])) {
    $app_comment_id = Escape($_GET['approve']);
    
    $query  = "UPDATE comments ";
    $query .= "SET comment_status = 'approved' ";
    $query .= "WHERE comment_id = {$app_comment_id}";
    $record = QueryDB($query);
    
    header('Location: comments.php');
}
?>

<?php // BUG IDOR
if(isset($_GET['unapprove'])) {
    $unapp_comment_id = Escape($_GET['unapprove']);
    
    $query  = "UPDATE comments ";
    $query .= "SET comment_status = 'unapproved' ";
    $query .= "WHERE comment_id = {$unapp_comment_id}";
    $record = QueryDB($query);
    
    header('Location: comments.php');
}
?>                        
                       
<?php // BUG IDOR
if(isset($_POST['delete'])) {
    $del_comment_id = Escape($_POST['comment_id']);
    
    $query  = "DELETE FROM comments ";
    $query .= "WHERE comment_id = {$del_comment_id} ";
    $record = QueryDB($query);
    
    header('Location: comments.php');
}
?>