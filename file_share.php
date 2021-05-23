<?php
session_start();
if(!isset($_SESSION['member_id']) && $_SESSION['member_id']==''){
	header( "location: login.php" );
	exit;
}
require __DIR__ . '/include.php';

$sql = 'SELECT files.* , file_access.* , role.* FROM file_access 
		INNER JOIN files ON file_access.file_id=files.file_id 
		INNER JOIN role ON file_access.role_id=role.role_id 
		WHERE file_access.member_id = "'.$_SESSION['member_id'].'"';
$result = mysqli_query($conn,$sql);
$files = [];
$i = 0;
if($result){
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$files[$i] = $row;
		$files[$i]['no'] = $i+1;
		$i++;
	}
}

echo $twig->render('file_share.html',[ 'files' => $files]);
?>