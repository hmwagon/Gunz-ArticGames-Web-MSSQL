<?

ModulsTitle("AeroGamez Gunz - Tienda");

$resshopP = mssql_query("SELECT TOP 8 * FROM ItemPremium(nolock) ORDER BY Selled DESC");

$count = 1;
                                                                                                                           
while($a = mssql_fetch_object($resshopP))
{

    $itemsP[$count]['CSSID']        =   $a->CSSID;
    $itemsP[$count]['Name']         =   $a->Name;
    $itemsP[$count]['Level']        =   $a->Level;
    $itemsP[$count]['Type']         =   GetTypeByID($a->Type);
    $itemsP[$count]['Price']        =   $a->Price;
    $itemsP[$count]['Sex']          =   GetSexByID($a->Sex);
    $itemsP[$count]['ImageURL']     =   $a->ImageURL;

    $count++;
}

$count = 1;
$resshopE = mssql_query("SELECT TOP 8 * FROM ItemEvent(nolock) ORDER BY Selled DESC");

while($a = mssql_fetch_object($resshopE))
{

    $itemsE[$count]['CSSID']        =   $a->CSSID;
    $itemsE[$count]['Name']         =   $a->Name;
    $itemsE[$count]['Level']        =   $a->Level;
    $itemsE[$count]['Type']         =   GetTypeByID($a->Type);
    $itemsE[$count]['Price']        =   $a->Price;
    $itemsE[$count]['Sex']          =   GetSexByID($a->Sex);
    $itemsE[$count]['ImageURL']     =   $a->ImageURL;

    $count++;
}


