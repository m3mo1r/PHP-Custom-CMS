<?php include 'includes/header.php'; ?>

    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
               
<?php 

if (isset($_POST['submit'])) {
    $search     = '%' . Escape($_POST['search']) . '%';
    
    $stmt_query = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_tags LIKE ? AND post_status = ? ");
    $published  = 'published';
    
    if(isset($stmt_query)) {
        mysqli_stmt_bind_param($stmt_query, 'ss', $search, $published);
        mysqli_stmt_execute($stmt_query);
        mysqli_stmt_store_result($stmt_query); // STORED BEFORE CHECK NUM_ROWS
        mysqli_stmt_bind_result($stmt_query, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);
    }
    
    $count = mysqli_stmt_num_rows($stmt_query);

    if ($count === 0)
        echo "<h1>No result.</h1>";
    else {
        if ($count === 1)
            echo "<h1>$count result.</h1>";
        else
            echo "<h1>$count results.</h1>";
        
        while (mysqli_stmt_fetch($stmt_query)):
?>
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="/cms/post/<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="/cms/author/<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <a href="/cms/post/<?php echo $post_id; ?>">
                    <img class="img-responsive" src="/cms/images/<?php echo $post_image; ?>" alt="post-image">                    
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="/cms/post/<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
<?php 
        endwhile;
        
        mysqli_stmt_close($stmt_query);
    }
}
?>
                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php'; ?>
            
        </div>
    <!-- /.row -->

    <hr>
        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>
