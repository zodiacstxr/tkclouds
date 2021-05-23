<?php
/*****************************************************************
Created :  2017-03-16
Author : Mr. Khwanchai Kaewyos (LookHin)
E-mail : khwanchai@gmail.com
Website : https://www.unzeen.com
Facebook : https://www.facebook.com/LookHin
Source Code On Github : https://github.com/LookHin/google-drive-api
*****************************************************************/

include_once("google-drive-api.class.php");

$strClientId = "602760370622-qp5dj77lc0o0q4cf73m87eme80m14o7m.apps.googleusercontent.com";
$strClientSecret = "h_HHb4hHAFQ0EZdv7dPqMIFS";
$strRefreshToken = "1//0geQw5vTjdVehCgYIARAAGBASNwF-L9IrRRGsKxQ9P7-GZfcJBV97Ulhsm79PaMm_9iNSZSWc7ch42FXfoqX5_fxuWxwkR8zgJws";

// Init Drive Object
$obj = new GoogleDriveApi($strClientId, $strClientSecret);
$obj->setAccessTokenFromRefreshToken($strRefreshToken);

// List File From Root Folder
//$arrFile = $obj->ListFileAndFolder("root");
//print_r($arrFile);

// # List File From Folder Id
//$arrFile = $obj->ListFileAndFolder("1wNfzm2iDYdz5CimI3G1XsWQy0R3v4R9k");
//print_r($arrFile);

$arrFile = $obj->Download("1wNfzm2iDYdz5CimI3G1XsWQy0R3v4R9k",'123.jpg','');
print_r($arrFile);

// # Create Folder In Root Folder
//$obj->CreateFolder("root", "_NEW_FOLDER_NAME_");

// # Create Folder In Parent Folder
//$obj->CreateFolder("_PARENT_FOLDER_ID_", "_NEW_FOLDER_NAME_");

// # Delete File & Folder
//$obj->Delete("_FILE_OR_FOLDER_ID_");

// # Upload File To Root Folder
//$arrResult = $obj->Upload("root", "no-face.png");
//print_r($arrResult);

// # Upload File To Parent Folder
//$arrResult = $obj->Upload("1KhZUj8Sv2lLiLU0rJ9Q7ye58gytetzLY", "no-face.png");
//print_r($arrResult);

?>