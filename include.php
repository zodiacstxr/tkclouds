<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);    
$twig->addGlobal('session', $_SESSION);

$conn = mysqli_connect($config['db_host'],$config['db_user'],$config['db_pass'],$config['db_name']);
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

?>