<?
ModulsTitle("AeroGamez Gunz - Articulos De Evento");

$sex = ($_GET[sex] == "") ? "2" : strtolower(clean($_GET[sex]));

$sex = ($sex < 0 || $sex > 2) ? "0" : $sex;

$sort = ($_GET[sort] == "") ? "0" : strtolower(clean($_GET[sort]));

$bodypart = ($_GET[bodypart] == "") ? "0" : strtolower(clean($_GET[bodypart]));
$bodypart = ($bodypart < 0 || $bodypart > 6) ? "0" : $bodypart;

if($sex == 2 && $bodypart == 0)
{
    $conditions = "";
}
elseif($sex == 2 && $bodypart != 0)
{
    $conditions = "WHERE BodyPart = $bodypart";
}
elseif($sex != 2 && $bodypart == 0)
{
    $conditions = "WHERE Sex = $sex";
}
elseif($sex != 2 && $bodypart != 0)
{
    $conditions = "WHERE Sex = $sex AND BodyPart = $bodypart";
}

switch ($sort)
{
    case 0:
    $sortq = "ORDER BY CSSID DESC";
    break;
    case 1:
    $sortq = "ORDER BY CSSID ASC";
    break;
    case 2:
    $sortq = "ORDER BY Level ASC";
    break;
    case 3:
    $sortq = "ORDER BY Level DESC";
    break;
    case 4:
    $sortq = "ORDER BY Price ASC";
    break;
    case 5:
    $sortq = "ORDER BY Price DESC";
    break;
    default:
    $sortq = "ORDER BY CSSID DESC";
    break;
}

$res = mssql_query("SELECT * FROM Itemevent(nolock) $conditions $sortq");


$count = 1;
$page = 1;
while( $a = mssql_fetch_object($res) ){

    $set[$count][$page]['CSSID']        =  $a->CSSID;
    $set[$count][$page]['Name']         =  $a->Name;
    $set[$count][$page]['Level']        =  $a->Level;
    $set[$count][$page]['Type']         = GetTypeByID($a->Slot);
    $set[$count][$page]['Price']        =  $a->Price;
    $set[$count][$page]['Sex']          = GetSexByID($a->Sex);
    $set[$count][$page]['ImageURL']     =  $a->ImageURL;

    if ( $count == 16 ){

        $count = 1;
        $page++;

    }else{
        $count++;
    }

}

$cpage = ($_GET[page] == "") ? 1 : $_GET[page];

if($cpage > $page)
{
    Messenger_Gunz("Error de la tienda, número de página incorrecto.","?mod=itemevent");
    die();

}elseif(!is_numeric($cpage)){

    Messenger_Gunz("Error de la tienda, número de página incorrecto.","?mod=itemevent");
    die();

}elseif($cpage < 1){

    Messenger_Gunz("No puede retroceder mas.","?mod=itemevent");
    die();
}



for ($i = 1; $i <= $page; $i++) {

    if($cpage == $i){

        $pageactiv = "class='active'";

    }else{
        $pageactiv = "class=''";
    }



    
    $pageactive.="<a $pageactiv href='?mod=itemevent&page=$i&sex=$sex&sort=$sort&bodypart=$bodypart'>$i</a>";
    

}


    $a = $cpage + 1;
    $b = $cpage - 1;

 if ($cpage >=2) {
     $previous.="<a href='?mod=itemevent&page=$b&sex=$sex&sort=$sort&bodypart=$bodypart'>".RANKING_13."</a>";
 }
if ($cpage < $page) {
    $next.="<a href='?mod=itemevent&page=$a&sex=$sex&sort=$sort&bodypart=$bodypart'>".RANKING_14."</a>";
}




