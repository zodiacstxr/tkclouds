<?php
session_start();
require __DIR__ . '/include.php';

unset($_SESSION["member_id"]);
unset($_SESSION["member_name"]);
header( "location: login.php" );
exit;
	
?>