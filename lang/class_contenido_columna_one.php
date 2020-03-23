	<!-- Left side bar -->
    <div class="lsw">
    	<!-- Links -->
    	<a href="https://updates.aerogamez.com/Installer_AeroGamez_v11.exe" class="big-l"><?php print COLUMNA_1;?></a>
    	<?
    		$res = mssql_query("SELECT * FROM ServerStatus(nolock) WHERE Opened = 1");
    		$countplayers = 0;
    		
    		 while($a = mssql_fetch_assoc($res))
		    {
		       $countplayers = $countplayers + $a[CurrPlayer];

		    }
    	?>
		<div id="onlinenow"><?php print COLUMNA_2;?><strong><? print $countplayers; ?></strong> <?php print COLUMNA_3;?></div>
        <!-- Quick Links -->
        <ul class="quicklinks">
            <li><a href="#"><i class="dki star"></i><?php print COLUMNA_4;?></a></li>
            <li><a href="#"><i class="fa fa-line-chart"></i> Record En Linea: <?RecordOnline();?></a></li>
        </ul>
        <!-- Facebook Like Box -->
        <div class="module">
            <h3><?php print COLUMNA_5;?></h3>
            <div class="content">
            	<!--<iframe src="https://www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Farticgunz&amp;width=212&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" style="border:none; overflow:hidden; width:212px; height:258px;" allowtransparency="true" frameborder="0"></iframe>-->
            </div>
        </div>
        <!-- Recent Clan Wars -->
		<div class="module">
    		<h3><?php print COLUMNA_6;?></h3>
    		<div class="content">
        		<table class="recentcw">
            		<tbody>
	            		<tr>
			                <th scope="col"><?php print RANKING_3;?></th>
			                <th scope="col"><?php print RANKING_4;?></th>
			                <th scope="col"><?php print RANKING_3;?></th>
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
	               		 	<td><img class="zoom_thumb" src="emblem/noemblem.jpg"><a href="#">No Data</a></td>
	                        <td><span class="win">NULL</span>-<span class="lose">NULL</span></td>
	                       	<td><img class="zoom_thumb" src="emblem/noemblem.jpg"><a href="#">No Data</a></td>
	            		</tr>
<?
}while($row = mssql_fetch_object($select)){

?>
						<tr>
	               		 	<td><img class="zoom_thumb" src="emblem/<?=img_clan($row->WinnerCLID)?>"><a style="font-size:9px;" href="#"><?=$row->WinnerClanName?></a></td>
	                        <td><span class="win"><?=$row->RoundWins?></span>-<span class="lose"><?=$row->RoundLosses?></span></td>
	                       	<td><a style="font-size:9px;" href="#"><?=$row->LoserClanName?></a><img class="zoom_thumb" src="emblem/<?=img_clan($row->LoserCLID)?>"></td>
	            		</tr>

<?
}
?>
            		</tbody>
            	</table>
    		</div>
		</div>
		<!-- Quick Links -->
	    <ul class="quicklinks">
	        <li><a href="#"><i class="dki award"></i><?PHP print COLUMNA_7;?></a></li>
	        <li><a href="?mod=signature"><i class="dki stats"></i><?PHP print COLUMNA_8;?></a></li>
	    </ul>
	</div>