?>
<div class="module">
    <div>
        <h3>Tiende De Eventos</h3>
        <div class="content">
            <ul class="shopcats">
                <p>Elegir la categoría</p>
                <a href="?mod=itemshop"><li>Tienda Inicial</li></a>
                <a href="?mod=itempremium"><li>Tienda Donator</li></a>
                <a><li class="active">Tienda De Eventos</li></a>
            </ul>
        </div>
        <center><div align="center" class="imgshop"></div></center>
        <form method="GET" name="setlist" action="index.php?mod=itemevent">
            <p align="center">
                <select name="bodypart" onChange="document.location = 'index.php?mod=itemevent&sex=' + document.setlist.sex.value + '&sort=' + document.setlist.sort.value + '&bodypart=' + document.setlist.bodypart.value;">
                <option value="0" <?=($_GET[bodypart] == "0") ? "selected" : ""?>>Todos</option>
                <option value="6" <?=($_GET[bodypart] == "6") ? "selected" : ""?>>No Armaduras</option>
                <option value="1" <?=($_GET[bodypart] == "1") ? "selected" : ""?>>Armadura: Cabeza</option>
                <option value="2" <?=($_GET[bodypart] == "2") ? "selected" : ""?>>Armadura: Cuerpo</option>
                <option value="3" <?=($_GET[bodypart] == "3") ? "selected" : ""?>>Armadura: Manos</option>
                <option value="4" <?=($_GET[bodypart] == "4") ? "selected" : ""?>>Armadura: Piernas</option>
                <option value="5" <?=($_GET[bodypart] == "5") ? "selected" : ""?>>Armadura: Pies</option>
                </select>

                <select <?=($_GET[bodypart] == 0 || $_GET[bodypart] == 6) ? "disabled " : ""?>size="1" name="sex" onChange="document.location = 'index.php?mod=itemevent&sex=' + document.setlist.sex.value + '&sort=' + document.setlist.sort.value + '&bodypart=' + document.setlist.bodypart.value;">
                <?
                if($_GET[bodypart] == 0 || $_GET[bodypart] == 6)
                {
                ?>
                <option value="2" <?=($_GET[sex] == "2") ? "selected" : ""?>>Ningún archivo disponible</option> <? } ?>
                <option value="2" <?=($_GET[sex] == "2") ? "selected" : ""?>>Hombre y Mujer</option>
                <option value="0" <?=($_GET[sex] == "0") ? "selected" : ""?>>Hombre</option>
                <option value="1" <?=($_GET[sex] == "1") ? "selected" : ""?>>Mujer</option>
                </select>

                <select name="sort" onChange="document.location = 'index.php?mod=itemevent&sex=' + document.setlist.sex.value + '&sort=' + document.setlist.sort.value + '&bodypart=' + document.setlist.bodypart.value;">
                <option value="0" <?=($_GET[sort] == "0") ? "selected" : ""?>>Nuevos Primero</option>
                <option value="1" <?=($_GET[sort] == "1") ? "selected" : ""?>>Viejos Primero</option>
                <option value="2" <?=($_GET[sort] == "2") ? "selected" : ""?>>Nivel: Bajo Primero</option>
                <option value="3" <?=($_GET[sort] == "3") ? "selected" : ""?>>Nivel: Alto Primero</option>
                <option value="4" <?=($_GET[sort] == "4") ? "selected" : ""?>>Precio: Bajo Primero</option>
                <option value="5" <?=($_GET[sort] == "5") ? "selected" : ""?>>Precio: Alto Primero</option>
                </select>
            </p>
        </form>
        <div>
            <h3>Últimos Articulos De Evento</h3>
            <div class="content">
                <ul class="itemlisting">
                    <?
                        if($set[1][$cpage]['Name'] <> ""){
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$set[1][$cpage]['ImageURL']?>" alt="">
                            <p><strong><?=$set[1][$cpage]['Price']?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$set[1][$cpage]['Name']?></p>
                        <p>Tipo: <?=$set[1][$cpage]['Type']?></p>
                        <p>Sexo: <?=$set[1][$cpage]['Sex']?></p>
                        <p>Nivel: <?=$set[1][$cpage]['Level']?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$set[1][$cpage]['CSSID']?>&cat=<?=$set[1][$cpage]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                        if($set[2][$cpage]['Name'] <> ""){
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$set[2][$cpage]['ImageURL']?>" alt="">
                            <p><strong><?=$set[2][$cpage]['Price']?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$set[2][$cpage]['Name']?></p>
                        <p>Tipo: <?=$set[2][$cpage]['Type']?></p>
                        <p>Sexo: <?=$set[2][$cpage]['Sex']?></p>
                        <p>Nivel: <?=$set[2][$cpage]['Level']?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$set[2][$cpage]['CSSID']?>&cat=<?=$set[2][$cpage]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                        if($set[3][$cpage]['Name'] <> ""){
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$set[3][$cpage]['ImageURL']?>" alt="">
                            <p><strong><?=$set[3][$cpage]['Price']?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$set[3][$cpage]['Name']?></p>
                        <p>Tipo: <?=$set[3][$cpage]['Type']?></p>
                        <p>Sexo: <?=$set[3][$cpage]['Sex']?></p>
                        <p>Nivel: <?=$set[3][$cpage]['Level']?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$set[3][$cpage]['CSSID']?>&cat=<?=$set[3][$cpage]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                        if($set[4][$cpage]['Name'] <> ""){
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$set[4][$cpage]['ImageURL']?>" alt="">
                            <p><strong><?=$set[4][$cpage]['Price']?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$set[4][$cpage]['Name']?></p>
                        <p>Tipo: <?=$set[4][$cpage]['Type']?></p>
                        <p>Sexo: <?=$set[4][$cpage]['Sex']?></p>
                        <p>Nivel: <?=$set[4][$cpage]['Level']?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$set[4][$cpage]['CSSID']?>&cat=<?=$set[4][$cpage]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                        if($set[5][$cpage]['Name'] <> ""){
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$set[5][$cpage]['ImageURL']?>" alt="">
                            <p><strong><?=$set[5][$cpage]['Price']?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$set[5][$cpage]['Name']?></p>
                        <p>Tipo: <?=$set[5][$cpage]['Type']?></p>
                        <p>Sexo: <?=$set[5][$cpage]['Sex']?></p>
                        <p>Nivel: <?=$set[5][$cpage]['Level']?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$set[5][$cpage]['CSSID']?>&cat=<?=$set[5][$cpage]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                        if($set[6][$cpage]['Name'] <> ""){
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$set[6][$cpage]['ImageURL']?>" alt="">
                            <p><strong><?=$set[6][$cpage]['Price']?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$set[6][$cpage]['Name']?></p>
                        <p>Tipo: <?=$set[6][$cpage]['Type']?></p>
                        <p>Sexo: <?=$set[6][$cpage]['Sex']?></p>
                        <p>Nivel: <?=$set[6][$cpage]['Level']?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$set[6][$cpage]['CSSID']?>&cat=<?=$set[6][$cpage]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                        if($set[7][$cpage]['Name'] <> ""){
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$set[7][$cpage]['ImageURL']?>" alt="">
                            <p><strong><?=$set[7][$cpage]['Price']?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$set[7][$cpage]['Name']?></p>
                        <p>Tipo: <?=$set[7][$cpage]['Type']?></p>
                        <p>Sexo: <?=$set[7][$cpage]['Sex']?></p>
                        <p>Nivel: <?=$set[7][$cpage]['Level']?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$set[7][$cpage]['CSSID']?>&cat=<?=$set[7][$cpage]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                        if($set[8][$cpage]['Name'] <> ""){
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$set[8][$cpage]['ImageURL']?>" alt="">
                            <p><strong><?=$set[8][$cpage]['Price']?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$set[8][$cpage]['Name']?></p>
                        <p>Tipo: <?=$set[8][$cpage]['Type']?></p>
                        <p>Sexo: <?=$set[8][$cpage]['Sex']?></p>
                        <p>Nivel: <?=$set[8][$cpage]['Level']?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$set[8][$cpage]['CSSID']?>&cat=<?=$set[8][$cpage]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                        if($set[9][$cpage]['Name'] <> ""){
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$set[9][$cpage]['ImageURL']?>" alt="">
                            <p><strong><?=$set[9][$cpage]['Price']?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$set[9][$cpage]['Name']?></p>
                        <p>Tipo: <?=$set[9][$cpage]['Type']?></p>
                        <p>Sexo: <?=$set[9][$cpage]['Sex']?></p>
                        <p>Nivel: <?=$set[9][$cpage]['Level']?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$set[9][$cpage]['CSSID']?>&cat=<?=$set[9][$cpage]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                        if($set[10][$cpage]['Name'] <> ""){
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$set[10][$cpage]['ImageURL']?>" alt="">
                            <p><strong><?=$set[10][$cpage]['Price']?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$set[10][$cpage]['Name']?></p>
                        <p>Tipo: <?=$set[10][$cpage]['Type']?></p>
                        <p>Sexo: <?=$set[10][$cpage]['Sex']?></p>
                        <p>Nivel: <?=$set[10][$cpage]['Level']?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$set[10][$cpage]['CSSID']?>&cat=<?=$set[10][$cpage]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                        if($set[11][$cpage]['Name'] <> ""){
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$set[11][$cpage]['ImageURL']?>" alt="">
                            <p><strong><?=$set[11][$cpage]['Price']?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$set[11][$cpage]['Name']?></p>
                        <p>Tipo: <?=$set[11][$cpage]['Type']?></p>
                        <p>Sexo: <?=$set[11][$cpage]['Sex']?></p>
                        <p>Nivel: <?=$set[11][$cpage]['Level']?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$set[11][$cpage]['CSSID']?>&cat=<?=$set[11][$cpage]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                        if($set[12][$cpage]['Name'] <> ""){
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$set[12][$cpage]['ImageURL']?>" alt="">
                            <p><strong><?=$set[12][$cpage]['Price']?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$set[12][$cpage]['Name']?></p>
                        <p>Tipo: <?=$set[12][$cpage]['Type']?></p>
                        <p>Sexo: <?=$set[12][$cpage]['Sex']?></p>
                        <p>Nivel: <?=$set[12][$cpage]['Level']?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$set[12][$cpage]['CSSID']?>&cat=<?=$set[12][$cpage]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                        if($set[13][$cpage]['Name'] <> ""){
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$set[13][$cpage]['ImageURL']?>" alt="">
                            <p><strong><?=$set[13][$cpage]['Price']?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$set[13][$cpage]['Name']?></p>
                        <p>Tipo: <?=$set[13][$cpage]['Type']?></p>
                        <p>Sexo: <?=$set[13][$cpage]['Sex']?></p>
                        <p>Nivel: <?=$set[13][$cpage]['Level']?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$set[13][$cpage]['CSSID']?>&cat=<?=$set[13][$cpage]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                        if($set[14][$cpage]['Name'] <> ""){
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$set[14][$cpage]['ImageURL']?>" alt="">
                            <p><strong><?=$set[14][$cpage]['Price']?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$set[14][$cpage]['Name']?></p>
                        <p>Tipo: <?=$set[14][$cpage]['Type']?></p>
                        <p>Sexo: <?=$set[14][$cpage]['Sex']?></p>
                        <p>Nivel: <?=$set[14][$cpage]['Level']?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$set[14][$cpage]['CSSID']?>&cat=<?=$set[14][$cpage]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                        if($set[15][$cpage]['Name'] <> ""){
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$set[15][$cpage]['ImageURL']?>" alt="">
                            <p><strong><?=$set[15][$cpage]['Price']?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$set[15][$cpage]['Name']?></p>
                        <p>Tipo: <?=$set[15][$cpage]['Type']?></p>
                        <p>Sexo: <?=$set[15][$cpage]['Sex']?></p>
                        <p>Nivel: <?=$set[15][$cpage]['Level']?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$set[15][$cpage]['CSSID']?>&cat=<?=$set[15][$cpage]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                        if($set[16][$cpage]['Name'] <> ""){
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$set[16][$cpage]['ImageURL']?>" alt="">
                            <p><strong><?=$set[16][$cpage]['Price']?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$set[16][$cpage]['Name']?></p>
                        <p>Tipo: <?=$set[16][$cpage]['Type']?></p>
                        <p>Sexo: <?=$set[16][$cpage]['Sex']?></p>
                        <p>Nivel: <?=$set[16][$cpage]['Level']?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$set[16][$cpage]['CSSID']?>&cat=<?=$set[16][$cpage]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                    ?>
                </ul>
                <ul class="pagination">
                    <li><?=$previous?></li>
                    <li><?=$pageactive?></li>
                    <li><?=$next?></li>
                </ul>
            </div>
        </div>
    </div>
</div>