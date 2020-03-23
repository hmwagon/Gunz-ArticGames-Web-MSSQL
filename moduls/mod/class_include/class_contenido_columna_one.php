	<!-- Left side bar -->
    <div class="lsw">
    	<!-- Links -->
    	<a href="http://updates.aerogamez.com/Installer_AeroGamez_v12.exe" class="big-l" download>Descarga Directa</a>
    	<?
    		$res = mssql_query("SELECT * FROM ServerStatus(nolock) WHERE Opened = 1");
    		$countplayers = 0;
    		
    		 while($a = mssql_fetch_assoc($res))
		    {
		       $countplayers = $countplayers + $a[CurrPlayer];

		    }
    	?>
		<div id="onlinenow">Únete, <strong><? print $countplayers; ?></strong> Jugadores están jugando ahora!</div>
        <!-- Quick Links -->
        <ul class="quicklinks">
            <li><a href="#"><i class="dki star"></i>Guía de Inicio</a></li>
            <li><a href="#"><i class="fa fa-line-chart"></i> Record En Linea: <?RecordOnline();?></a></li>
			<li><a href="#"><i class="dki award"></i>Ver el Salón de la Fama</a></li>
	        <li><a href="?mod=signature"><i class="dki stats"></i>Consigue tu firma de GunZ</a></li>
        </ul>
        <!-- Facebook Like Box -->
        <div class="module">
            <h3>Facebook</h3>
            <div class="content">
	            <center>
					<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FAeroGamers.Com.Gunz%2F&tabs=timeline&width=200&height=300&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=929479263855563" width="200" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
				</center>
            </div>
        </div>
        <!-- Recent Clan Wars -->
		<div class="module">
    		<h3>Recientes Guerras de clanes <span class='rightx'><a href='?mod=rankcw&page=1' class='btn st2'>Ver pasado</a></span></h3>
    		<div class="content">
        		<table class="recentcw">
            		<tbody>
	            		<tr>
			                <th scope="col">NOMBRE</th>
			                <th scope="col">PUNTOS</th>
			                <th scope="col">NOMBRE</th>
			            </tr>
<?
      	function img_clan($clid)
		{
		  $clan = mssql_fetch_array(mssql_query("SELECT EmblemUrl From Clan WHERE CLID='".$clid."' "));
		  return ($clan[0] == "") ? "noemblem.jpg" : $clan[0];
		}
		$select = mssql_query("SELECT TOP 10 * FROM ClanGameLog ORDER BY ID DESC");

		if(mssql_num_rows($select) == 0){
?>
	                    <tr>
	               		 	<td><img class="zoom_thumb" src="<? print $URL_BASE;?>emblem/noemblem.jpg"><a href="#">No Data</a></td>
	                        <td><span class="win">NULL</span>-<span class="lose">NULL</span></td>
	                       	<td><img class="zoom_thumb" src="<? print $URL_BASE;?>emblem/noemblem.jpg"><a href="#">No Data</a></td>
	            		</tr>
<?
}while($row = mssql_fetch_object($select)){

?>
						<tr>
	               		 	<td><img class="zoom_thumb" src="<? print $URL_BASE;?>emblem/<?=img_clan($row->WinnerCLID)?>"><a style="font-size:9px;" href="#"><?=$row->WinnerClanName?></a></td>
	                        <td><span class="win"><?=$row->RoundWins?></span>-<span class="lose"><?=$row->RoundLosses?></span></td>
	                       	<td><a style="font-size:9px;" href="#"><?=$row->LoserClanName?></a><img class="zoom_thumb" src="<? print $URL_BASE;?>emblem/<?=img_clan($row->LoserCLID)?>"></td>
	            		</tr>

<?
}
?>
            		</tbody>
            	</table>
    		</div>
		</div>
	</div>