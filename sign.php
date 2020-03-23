<?php

require_once('config.php');
require_once('conf/funciones.php');
include 'conf/sql_check.php';


    $cid = clean($_GET['CID']);
    $res = mssql_query("SELECT * FROM Character WHERE CID = '$cid'");
    $char = mssql_fetch_assoc($res);
    $res2 = mssql_query("SELECT * FROM ClanMember WHERE CID = '".$char['CID']."'");
    $clan = mssql_fetch_assoc($res2);
    $res3 = mssql_query("SELECT * FROM Clan WHERE CLID = '".$clan['CLID']."'");
    $claninfo = mssql_fetch_assoc($res3);
    


    if($cid == ""){
       Messenger_Gunz("No tienes personajes","index.php");
    }
       



header("Content-type: image/png");

$im = imagecreatefrompng($img);

$name = $char['Name'];
$level = $char['Level'];
$clan = $claninfo['Name'];
$nclan = "No Clan";


if ($char['GameCount'] == 0) {
    $status = "Offline";
}else{
    $status = "Online";
}

$green = imagecolorallocate($im, 75, 216, 13);
$red = imagecolorallocate($im, 224, 8, 8);
$defaulColor = imagecolorallocate($im, 21, 122, 175);


$fonte = 'BebasNeue.otf';


imagettftext($im, 15, 0, 70, 100,$defaulColor,$fonte,$name);
imagettftext($im, 15, 0, 77, 132,$defaulColor,$fonte,$level);
if ($claninfo == "") {
   imagettftext($im, 15, 0, 182, 132,$defaulColor,$fonte,$nclan);
}else{
    imagettftext($im, 15, 0, 182, 132,$defaulColor,$fonte,$clan);
}
if ($char['GameCount'] == 0) {
    imagettftext($im, 13, 0, 300, 100,$red,$fonte,$status);
}else{
    imagettftext($im, 13, 0, 300, 100,$green,$fonte,$status);
}




imagepng($im);
imagedestroy($im);

//Fix by FireWork™
?>