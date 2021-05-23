<?php
session_start();
if(!isset($_SESSION['member_id']) && $_SESSION['member_id']==''){
	header( "location: login.php" );
	exit;
}
require __DIR__ . '/include.php';

//save
$save = false;
if($_POST){
	$file_id = $_POST['file_id'];
	$sql_del = 'DELETE FROM file_access WHERE file_id="'.$file_id.'"';
	mysqli_query($conn,$sql_del);
	if(count($_POST['chk'])>0){
		foreach ($_POST['chk'] as $key => $value) {
			if($value!='del'){
				$sql_insert = "INSERT INTO file_access(file_id,role_id,member_id) VALUES('".$file_id."','".$value."','".$key."')";
				mysqli_query($conn,$sql_insert);
			}
		}
	}
	$save = true;
}

$chk = false;
$id = $_GET['id'];
$sql = 'SELECT * FROM files WHERE file_id="'.$id.'"';
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$file = $row;
if($row['member_id']==$_SESSION['member_id']){
	$chk = true;
}else{
	$sql = 'SELECT * FROM file_access WHERE file_id="'.$id.'" AND member_id="'.$_SESSION['member_id'].'"';
	$result = mysqli_query($conn,$sql);
	$row_count = mysqli_num_rows($result);
	$file_access_data = mysqli_fetch_array($result, MYSQLI_ASSOC);
	if($row_count>0){
		$sql = 'SELECT * FROM role WHERE  role_id="'.$file_access_data['role_id'].'"';
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if($row['role_edit']=='1'){
			$chk = true;
		}
	}
}
if($chk==true){
	$sql = 'SELECT * FROM role ';
	$result = mysqli_query($conn,$sql);
	$roles = [];
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$roles[] = $row;
	}
	$sql = 'SELECT * FROM file_access WHERE file_id="'.$id.'"';
	$result = mysqli_query($conn,$sql);
	$access = [];
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$access[$row['member_id']] = $row['role_id'];
	}

	$sql = 'SELECT * FROM member WHERE member_id!="'.$_SESSION['member_id'].'" AND member_id!="'.$file['member_id'].'"';
	$result = mysqli_query($conn,$sql);
	$members = [];
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$members[] = $row;
	}

	$delete = false;
	if($_SESSION['member_id']==$file['member_id']){
		$delete = true;
	}
	echo $twig->render('edit.html',['members' => $members , 'roles' => $roles , 'file' => $file, 'access' => $access ,'save' => $save , 'delete' => $delete]);
}else{

}
?>