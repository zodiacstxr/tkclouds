<?php
session_start();
require __DIR__ . '/include.php';
$error = '';
if($_POST){
	$email = $_POST['email'];
	$password = $_POST['password'];
	$sql = 'SELECT * FROM member WHERE member_email="'.$email.'" AND member_password="'.$password.'"';
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	if($row['member_email']==$email){
		$_SESSION["member_id"] = $row['member_id'];
		$_SESSION["member_name"] = $row['member_name'];
		header( "location: file_list.php" );
 		exit;
	}else{
		$error = "อีเมล์หรือรหัสผ่านไม่ถูกต้อง";
	}
}

echo $twig->render('login.html', ['error' => $error]);

?>