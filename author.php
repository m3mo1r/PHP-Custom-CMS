<?php include 'includes/header.php'; ?>

    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            
            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
                
<?php
if(isset($_GET['author'])) {
    $post_author = Escape($_GET['author']);
    
    $query       = "SELECT * FROM posts ";
    $query      .= "WHERE post_author = '{$post_author}' AND post_status = 'published' ";
}
elseif(isset($_GET['uploaded_by'])) {
    $post_user = Escape($_GET['uploaded_by']);
    
    $query     = "SELECT * FROM posts ";
    $query    .= "WHERE post_user = '{$post_user}' AND post_status = 'published' ";
}
                
$records = QueryDB($query);
while($row = mysqli_fetch_assoc($records)) {
    $post_id      = $row['post_id'];
    $post_title   = $row['post_title'];
    $post_date    = $row['post_date'];
    $post_image   = $row['post_image'];
    $post_content = $row['post_content'];
      
?>

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $post_title; ?></h1>

                <!-- Author -->
                <p class="lead">
<?php
if(isset($post_author))
    echo "All posts created by {$post_author}";
elseif(isset($post_user))
    echo "All posts uploaded by {$post_user}";
?>
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
<?php
}
?>
            </div>
            <!-- /.col-lg-8 -->
            
            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php'; ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>
                