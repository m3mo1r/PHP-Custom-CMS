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
                        
                        <div class="col-xs-6">
                           
                           <?php  // ADD NEW CATEGORY
                            InsertCategories();
                            ?>
                           
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input type="text" class="form-control" name="cat_title" id="cat_title">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="create_submit" value="Add Category">
                                </div>
                            </form>
                               
                            <?php 
                            if (isset($_GET['edit'])) {
                                $cat_id = $_GET['edit'];
                                
                                include 'includes/update_categories.php';
                            }
                            ?>
                            
                        </div>
                        
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php // SHOW CATEGORIES
                                    FindAllCategories();
                                    ?>
                                    
                                    <?php // DELETE CATEGORY
                                    DeleteCategories();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


<?php include 'includes/footer.php'; ?>
