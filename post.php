<?php include 'includes/header.php'; ?>

    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>

<?php
if(isset($_POST['liked'])) {
    $like_user_id = $_POST['like_user_id'];
    $like_post_id = $_GET['like_post_id'];
    
    $query  = "UPDATE posts ";
    $query .= "SET post_likes_count = post_likes_count + 1 ";
    $query .= "WHERE post_id = {$like_post_id}";
    $record = QueryDB($record);
    
    $query  = "INSERT INTO likes (like_user_id, like_post_id) ";
    $query .= "VALUES ({$like_user_id}, {$like_post_id}) ";
    $record = QueryDB($query);
}
?>
               
<?php
if(isset($_POST['unliked'])) {
    $like_user_id = $_POST['like_user_id'];
    $like_post_id = $_POST['like_post_id'];
    
    $query  = "UPDATE posts ";
    $query .= "SET post_likes_count = post_likes_count - 1 ";
    $query .= "WHERE post_id = {$like_post_id}";
    $record = QueryDB($record);
    
    $query  = "DELETE FROM likes ";
    $query .= "WHERE like_user_id = {$like_user_id} AND like_post_id = {$like_post_id} ";
    $record = QueryDB($query);
}
?>
                
<?php // JUST ADMIN SEE DRAFT POST
if(isset($_GET['p_id'])) {
    $post_id = Escape($_GET['p_id']);
    $query   = "SELECT * FROM posts ";
    $query  .= "WHERE post_id = {$post_id} ";
    $records = QueryDB($query);
    $row     = mysqli_fetch_assoc($records);
    
    $post_status = $row['post_status'];
    $post_user = $row['post_user'];
    if($post_status === 'draft' && !isset($_SESSION['role'])) // BUG IDOR
        header('Location: index.php');
    
    $post_title  = $row['post_title'];
    $post_author = $row['post_author'];
    
    $post_user = $row['post_user'];
    if(empty($post_user))
        $post_user = 'hacker';
    
    $post_date    = $row['post_date'];
    $post_image   = $row['post_image'];
    $post_content = $row['post_content'];
    
    $query  = "UPDATE posts ";
    $query .= "SET post_views_count = post_views_count + 1 ";
    $query .= "WHERE post_id = {$post_id} ";
    $record = QueryDB($query);
}
?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $post_title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="/cms/author/<?php echo $post_author; ?>"><?php echo $post_author; ?></a> 
                    and uploaded by <a href="/cms/author/uploaded/<?php echo $post_user; ?>"><?php echo $post_user; ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="/cms/images/<?php echo $post_image; ?>" alt="post-image">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="/cms/post/<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
                
                <!-- Post Likes -->
<?php if(Is_LoggedIn()): ?>
    <?php if(!User_Like_This_Post($post_id)): ?>
                <div class="row">
                    <p class="pull-right"><a data-toggle="tooltip" data-placement="top" title="Want to like it!" class="like" href=""><span class="glyphicon glyphicon-thumbs-up"></span> Like</a></p>
                </div>
    <?php else: ?>
                <div class="row">
                    <p class="pull-right"><a data-toggle="tooltip" data-placement="top" title="You liked it before~" class="unlike" href=""><span class="glyphicon glyphicon-thumbs-down"></span> Unlike</a></p>
                </div>
    <?php endif; ?>
<?php else: ?>
               <div class="row">
                    <p class="pull-right login_now">You need to login to like this post! <a href="/cms/login">Login now</a></p>
                </div>
<?php endif; ?>
                <div class="row">
                    <p class="pull-right likes">Like: <?php echo Get_Num_Likes($post_id); ?></p>
                </div>
                <div class="clearfix"></div>

                <!-- Blog Comments -->
<?php
if(isset($_POST['create_comment']) && isset($_GET['p_id'])) {
    $comment_post_id = Escape($_GET['p_id']);
    $comment_author  = Escape($_POST['comment_author']);
    $comment_email   = Escape($_POST['comment_email']);
    $comment_content = Escape($_POST['comment_content']);
    
    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
        $query  = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_date) ";
        $query .= "VALUES ('{$comment_post_id}', '{$comment_author}', '{$comment_email}', '{$comment_content}', now()) ";
        $record = QueryDB($query);
    } else
        echo "<script>alert('No joke 👌')</script>";
}
?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                       <div class="form-group">
                           <label for="comment_author">Author</label>
                           <input type="text" class="form-control" name="comment_author" id="comment_author" required>
                       </div>
                       
                       <div class="form-group">
                           <label for="comment_email">Email</label>
                           <input type="email" class="form-control" name="comment_email" id="comment_email" required>
                       </div>
                       
                        <div class="form-group">
                            <label for="comment_content">Your comment</label>
                            <textarea class="form-control" name="comment_content" id="comment_content" rows="3" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
<?php
if(isset($_GET['p_id'])) {
    $comment_post_id = Escape($_GET['p_id']);
    
    $query           = "SELECT * FROM comments ";
    $query          .= "WHERE comment_post_id = {$comment_post_id} AND comment_status = 'approved' ";
    $query          .= "ORDER BY comment_id DESC ";
    $records         = QueryDB($query);

    while ($row = mysqli_fetch_assoc($records)) {
        $comment_author  = $row['comment_author'];
        $comment_content = $row['comment_content'];
        $comment_date    = $row['comment_date'];
?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
<?php } } ?>

            </div>
            
            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php'; ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>
               
<script>
    $(document).ready(function () {
        // Tooltip
        $('[data-toggle="tooltip"]').tooltip();
        
        // Like
        var like_user_id = <?php echo Current_UserId(); ?>;
        var like_post_id = <?php echo $post_id; ?>;
        $('.like').click(function () {
            $.ajax({
                url: "/cms/post.php?p_id=<?php echo $post_id; ?>",
                type: 'post',
                data: {
                    'liked': 1,
                    'like_user_id': like_user_id,
                    'like_post_id': like_post_id
                }
            });
        });
        
        $('.unlike').click(function () {
            $.ajax({
                url: "/cms/post.php?p_id=<?php echo $post_id; ?>",
                type: 'post',
                data: {
                    'unliked': 1,
                    'like_user_id': like_user_id,
                    'like_post_id': like_post_id
                }
            });
        });
    });
</script>
                