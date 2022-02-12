<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/cms/index">Home Blog</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

<?php 
$query         = "SELECT * FROM categories ";
$records       = QueryDB($query);

while ($row    = mysqli_fetch_assoc($records)) {
    $cat_id    = $row['cat_id'];
    $cat_title = $row['cat_title'];
    $active    = '';
    
    if(isset($_GET['c_id']) && $_GET['c_id'] == $cat_id)
        $active = 'active';
    
    echo "<li class='{$active}'><a href='/cms/category/{$cat_id}'>$cat_title</a></li>";
}

?>

<?php // BUG IDOR
if(isset($_SESSION['role']) && isset($_GET['p_id'])) {
    $p_id = $_GET['p_id'];
    echo "<li><a href='/cms/admin/posts.php?source=edit_posts&p_id={$p_id}'>Edit This Post</a></li>";
}
?>

<?php if(Is_LoggedIn()): ?>
                <li>
                    <a href="/cms/admin">Admin</a>
                </li>
<?php else: ?>
                <li>
                    <a href="/cms/login">Login</a>
                </li>
                
                <li>
                    <a href="/cms/registration">Registration</a>
                </li>
            
                <li>
                    <a href="/cms/contact">Contact</a>
                </li>
<?php endif; ?>    
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>