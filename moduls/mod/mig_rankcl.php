<?php
    ModulsTitle("AeroGamez Gunz - Clan Ranking");

    include('class_include/class_contenido_columna_one.php');

    ranking_clan_update();
?>  
<div class="mid">
    <div class="module">
        <div>
            <h3>Rankings</h3>
            <ul class="shopcats">
                <p>Elegir la categoría</p>
                <a href="?mod=rankindividual&page=1"><li><i class="dki person"></i>Individual</li></a>
                <li class="active"><i class="dki world"></i>Clan</li>
                <a href="?mod=rankcw"><li><i class="dki star"></i>Guerra de Clan</li></a>
            </ul>
            <div>
            <div align="center">
                <form method="GET" name="indsearch" action="index.php">
                    <input type="hidden" name="mod" value="rankcl" />
                    <input type="hidden" name="type" Value="1"/>
                    <input type="text" name="name" class="bxrankbuscar" placeholder="Buscar Clan" required> <input name="submit" type="submit"  value="Buscar">
                </form>
            </div>
                <table class="ranking">
                        <tbody>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">&nbsp;</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">MASTER</th>
                            <th scope="col">W/L</th>
                            <th scope="col">PUNTOS</th>
                        </tr>
<?php
if( isset($_GET['type']) && isset($_GET['name']) ) {

    $search = 1;
    $type = clean($_GET['type']);
    $name = clean($_GET['name']);

    if($type == 1){

        $squery = "SELECT * FROM Clan(nolock) WHERE Name = '$name'";

    } elseif($type == 2) {

        $charq = mssql_query("SELECT CID FROM Character(nolock) WHERE Name = '$name'");
        if( mssql_num_rows($charq) == 1 ){

        $characterdata = mssql_fetch_row($charq);
        $cid = $characterdata[0];
        $squery = "SELECT * FROM Clan(nolock) WHERE MasterCID = '$cid' AND DeleteFlag=0 ORDER BY Point DESC";
        }else{
            echo '
                        <tr>
                            <td><span class="pos">1</span></td>
                            <td><img class="zoom_thumb" src="emblem/noemblem.jpg"></td>
                            <td>No Data</td>
                            <td>No Data</td>
                            <td>No Data</td>
                            <td>No Data</td>
                        </tr>';
            }
    }else{

        $search = 0;
    }
}

if($search == 0 ) {
    switch( clean($_GET['page']) ) {
        case "":
            $ranks = "Ranking >= 1 AND Ranking <= 20";
        break;
        case "2":
            $ranks = "Ranking > 21 AND Ranking <= 42";
        break;
        case "3":
            $ranks = "Ranking > 43 AND Ranking <= 62";
        break;
        case "4":
            $ranks = "Ranking > 82 AND Ranking <= 102";
        break;
         case "5":
            $ranks = "Ranking > 122 AND Ranking <= 142";
        break;
        default:
            $ranks = "Ranking <= 20";
        break;
    }

        $res = mssql_query("SELECT TOP 20 * FROM Clan(nolock) WHERE (DeleteFlag=0 OR DeleteFlag=NULL) AND (Wins != 0 OR Losses != 0) AND $ranks ORDER BY Point DESC, TotalPoint DESC, Wins DESC, Losses ASC");

}else{
    $res = mssql_query($squery);
}

if(mssql_num_rows($res) <> 0) {

    $count = 1;
    while($clan = mssql_fetch_object($res)) {

    $clanemburl = ($clan->EmblemUrl == "") ? "noemblem.png" : $clan->EmblemUrl;
    $linkclan = ($clan->CLID == "") ? "noemblem.png" : $clan->CLID;
    $clanrank .= '

                        <tr>
                            <td><span class="pos">'.$clan->Ranking.'</span></td>
                            <td><img class="zoom_thumb" src="emblem/'.$clanemburl.'"></td>
                            <td><a href="?mod=infoclan&CLID='.$linkclan.'">'.$clan->Name.'</a></td>
                            <td>'.GetCharNameByCID($clan->MasterCID).'</td>
                            <td>'.$clan->Wins . "/" . $clan->Losses.'</td>
                            <td>'.$clan->Point.'</td>
                        </tr>';

    $count++;

    }
}else{
    $clanrank = 'No Data';
    }

    echo $clanrank;
?>

                    </tbody>
                </table>
                <ul class="pagination">
                    <ul class="pagination">
<?
if( $search == 0 ){ 

    $name = clean($_GET['name']);
    $type = clean($_GET['type']);



    $a =  $_GET['page'] - 1;
    $b =  $_GET['page'] + 1;
?>
                    <!-- Previous page link -->
                    <?
                        if ($page >= 2) {
                    ?><li><a href="?mod=rankcl&page=<?=$a?>">« Previous</a></li><?}?>
                    <!-- Numbered page links -->
                    <li><a href="?mod=rankcl">1</a></li>
                    <li><a href="?mod=rankcl&page=2">2</a></li>
                    <li><a href="?mod=rankcl&page=3">3</a></li>
                    <li><a href="?mod=rankcl&page=4">4</a></li>
                    <li><a href="?mod=rankcl&page=5">5</a></li>
                    <!-- Next page link -->
                    <?
                        if ($page < 5) {
                    ?>
                    <li><a href="?mod=rankcl&page=<?=$b?>">Next »</a></li>
                    <?
                    }
                    ?>
                     
<?
}
?>
                    </ul>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php
    include('class_include/class_contenido_columna_three.php');
?> 