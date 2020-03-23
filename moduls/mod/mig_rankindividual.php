<?php
    ModulsTitle("AeroGamez Gunz - Individual Ranking");

    include('class_include/class_contenido_columna_one.php');

    ranking_individual_update();
?>  
<div class="mid">
    <div class="module">
        <div>
            <h3>Rankings</h3>
            <ul class="shopcats">
                <p>Elegir la categoría</p>
                <li class="active"><i class="dki person"></i>Individual</li>
                <a href="?mod=rankcl&page=1"><li><i class="dki world"></i>Clan</li></a>
                <a href="?mod=rankcw"><li><i class="dki star"></i>Guerra de Clan</li></a>
            </ul>
            <div>
            <div align="center">
                <form method="GET" name="indsearch" action="index.php">
                    <input type="hidden" name="mod" value="rankindividual" />
                    <input type="hidden" name="type" Value="1"/>
                    <input type="text" name="name" class="bxrankbuscar" placeholder="Buscar Usuario" required> <input name="submit" type="submit"  value="Buscar">
                </form>
            </div>
                <table class="ranking" align="center">
                    <tbody>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">&nbsp;</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">LVL</th>
                            <th scope="col">K / D(%)</th>
                        </tr>
<?php
if( isset($_GET['type']) && isset($_GET['name']) ) {

    $search = 1;
    $type = clean($_GET['type']);
    $name = clean($_GET['name']);

    if($type == 1)
    {
        $squery = "SELECT Name, CID, Level, XP, Ranking, KillCount, DeathCount FROM Character(nolock) WHERE Name = '$name'";

    }else{
        $search = 0;
    }
}else{
    $search = 0;
}


if($search == 0 ) {

    switch( clean($_GET['page']) ) {
        case "1":
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
    $res = mssql_query("SELECT TOP 20 * FROM Account a, Character b WHERE b.AID=a.AID AND a.UGradeID !=255|254|253|252 AND (DeleteFlag=0 OR DeleteFlag=NULL)  AND $ranks ORDER BY  Level Desc, XP Desc, Ranking DESC");


}else{
    $res = mssql_query($squery);
}

if(mssql_num_rows($res) <> 0) {
    while($char = mssql_fetch_object($res)) {
?>
                        <tr>
                            <td><span class="pos"><?=$char->Ranking?></span></td>
                            <td>&nbsp;</td>
                            <td><a href="?mod=infochar&CID=<?=$char->CID?>"><?=$char->Name?></a></td>
                            <td><?=$char->Level?></td>
                            <td><?=GetKDRatio($char->KillCount, $char->DeathCount)?></td>
                        </tr>
<?
    }

}else{
?>
No Data
<?
}
?>


                    </tbody>
                </table>
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
                    ?><li><a href="?mod=rankindividual&page=<?=$a?>">« Previous</a></li><?}?>
                    <!-- Numbered page links -->
                    <li><a href="?mod=rankindividual">1</a></li>
                    <li><a href="?mod=rankindividual&page=2">2</a></li>
                    <li><a href="?mod=rankindividual&page=3">3</a></li>
                    <li><a href="?mod=rankindividual&page=4">4</a></li>
                    <li><a href="?mod=rankindividual&page=5">5</a></li>
                    <!-- Next page link -->
                    <?
                        if ($page < 5) {
                    ?>
                    <li><a href="?mod=rankindividual&page=<?=$b?>">Next »</a></li>
                    <?
                    }
                    ?>
                     
<?
}
?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php
    include('class_include/class_contenido_columna_three.php');
?> 