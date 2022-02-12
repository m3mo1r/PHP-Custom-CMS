<?php  include "includes/header.php"; ?>

<?php
if(isset($_POST['submit'])) {
    $username   = Escape($_POST['username']);
    $email      = Escape($_POST['email']);
    $password   = Escape($_POST['password']);
    
    $message = Check_Errors($username, $email, $password);
    if(empty($message)) {
        $hashed_password   = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
        $stmt_query = mysqli_prepare($connection, "INSERT INTO users (user_name, user_email, user_password, user_role) VALUES (?, ?, ?, ?) ");
        $role = 'subscriber';
        
        mysqli_stmt_bind_param($stmt_query, "ssss", $username, $email, $hashed_password, $role);
        mysqli_stmt_execute($stmt_query);
        mysqli_stmt_close($stmt_query);
        
        $message    = 'Success! Try login.';
    }
}
?>
    
<?php
if(isset($_GET['lang']) && !empty($_GET['lang'])) {
    $_SESSION['lang'] = Escape($_GET['lang']);
    
    if(isset($_SESSION['lang']) && $_SESSION['lang'] !== $_GET['lang'])
        echo "<script>location.reload();</script>";  
}

if(isset($_SESSION['lang']))
    include "includes/languages/{$_SESSION['lang']}.php";
else
    include "includes/languages/en.php";
?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
        <form method="get" action="" class="navbar-form navbar-right" id="language_form">
            <div class="form-group">
                <select name="lang" class="form-control" onchange="changeLanguage()">
                    <option value="en" <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] === 'en') echo "selected"; ?>>English</option>
                    <option value="es" <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] === 'es') echo "selected"; ?>>Spanish</option>
                    <option value="vn" <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] === 'vn') echo "selected"; ?>>Vietnamese</option>
                </select>
            </div>
        </form>
    
        <section id="login">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-wrap">
                        <h1><?php echo _REGISTER; ?></h1>
                            <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                               <h6 class="text-center"><?php if(isset($message)) echo $message; ?></h6>
                                <div class="form-group">
                                    <label for="username" class="sr-only">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="<?php echo _USERNAME; ?>" value="<?php if(isset($username)) echo $username; ?>" required>
                                </div>
                                 <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo _EMAIL; ?>" value="<?php if(isset($email)) echo $email; ?>"  required>
                                </div>
                                 <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="<?php echo _PASSWORD; ?>" required>
                                </div>

                                <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register" required>
                            </form>

                        </div>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </section>
<script>
    function changeLanguage() {
        document.getElementById('language_form').submit();
    }
</script>