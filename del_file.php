<?php
session_start();
if(!isset($_SESSION['member_id']) && $_SESSION['member_id']==''){
	header( "location: login.php" );
	exit;
}

require __DIR__ . '/include.php';
require __DIR__  . '/google-drive-api/google-drive-api.class.php';

$strClientId = $config['g_client_id'];
$strClientSecret = $config['g_client_secret'];
$strRefreshToken = $config['g_client_refresh_token'];
// Init Drive Object
$Gdrive = new GoogleDriveApi($strClientId, $strClientSecret);
$Gdrive->setAccessTokenFromRefreshToken($strRefreshToken);

$id = $_GET['id'];
$sql = 'SELECT * FROM files WHERE file_id = "'.$id.'"';
$result = mysqli_query($conn,$sql);
$file = mysqli_fetch_array($result, MYSQLI_ASSOC);

$sql = 'SELECT * FROM file_access WHERE file_id="'.$id.'" AND member_id="'.$_SESSION['member_id'].'"';
$result = mysqli_query($conn,$sql);
$row_count = mysqli_num_rows($result);
$file_access_data = mysqli_fetch_array($result, MYSQLI_ASSOC);
$delete_ok = false;
if($row_count>0){
	$sql = 'SELECT * FROM role WHERE role_id="'.$file_access_data["role_id"].'"';
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	if($row['role_delete']=='1'){
		$delete_ok = true;
	}else{
		$error = '';
	}
}

if($file['member_id']==$_SESSION['member_id']){
	$delete_ok = true;
}

if($delete_ok==true){
	$Gdrive->Delete($file['file_g_id']);
	$sql = 'DELETE FROM files WHERE file_id = "'.$id.'"';
	$result = mysqli_query($conn,$sql);
}
echo $twig->render('del_file.html', []);
?>