?>
<div class="module">
    <div>
        <div class="content">
            <h3>Tienda</h3>
            <ul class="shopcats">
                <p>Elegir la categoría</p>
                <a ><li class="active">Tienda Inicial</li></a>
                <a href="?mod=itempremium"><li>Tienda Donator</li></a>
                <a href="?mod=itemevent"><li>Tienda De Eventos</li></a>
            </ul>
        </div>
        <div>
            <h3>Últimos Articulos Donator</h3>
            <div class="content">
                <ul class="itemlisting">
                    <?
                        if ($itemsP[1]['Name'] <> "") {
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?=$URL_BASE?>shop/<?=$itemsP[1][ImageURL]?>" alt="">
                            <p><strong><?=$itemsP[1][Price]?></strong> DC</p>
                        </span>
                        <p class="itemname"><?=$itemsP[1][Name]?></p>
                        <p>Tipo: <?=$itemsP[1][Type]?></p>
                        <p>Sexo: <?=$itemsP[1][Sex]?></p>
                        <p>Nivel: <?=$itemsP[1][Level]?></p>
                        <p class="buyoptions"><a href="?mod=infopremium&itemid=<?=$itemsP[1]['CSSID']?>&cat=<?=$itemsP[1]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                       if ($itemsP[2]['Name'] <> "") {
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?=$URL_BASE?>shop/<?=$itemsP[2][ImageURL]?>" alt="">
                            <p><strong><?=$itemsP[2][Price]?></strong> DC</p>
                        </span>
                        <p class="itemname"><?=$itemsP[2][Name]?></p>
                        <p>Tipo: <?=$itemsP[2][Type]?></p>
                        <p>Sexo: <?=$itemsP[2][Sex]?></p>
                        <p>Nivel: <?=$itemsP[2][Level]?></p>
                        <p class="buyoptions"><a href="?mod=infopremium&itemid=<?=$itemsP[2]['CSSID']?>&cat=<?=$itemsP[2]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                       if ($itemsP[3]['Name'] <> "") {
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$itemsP[3][ImageURL]?>" alt="">
                            <p><strong><?=$itemsP[3][Price]?></strong> DC</p>
                        </span>
                        <p class="itemname"><?=$itemsP[3][Name]?></p>
                        <p>Tipo: <?=$itemsP[3][Type]?></p>
                        <p>Sexo: <?=$itemsP[3][Sex]?></p>
                        <p>Nivel: <?=$itemsP[3][Level]?></p>
                        <p class="buyoptions"><a href="?mod=infopremium&itemid=<?=$itemsP[3]['CSSID']?>&cat=<?=$itemsP[3]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                       if ($itemsP[4]['Name'] <> "") {
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$itemsP[4][ImageURL]?>" alt="">
                            <p><strong><?=$itemsP[4][Price]?></strong> DC</p>
                        </span>
                        <p class="itemname"><?=$itemsP[4][Name]?></p>
                        <p>Tipo: <?=$itemsP[4][Type]?></p>
                        <p>Sexo: <?=$itemsP[4][Sex]?></p>
                        <p>Nivel: <?=$itemsP[4][Level]?></p>
                        <p class="buyoptions"><a href="?mod=infopremium&itemid=<?=$itemsP[4]['CSSID']?>&cat=<?=$itemsP[4]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                       if ($itemsP[5]['Name'] <> "") {
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$itemsP[5][ImageURL]?>" alt="">
                            <p><strong><?=$itemsP[5][Price]?></strong> DC</p>
                        </span>
                        <p class="itemname"><?=$itemsP[5][Name]?></p>
                        <p>Tipo: <?=$itemsP[5][Type]?></p>
                        <p>Sexo: <?=$itemsP[5][Sex]?></p>
                        <p>Nivel: <?=$itemsP[5][Level]?></p>
                        <p class="buyoptions"><a href="?mod=infopremium&itemid=<?=$itemsP[5]['CSSID']?>&cat=<?=$itemsP[5]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                       if ($itemsP[6]['Name'] <> "") {
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$itemsP[6][ImageURL]?>" alt="">
                            <p><strong><?=$itemsP[6][Price]?></strong> DC</p>
                        </span>
                        <p class="itemname"><?=$itemsP[6][Name]?></p>
                        <p>Tipo: <?=$itemsP[6][Type]?></p>
                        <p>Sexo: <?=$itemsP[6][Sex]?></p>
                        <p>Nivel: <?=$itemsP[6][Level]?></p>
                        <p class="buyoptions"><a href="?mod=infopremium&itemid=<?=$itemsP[6]['CSSID']?>&cat=<?=$itemsP[6]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                     <?
                        }
                       if ($itemsP[7]['Name'] <> "") {
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$itemsP[7][ImageURL]?>" alt="">
                            <p><strong><?=$itemsP[7][Price]?></strong> DC</p>
                        </span>
                        <p class="itemname"><?=$itemsP[7][Name]?></p>
                        <p>Tipo: <?=$itemsP[7][Type]?></p>
                        <p>Sexo: <?=$itemsP[7][Sex]?></p>
                        <p>Nivel: <?=$itemsP[7][Level]?></p>
                        <p class="buyoptions"><a href="?mod=infopremium&itemid=<?=$itemsP[7]['CSSID']?>&cat=<?=$itemsP[7]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                       if ($itemsP[8]['Name'] <> "") {
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$itemsP[8][ImageURL]?>" alt="">
                            <p><strong><?=$itemsP[8][Price]?></strong> DC</p>
                        </span>
                        <p class="itemname"><?=$itemsP[8][Name]?></p>
                        <p>Tipo: <?=$itemsP[8][Type]?></p>
                        <p>Sexo: <?=$itemsP[8][Sex]?></p>
                        <p>Nivel: <?=$itemsP[8][Level]?></p>
                        <p class="buyoptions"><a href="?mod=infopremium&itemid=<?=$itemsP[8]['CSSID']?>&cat=<?=$itemsP[8]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                    ?>
                </ul>
            </div>
            <h3><?php print SHOP_12;?></h3>
            <div class="content">
                <ul class="itemlisting">
                    <?
                        if ($itemsE[1]['Name'] <> "") {
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$itemsE[1][ImageURL]?>" alt="">
                            <p><strong><?=$itemsE[1][Price]?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$itemsE[1][Name]?></p>
                        <p>Tipo: <?=$itemsE[1][Type]?></p>
                        <p>Sexo: <?=$itemsE[1][Sex]?></p>
                        <p>Nivel: <?=$itemsE[1][Level]?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$itemsE[1]['CSSID']?>&cat=<?=$itemsE[1]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                        if ($itemsE[2]['Name'] <> "") {
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$itemsE[2][ImageURL]?>" alt="">
                            <p><strong><?=$itemsE[2][Price]?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$itemsE[2][Name]?></p>
                        <p>Tipo: <?=$itemsE[2][Type]?></p>
                        <p>Sexo: <?=$itemsE[2][Sex]?></p>
                        <p>Nivel: <?=$itemsE[2][Level]?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$itemsE[2]['CSSID']?>&cat=<?=$itemsE[2]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                        if ($itemsE[3]['Name'] <> "") {
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$itemsE[3][ImageURL]?>" alt="">
                            <p><strong><?=$itemsE[3][Price]?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$itemsE[3][Name]?></p>
                        <p>Tipo: <?=$itemsE[3][Type]?></p>
                        <p>Sexo: <?=$itemsE[3][Sex]?></p>
                        <p>Nivel: <?=$itemsE[3][Level]?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$itemsE[3]['CSSID']?>&cat=<?=$itemsE[3]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                        if ($itemsE[4]['Name'] <> "") {
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$itemsE[4][ImageURL]?>" alt="">
                            <p><strong><?=$itemsE[4][Price]?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$itemsE[4][Name]?></p>
                        <p>Tipo: <?=$itemsE[4][Type]?></p>
                        <p>Sexo: <?=$itemsE[4][Sex]?></p>
                        <p>Nivel: <?=$itemsE[4][Level]?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$itemsE[4]['CSSID']?>&cat=<?=$itemsE[4]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                        if ($itemsE[5]['Name'] <> "") {
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$itemsE[5][ImageURL]?>" alt="">
                            <p><strong><?=$itemsE[5][Price]?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$itemsE[5][Name]?></p>
                        <p>Tipo: <?=$itemsE[5][Type]?></p>
                        <p>Sexo: <?=$itemsE[5][Sex]?></p>
                        <p>Nivel: <?=$itemsE[5][Level]?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$itemsE[5]['CSSID']?>&cat=<?=$itemsE[5]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                        if ($itemsE[6]['Name'] <> "") {
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$itemsE[6][ImageURL]?>" alt="">
                            <p><strong><?=$itemsE[6][Price]?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$itemsE[6][Name]?></p>
                        <p>Tipo: <?=$itemsE[6][Type]?></p>
                        <p>Sexo: <?=$itemsE[6][Sex]?></p>
                        <p>Nivel: <?=$itemsE[6][Level]?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$itemsE[6]['CSSID']?>&cat=<?=$itemsE[6]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                        if ($itemsE[7]['Name'] <> "") {
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$itemsE[7][ImageURL]?>" alt="">
                            <p><strong><?=$itemsE[7][Price]?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$itemsE[7][Name]?></p>
                        <p>Tipo: <?=$itemsE[7][Type]?></p>
                        <p>Sexo: <?=$itemsE[7][Sex]?></p>
                        <p>Nivel: <?=$itemsE[7][Level]?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$itemsE[7]['CSSID']?>&cat=<?=$itemsE[7]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                        if ($itemsE[8]['Name'] <> "") {
                    ?>
                    <li>
                        <span>
                            <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$itemsE[8][ImageURL]?>" alt="">
                            <p><strong><?=$itemsE[8][Price]?></strong> EC</p>
                        </span>
                        <p class="itemname"><?=$itemsE[8][Name]?></p>
                        <p>Tipo: <?=$itemsE[8][Type]?></p>
                        <p>Sexo: <?=$itemsE[8][Sex]?></p>
                        <p>Nivel: <?=$itemsE[8][Level]?></p>
                        <p class="buyoptions"><a href="?mod=infoevent&itemid=<?=$itemsE[8]['CSSID']?>&cat=<?=$itemsE[8]['Type']?>" class="btn st3">Información del Articulo</a></p>
                    </li>
                    <?
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
