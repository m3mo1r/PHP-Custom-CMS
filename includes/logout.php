<?php ob_start(); ?>
<?php session_start(); ?>
<?php include 'functions.php'; ?>

<?php
$_SESSION['username']  = NULL;
$_SESSION['firstname'] = NULL;
$_SESSION['lastname']  = NULL;
$_SESSION['role']      = NULL;

Redirect('/cms/index');
?>