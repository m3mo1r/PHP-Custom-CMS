<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>
<?php  include "includes/header.php"; ?>

    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>

<?php
require 'vendor/autoload.php';

if(!Is_Method('get') && !isset($_GET['forgot']))
    Redirect('index');

if(Is_Method('post') || isset($_POST['email'])) {
    $email  = $_POST['email'];
    
    $host   = 'http://localhost:80';
    $length = 50;
    $token  = bin2hex(openssl_random_pseudo_bytes($length));
    
    if(Existed_Email($email)) {
        $stmt_query = mysqli_prepare($connection, "UPDATE users SET token = '{$token}' WHERE user_email = ? ");
        if(isset($stmt_query)) {
            mysqli_stmt_bind_param($stmt_query, 's', $email);
            mysqli_stmt_execute($stmt_query);
        } else
            echo mysqli_stmt_error($stmt_query);
        
        mysqli_stmt_close($stmt_query);
        
        $mail             = new PHPMailer();
        $mail->isSMTP();
        
        $mail->Host       = Mail_Config::SMTP_HOST;
        $mail->Port       = Mail_Config::SMTP_PORT;
        $mail->Username   = Mail_Config::SMTP_USERNAME;
        $mail->Password   = Mail_Config::SMTP_PASSWORD;
        
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Charset    = 'UTF-8';
        
        $mail->setFrom('cassano@mafia.italia', 'vincenzo');
        $mail->addAddress($email);
        
        $mail->isHTML(true);
        $mail->Subject    = 'Forgot Password';
        $mail->Body       = "<p>Please click to reset your password
                                <a href='{$host}/cms/reset.php?email={$email}&token={$token}'>
                                    {$host}/cms/reset.php?email={$email}&token={$token}
                                </a>
                             </p>";
        
        if($mail->send())
            $email_sent = true;
    }
}
?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">


                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">

<?php if(!isset($email_sent)): ?>


                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>
<?php else: ?>
                                    <h2>Please check your email</h2>
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

