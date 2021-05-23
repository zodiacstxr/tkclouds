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

if(isset($_FILES['file'])){
	$file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
    $ex = explode('.',$_FILES['file']['name']);
    $file_ext = end($ex);
    $file_new_name = md5(time()).'.'.$file_ext;
    $file_code = md5(time().rand(1,100).$_SESSION['member_id']);
    move_uploaded_file($file_tmp,"uploads/".$file_new_name);
    $arrResult = $Gdrive->Upload("1KhZUj8Sv2lLiLU0rJ9Q7ye58gytetzLY","uploads/".$file_new_name);
	//print_r($arrResult);
	$g_file_id = $arrResult['id'];
	$g_file_mime_type = $arrResult['mimeType'];
	$sql = 'INSERT INTO files(
				file_name,
				file_code,
				file_g_id,
				file_g_mime_type,
				file_date,
				member_id
			) VALUES(
				"'.$file_name.'",
				"'.$file_code.'",
				"'.$g_file_id.'",
				"'.$g_file_mime_type.'",
				"'.date('Y-m-d H:i:s').'",
				"'.$_SESSION['member_id'].'"
			)';
	echo $sql;
	mysqli_query($conn,$sql);
	@unlink("uploads/".$file_new_name);
	$sql = 'SELECT MAX(file_id) AS id FROM files ';
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$file_id = $row['id'];
	if(count($_POST['chk'])>0){
		foreach ($_POST['chk'] as $key => $value) {
			$sql_insert = "INSERT INTO file_access(file_id,role_id,member_id) VALUES('".$file_id."','".$value."','".$key."')";
			mysqli_query($conn,$sql_insert);
		}
	}

	header( "location: file_list.php" );
	exit;
}

?>