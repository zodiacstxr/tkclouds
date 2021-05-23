<?php
session_start();
if(!isset($_SESSION['member_id']) && $_SESSION['member_id']==''){
	header( "location: login.php" );
	exit;
}
require __DIR__ . '/include.php';

$sql = 'SELECT * FROM member WHERE member_id!="'.$_SESSION['member_id'].'"';
$result = mysqli_query($conn,$sql);
$members = [];
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	$members[] = $row;
}

$sql = 'SELECT * FROM role ';
$result = mysqli_query($conn,$sql);
$roles = [];
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	$roles[] = $row;
}

$sql = 'SELECT * FROM files WHERE member_id="'.$_SESSION['member_id'].'"';
$result = mysqli_query($conn,$sql);
$files = [];
$i = 0;
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	$files[$i] = $row;
	$files[$i]['no'] = $i+1;
	$i++;
}
echo $twig->render('file_list.html',['members'=>$members , 'files' => $files, 'roles' => $roles]);
?>