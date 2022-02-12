<?php include "includes/header.php"; ?>

<?php
if(isset($_GET['email']) && isset($_GET['token'])) {
    $email = Escape($_GET['email']);
    $token = Escape($_GET['token']);

    $query  = "SELECT user_name, user_email, token FROM users ";
    $query .= "WHERE user_email = ? AND token = ? ";
    if($stmt_query = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($stmt_query, 'ss', $email, $token);
        mysqli_stmt_execute($stmt_query);
        mysqli_stmt_store_result($stmt_query);
        if(mysqli_stmt_num_rows($stmt_query) === 0)
            Redirect('/cms/index');
        
        mysqli_stmt_close($stmt_query);
    
        if(isset($_POST['password']) && isset($_POST['confirmPassword'])) {
            if($_POST['password'] === $_POST['confirmPassword']) {
                $password = Escape($_POST['password']);
                $hashed_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $query = "UPDATE users ";
                $query .= "SET token = '', user_password = '{$hashed_password}' ";
                $query .= "WHERE user_email = ? ";
                
                if($stmt_query = mysqli_prepare($connection, $query)) {
                    mysqli_stmt_bind_param($stmt_query, 's', $email);
                    mysqli_stmt_execute($stmt_query);
                    
                    if(mysqli_stmt_affected_rows($stmt_query) >= 1) {
                        $password_changed = true;
                    }
                    mysqli_stmt_close($stmt_query);
                }
            }
        }
    }
} else
    Redirect('/cms/index');
?>

<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>

<div class="container">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">


                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Reset Password</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">
<?php if(!isset($password_changed)): ?>
                                <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
                                            <input id="password" name="password" placeholder="Enter password" class="form-control"  type="password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok color-blue"></i></span>
                                            <input id="confirmPassword" name="confirmPassword" placeholder="Confirm password" class="form-control"  type="password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input name="resetPassword" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>
<?php else: ?>
                                <h2>Your password has been changed. <a href="/cms/login">Please try log in.</a></h2>
<?php endif; ?>
                            </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<hr>
</div> <!-- /.container -->