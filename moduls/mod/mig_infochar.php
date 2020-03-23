<?php

//if($_SESSION[AID] == ""){
if(1 == 1){

    Messenger_Gunz ("El Modulo no funciona por el momento.","index.php");
    die();
}
/*
$chk_query = mssql_query("SELECT * FROM Character(nolock) where CID = '$CID'");


if (mssql_num_rows($CID) == 0) {

   Messenger_Gunz("Este personaje no existe","?mod=rankindividual");
}

$_charprofile = mssql_fetch_assoc($CID);

if ($_charprofile['GameCount'] == 0) {

    $status = "Offline";
    $statclass = "class='larojadapadre'";

}else{
    $status = "Online";
    $statclass = "class='laverdesadapadre'";
}*/



include('class_include/class_contenido_columna_one.php');
?>
<div class="mid">
    <div class="module">
        <div class="module">
            <h3>Informaciones del Personaje <?=$_charprofile[Name]?></h3>
            <div class="content">
                <div class="clear-float"></div>
                <div id="fortumo-ve" class="tab-page active-page">
                    <ul class="registerform">
                        <br>
                        <h1><?=$_charprofile[Name]?></h1>
                        <br\><br\>
                        <table class="latablitawey">
                            <tbody>
                                <tr>
                                    <td class="lanegradapadre">Level</td>
                                    <td><?=$_charprofile[Level]?></td>
                                </tr>
                                <tr>
                                    <td class="lanegradapadre">XP</td>
                                    <td><?=$_charprofile[XP]?></td>
                                </tr>
                                <tr>
                                    <td class="lanegradapadre">Ranking</td>
                                    <td><?=$_charprofile[Ranking]?></td>
                                </tr>
                                <tr>
                                <td class="lanegradapadre">KillCount</td>
                                    <td><?=$_charprofile[KillCount]?></td>
                                </tr>
                                <tr>
                                    <td class="lanegradapadre">DeathCount</td>
                                    <td><?=$_charprofile[DeathCount]?></td>
                                </tr>
                                <tr>
                                    <td class="lanegradapadre">PlayTime</td>
                                    <td><?=$_charprofile[PlayTime]?></td>
                                </tr>
                                <tr>
                                    <td class="lanegradapadre">Country</td>
                                    <td><?=$_charprofile[Country]?></td>
                                </tr>
                                <tr>
                                    <td class="lanegradapadre">Status</td>
                                    <td <?=$statclass?>> <?=$status?> </td>
                                </tr>
                            </tbody>
                        </table>           
                        </br\></br\>
                    </ul>
                </div>
            </div>
        </div>                
    </div>
</div>
<?php
include('class_include/class_contenido_columna_three.php');
?>