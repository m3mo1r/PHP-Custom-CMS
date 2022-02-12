<?php include 'includes/header.php'; ?>

        <!-- Navigation -->
        <?php include 'includes/navigation.php'; ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to <?php echo $_SESSION['role']; ?>
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
 
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
if(isset($_GET['p_id'])) {
    $post_id = $_GET['p_id'];
    $query   = "SELECT * FROM comments ";
    $query  .= "WHERE comment_post_id = $post_id ";
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
        $row    = mysqli_fetch_assoc($record);

        $post_id    = $row['post_id'];
        $post_title = $row['post_title'];

        echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
        echo "<td>{$comment_content}</td>";
        echo "<td>{$comment_status}</td>";

        if($comment_status == 'approved') {
            echo "<td>&nbsp;</td>";
            echo "<td>&nbsp;</td>";
        } else {
            echo "<td><a href='post_comments.php?p_id={$post_id}&approve={$comment_id}'>Approve</a></td>";
            echo "<td><a href='post_comments.php?p_id={$post_id}&unapprove={$comment_id}'>Unapprove</a></td>";   
        }

        echo "<td><a href='post_comments.php?p_id={$post_id}&delete={$comment_id}'>Delete</a></td>";
        echo "<td>{$comment_date}</td>";
        echo "</tr>";
    }
}
?>
                            </tbody>
                        </table>
 
<?php
if(isset($_GET['approve'])) {
    $app_comment_id = Escape($_GET['approve']);
    
    $query  = "UPDATE comments ";
    $query .= "SET comment_status = 'approved' ";
    $query .= "WHERE comment_id = {$app_comment_id}";
    $record = QueryDB($query);
    
    header("Location: post_comments.php?p_id={$post_id}");
}
?>

<?php
if(isset($_GET['unapprove'])) {
    $unapp_comment_id = Escape($_GET['unapprove']);
    
    $query  = "UPDATE comments ";
    $query .= "SET comment_status = 'unapproved' ";
    $query .= "WHERE comment_id = {$unapp_comment_id}";
    $record = QueryDB($query);
    
    header("Location: post_comments.php?p_id={$post_id}");
}
?>                        
                       
<?php
if(isset($_GET['delete'])) {
    $del_comment_id = Escape($_GET['delete']);
    
    $query  = "DELETE FROM comments ";
    $query .= "WHERE comment_id = {$del_comment_id} ";
    $record = QueryDB($query);
    
    header("Location: post_comments.php?p_id={$post_id}");
}
?>
                   
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


<?php include 'includes/footer.php'; ?>