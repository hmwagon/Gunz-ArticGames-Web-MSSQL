<?php
	include('class_include/class_contenido_columna_one.php');


    //$reshopP = mssql_query("SELECT TOP 4 * FROM ItemPremium(nolock) ORDER BY Popular DESC");

    $count = 1;

   /* while($a = mssql_fetch_object($reshopP))
    {

        $ShopP[$count]['CSSID']        =   $a->CSSID;
	    $ShopP[$count]['Name']         =   $a->Name;
	    $ShopP[$count]['Level']        =   $a->Level;
	    $ShopP[$count]['Type']         =   GetTypeByID($a->Type);
	    $ShopP[$count]['Price']        =   $a->Price;
	    $ShopP[$count]['Sex']          =   GetSexByID($a->Sex);
	    $ShopP[$count]['ImageURL']     =   $a->ImageURL;

        $count++;
    }*/

?>	
<div class="mid">
	<!-- News Listing -->
    <div class="module">
    	<h3>Noticias y Anuncios<span class='rightx'><a href='' class='btn st2'>Ver anteriores</a></span></h3>
		<div class="content">
    		<ul class="newslisting">
			<?
             $res = mssql_query("SELECT TOP 8 * FROM IndexContent WHERE Type = '1' ORDER BY ICID DESC");
                while($n = mssql_fetch_assoc($res)){
                     ?>
        		<li>
	                <article style="height: 344px;" class="readmore-js-section readmore-js-expanded">
	                    <i class="ntype annc"><?=$n['NewType']?></i>
	                    <span><?=$n['Date']?></span>
	                    <a href="<?=$n['Link']?>" title="focus"><?=$n['Title']?></a>
	                    <p><br><?=$n['Text']?></p>
	                    <div class="articleoptions">
	                        <a href="<?=$n['Link']?>" class="btn st2">Leer Más</a>
	                    </div>
	                </article>
					<?}?>
        		</li>
            </ul>
		</div>
	</div>

	<div class="module">
    	<h3>Articulos Mas Comprados</h3>
    	<div class="content">
        	<ul class="itemlisting">
         	<?
         		
         		if ($ShopP[1] <> "") {	
         	?>
         		<li>
	                <span>
	                    <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$ShopP[1][ImageURL]?>" alt="">
	                    <p><strong><?=$ShopP[1][Price]?></strong> DC</p>
	                </span>
                    <p class="itemname"><?=$ShopP[1][Name]?></p>
                    <p>Tipo: <?=$ShopP[1][Type]?></p>
                    <p>Sexo: <?=$ShopP[1][Sex]?></p>
                    <p>Nivel: <?=$ShopP[1][Level]?></p>
                    <p class="buyoptions"><a href="?mod=infopremium&itemid=<?=$ShopP[1]['CSSID']?>&cat=<?=$ShopP[1]['Type']?>" class="btn st3">Información del Articulo</a></p>
                </li>
         	<?
         		}
         		if ($ShopP[2] <> "") {	
         	?>
         		<li>
	                <span>
	                    <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$ShopP[2][ImageURL]?>" alt="">
	                    <p><strong><?=$ShopP[2][Price]?></strong> DC</p>
	                </span>
                    <p class="itemname"><?=$ShopP[2][Name]?></p>
                    <p>Tipo: <?=$ShopP[2][Type]?></p>
                    <p>Sexo: <?=$ShopP[2][Sex]?></p>
                    <p>Nivel: <?=$ShopP[2][Level]?></p>
                    <p class="buyoptions"><a href="?mod=infopremium&itemid=<?=$ShopP[2]['CSSID']?>&cat=<?=$ShopP[2]['Type']?>" class="btn st3">Información del Articulo</a></p>
                </li>
         	<?
         		}
         		if ($ShopP[3] <> "") {	
         	?>
         		<li>
	                <span>
	                    <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$ShopP[3][ImageURL]?>" alt="">
	                    <p><strong><?=$ShopP[3][Price]?></strong> DC</p>
	                </span>
                    <p class="itemname"><?=$ShopP[3][Name]?></p>
                    <p>Tipo: <?=$ShopP[3][Type]?></p>
                    <p>Sexo: <?=$ShopP[3][Sex]?></p>
                    <p>Nivel: <?=$ShopP[3][Level]?></p>
                    <p class="buyoptions"><a href="?mod=infopremium&itemid=<?=$ShopP[3]['CSSID']?>&cat=<?=$ShopP[3]['Type']?>" class="btn st3">Información del Articulo</a></p>
                </li>
         	<?
         		}
         		if ($ShopP[4] <> "") {	
         	?>
         		<li>
	                <span>
	                    <img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$ShopP[4][ImageURL]?>" alt="">
	                    <p><strong><?=$ShopP[4][Price]?></strong> DC</p>
	                </span>
                    <p class="itemname"><?=$ShopP[4][Name]?></p>
                    <p>Tipo: <?=$ShopP[4][Type]?></p>
                    <p>Sexo: <?=$ShopP[4][Sex]?></p>
                    <p>Nivel: <?=$ShopP[4][Level]?></p>
                    <p class="buyoptions"><a href="?mod=infopremium&itemid=<?=$ShopP[4]['CSSID']?>&cat=<?=$ShopP[4]['Type']?>" class="btn st3">Información del Articulo</a></p>
                </li>
         	<?
         		}	
         	?>

            </ul>
    	</div>
	</div>

	<!-- Itemshop -->
	<div class="module">
		<h3>Imágenes <span class='rightx'><!--<a href='#'' class='btn st2'>Ver todas</a>--></span></h3>
		<div class="content">
			<ul class="screenshots">
            <?
               /* $indexphotos = mssql_query("SELECT TOP 10 * FROM Indexphotos WHERE Type = '1' ORDER BY IPID DESC");
                while($iphotos = mssql_fetch_assoc($indexphotos)){*/
            ?>
				
                <li><a href="<?=$iphotos['link']?>" rel="shadowbox[Featured Screenshots]" title="<?=$iphotos['Name']?>" target="_blank">
					<img class="zoom_thumb" src="<? print $URL_BASE;?>img/photos/<?=$iphotos['Photo']?>" width="50" height="50" alt=""></a><p><?=$iphotos['Name']?><br><?=$iphotos['Date']?></p></li>
            <?
                //}
            ?>
			</ul>
		</div>
	</div>
</div>
<?php
	include('class_include/class_contenido_columna_three.php');
?>	