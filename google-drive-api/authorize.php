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

// Init Drive Object
$obj = new GoogleDriveApi($strClientId, $strClientSecret);

if(empty($_GET['code'])){

  $strAuthScope = "https://www.googleapis.com/auth/drive";
  $strAuthorizetUrl = $obj->getAuthorizetUrl($strAuthScope);

  header("Location: {$strAuthorizetUrl}");
  exit;

}else{

  $strRefreshToken = $obj->getRefreshToken($_GET['code']);
  print "Refrest Token = ".$strRefreshToken;

}


?>
