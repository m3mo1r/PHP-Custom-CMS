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
                    </div>
                </div>
                <!-- /.row -->
                
                <?php include 'includes/widgets.php'; ?>
                
                <?php include 'includes/chart.php'; ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


<?php include 'includes/footer.php'; ?>
