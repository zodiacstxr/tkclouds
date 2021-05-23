<?php
session_start();
require __DIR__ . '/include.php';
echo $twig->render('home.html');
?>