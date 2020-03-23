<?
    $reshopP = mssql_query("SELECT TOP 1 * FROM ItemDayShop(nolock) ORDER BY CSSID DESC");

    $count = 1;

    while($itemday = mssql_fetch_object($reshopP))
    {

        $DayItem[$count]['CSSID']        =   $itemday->CSSID;
	    $DayItem[$count]['Name']         =   $itemday->Name;
	    $DayItem[$count]['Level']        =   $itemday->Level;
	    $DayItem[$count]['Type']         =   GetTypeByID($itemday->Type);
	    $DayItem[$count]['Price']        =   $itemday->Price;
	    $DayItem[$count]['PriceOffer']   =   $itemday->PriceOffer;
	    $DayItem[$count]['Sex']          =   GetSexByID($itemday->Sex);
	    $DayItem[$count]['ImageURL']     =   $itemday->ImageURL;
	    $DayItem[$count]['TimeOffer']    =   $itemday->TimeOffer;
	    $DayItem[$count]['Opened']		 =   $itemday->Opened;	


        $count++;
    }
?>
	<!-- Start right side bar -->
	<div class="rsw">
				<?
         		
         		if ($DayItem[1]['Opened'] >= 1) {	
         		?>
	<!-- Item of the Day -->
		<div class="module">
            <h3>Articulo del Dia</h3>
            <div class="content">
            	<ul class="itemlisting">
     				<div class="ItemdelDay">
        	 			<p><span class="dayoff"><?=$DayItem[1][PriceOffer]?></span> Oferta Solo por <?=$DayItem[1][TimeOffer]?> Horas</p>
        	 			<div class="trianguitem"></div>
        	 		</div>
            	 	<li>
            	 		<span><img class="zoom_thumb" src="<?php print $URL_BASE ?>shop/<?=$DayItem[1][ImageURL]?>" alt="">
            	 			<p><strong><?=$DayItem[1][Price]?></strong> DC</p>
                		</span>
                		<p class="itemname"><?=$DayItem[1][Name]?></p>
                		<p>Tipo: <?=$DayItem[1][Type]?></p>
                		<p>Sexo: <?=$DayItem[1][Sex]?></p>
                		<p>Nivel: <?=$DayItem[1][Level]?></p>
            	 		<p class="buyoptions"><a href="?mod=infoitemday&itemid=<?=$DayItem[1]['CSSID']?>&cat=<?=$DayItem[1]['Type']?>" class="btn st3">Información del Articulo</a></p>
            	 	</li>
            	</ul>
            </div>
        </div>
        <?
	 		}
	 	?>
		<!-- Events -->
		<div class="currentevents">
	        <ul class="tabs eventslider">
	            <li><a class="active" href="#event1"></a></li>
	            <li><a href="#event2"></a></li>
	        </ul>
	        <ul class="tabs-content">
	            <li class="active" id="event1"><a href="http://gunz.aerogamez.com/index.php?mod=premium" class="marginfix"><img src="img/assets/events/thumbs/2.png" alt=""></a></li>
	            <li id="event2"><a href="http://gunz.aerogamez.com/index.php?mod=characters" class="marginfix"><img src="img/assets/events/thumbs/1.png" alt=""></a></li>
	        </ul>
	   	</div>
	    <!-- Quick Links -->
	    <ul class="quicklinks">
	        <li><a href="#"><i class="dki pencil"></i>Leer la FAQ</a></li>
	        <li><a href="#"><i class="dki person"></i>Ver Colaboradores Importantes</a></li>
	        <li><a href="#"><i class="dki comment"></i>Foros de la Comunidad</a></li>
	    </ul>
		<!-- Recent Threads -->
		<div class="module">
		    <h3>Nuevo Foro de Actividad</h3>
		    <div class="content">
		        <ul class="forumactivity">
		            <!--<li><a href="#">SS Bomb</a></li>
		            <li><a href="#">Sparta Clan</a></li>
		            <li><a href="#">Tournament date?</a></li>
		            <li><a href="#">Hello!</a></li>
		            <li><a href="#">Premium coins.</a></li>-->
		        </ul>
		    </div>
		</div>
	    <!-- Trailer-->
		<div class="trailerprev">
			<a href="http://www.youtube.com/v/9NfZct77wf0&amp;hl=en&amp;fs=1&amp;rel=0&amp;autoplay=1" rel="shadowbox;width=640;height=360" title="AeroGamez GunZ - Prom. Video Competition [720p] (WIN)"><img src="/img/assets/trailer.png"></a>	    </div>
		</div> 