<?php
if(Is_Method('post') && isset($_POST['login'])) {
   $username = Escape($_POST['username']);
   $password = Escape($_POST['password']);
    
   Login_User($username, $password);
}
?>
       
       <div class="col-md-4">

        <!-- Blog Search Well -->
        <div class="well">
            <h4>Blog Search</h4>
            <form action="search.php" method="post"><!-- search form -->
                <div class="input-group">
                    <input name="search" type="text" class="form-control">
                    <span class="input-group-btn">
                        <button name="submit" class="btn btn-default" type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                    </button>
                    </span>
                </div>
            </form>
                <!-- /.input-group -->
        </div>
        
        <!-- Login Form Well -->
        <div class="well">
<?php if(isset($_SESSION['role'])): ?>
            <h4>Logged in as <?php echo $_SESSION['username']; ?></h4>
            
            <a href="/cms/includes/logout.php" class="btn btn-primary">Logout</a>
<?php else: ?>
            <h4>Login</h4>
            <form action="" method="post"><!-- login form -->
               <div class="form-group">
                   <input type="text" name="username" class="form-control" placeholder="Enter Username">
               </div>
               
                <div class="input-group">
                    <input name="password" type="password" class="form-control" placeholder="Enter Password">
                    <span class="input-group-btn">
                        <button name="login" class="btn btn-primary" type="submit">Submit</button>
                    </span>
                </div>
                
                <div class="form-group">
                    <a href="forgot.php?forgot=<?php echo uniqid(); ?>">Forgot Password?</a>
                </div>
            </form>
                <!-- /.input-group -->
<?php endif; ?>
        </div>
        
        <!-- Blog Categories Well -->
        <div class="well">
           <?php 
    
            $query   = "SELECT * FROM categories ";
            $records = QueryDB($query);

            ?>

            <h4>Blog Categories</h4>
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-unstyled">
                        <?php
                        
                        while ($row    = mysqli_fetch_assoc($records)) {
                            $cat_id    = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                            
                            echo "<li><a href='/cms/category/$cat_id'>{$cat_title}</a></li>";
                        }
                        
                        ?>
                    </ul>
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>

        <!-- Side Widget Well -->
        <?php include 'widget.php'; ?>

    </div>


