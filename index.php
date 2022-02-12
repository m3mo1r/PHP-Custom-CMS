<?php include 'includes/header.php'; ?>

    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
<?php

if(isset($_GET['page']))
    $page = $_GET['page'];
else
    $page = 1;

$posts_in_page = 5;

if($page === '' || $page === 1)
    $post_start = 0;
else
    $post_start = ($page * $posts_in_page) - $posts_in_page;

$query  = "SELECT * FROM posts ";
$query .= "WHERE post_status = 'published' ";

$records     = QueryDB($query);
$rows_count  = mysqli_num_rows($records);
$pages_count = ceil($rows_count / $posts_in_page);
                
$query  .= "LIMIT {$post_start}, {$posts_in_page} ";
$records = QueryDB($query);
                
if(!mysqli_num_rows($records))
    echo "<h1 class='text-center'>No post is published.</h1>";

while ($row = mysqli_fetch_assoc($records)) {
    $post_id      = $row['post_id'];
    $post_title   = $row['post_title'];
    $post_author  = $row['post_author'];
    $post_date    = $row['post_date'];
    $post_image   = $row['post_image'];
    $post_content = substr($row['post_content'], 0, 400);
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
                
<?php } ?>

            </div>
            <!-- /.col-md-8 -->

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php'; ?>
            
        </div>
    <!-- /.row -->
    
    <ul class="pager">
<?php
if($pages_count > 1) {
    for($i = 1; $i <= $pages_count; $i++) {
        if($i == $page)
            echo "<li><a class='active_link' href='/cms/index/{$i}'>{$i}</a></li>";
        else
            echo "<li><a href='/cms/index/{$i}'>{$i}</a></li>";
    }
}
 ?> 
    </ul>

    <hr>
        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>
