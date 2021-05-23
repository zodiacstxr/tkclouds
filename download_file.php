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
$download_ok = false;
$id = $_GET['id'];
$sql = 'SELECT * FROM files WHERE file_id = "'.$id.'"';
$result = mysqli_query($conn,$sql);
$file = mysqli_fetch_array($result, MYSQLI_ASSOC);

$error = '';
if($file['file_g_id']==''){
	$error = 'No file';
}

if($_SESSION['member_id']==$file['member_id']){
	$download_ok = true;
}else if($file['file_g_id']!=''){

	$sql = 'SELECT * FROM file_access WHERE file_id="'.$id.'" AND member_id="'.$_SESSION['member_id'].'"';
	$result = mysqli_query($conn,$sql);
	$row_count = mysqli_num_rows($result);
	$file_access_data = mysqli_fetch_array($result, MYSQLI_ASSOC);
	if($row_count>0){
		$sql = 'SELECT * FROM role WHERE role_id="'.$file_access_data['role_id'].'"';
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if($row['role_download']=='1'){
			$download_ok = true;
		}else{
			$error = 'ไม่มีสิทธิ์ในการดาวน์โหลด';
		}
	}
}

if($download_ok==true){
	$Gdrive->Download($file['file_g_id'],$file['file_name'],$file['file_g_mime_type']);
}else{
	echo $twig->render('download_error.html', ['error' => $error]);
}

?>