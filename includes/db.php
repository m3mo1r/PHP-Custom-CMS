<?php ob_start();

define('DB', [
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'name' => 'cms'
]);

$connection = mysqli_connect(DB['host'], DB['user'], DB['pass'], DB['name']);

$query = "SET NAMES utf8";
mysqli_query($connection, $query);

if (!$connection)
    echo 'Failed to connect database!';

?>