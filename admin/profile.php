<?php include 'includes/header.php'; ?>

<?php
if(isset($_SESSION['username'])) {
    $user_name      = $_SESSION['username'];
    
    $query          = "SELECT * FROM users ";
    $query         .= "WHERE user_name = '{$user_name}' ";
    $record         = QueryDB($query);
    
    $row            = mysqli_fetch_assoc($record);
    $user_id        = $row['user_id'];
    $user_firstname = $row['user_firstname'];
    $user_lastname  = $row['user_lastname'];
    $user_role      = $row['user_role'];
    $user_name      = $row['user_name'];
    $user_email     = $row['user_email'];
    $user_image     = $row['user_image'];
    $user_password  = $row['user_password'];
}
?>

<?php
if(isset($_POST['update_profile']))
    include 'includes/update_users.php';
?>

        <!-- Navigation -->
        <?php include 'includes/navigation.php'; ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small>Author</small>
                        </h1>
                        
<?php include 'includes/form_user.php'; ?>
                   
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


<?php include 'includes/footer.php'; ?>
