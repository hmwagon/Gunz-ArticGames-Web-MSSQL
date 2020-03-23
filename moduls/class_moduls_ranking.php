	<!-- Ranking Shit -->
	<div class="module">
	    <h3>Ranking</h3>
	    <div class="content">
	        <!-- Begin Ranking 1 -->
	        <div class="module col3">
            	<h3>Clan Ranking <span class='rightx'><a href='?mod=rankcl&page=1' class='btn st2'>Ver Todos</a></span></h3>
        		<div class="content">
            		<table class="ranking">
                		<tbody>
		                    <tr>
		                        <th scope="col">RANK</th>
		                        <th scope="col">&nbsp;</th>
		                        <th scope="col">NOMBRE</th>
		                        <th scope="col">PUNTOS</th>
		                    </tr>
<?
			$res = mssql_query("SELECT TOP 5 * FROM Clan WHERE Name <> '' AND (DeleteFlag=0 OR DeleteFlag=NULL) ORDER BY Point DESC");			
			if(mssql_num_rows($res) == 0){ 
?>
No Data
<? 
						}else{
						
	$count = 1;
	while($clan = mssql_fetch_assoc($res)){

?>
							<tr>
		                        <td><span class="pos"><?=$count?></span></td>
		                        <td><img class="zoom_thumb" src="<? print $URL_BASE;?>emblem/<?=$clan['EmblemUrl'];?>"></td>
		                        <td><a href="?mod=infoclan&CLID=<?=$clan['CLID']?>"><?=$clan['Name']?></a></td>
		                        <td><?=$clan['Point']?></td>
		                    </tr>                 	
<?
$count++;
	}
}
?>
                        </tbody>
                    </table>
       			</div>
    		</div>
	        <!-- Begin Ranking 2 -->
	        <div class="module col3">
            	<h3>Individual Ranking <span class='rightx'><a href='?mod=rankindividual&page=1' class='btn st2'>Ver Todos</a></span></h3>
            	<div class="content">
                	<table class="ranking">
                    	<tbody>
	                    	<tr>
		                        <th scope="col">RANK</th>
		                        <th scope="col">&nbsp;</th>
		                        <th scope="col">NOMBRE</th>
		                        <th scope="col">LVL</th>
		                        <th scope="col">K/D</th>
	                    	</tr>
<?

$query = mssql_query("SELECT TOP 5 * FROM Account a, Character b WHERE b.AID=a.AID AND a.UGradeID !=253 AND a.UGradeID !=255 AND a.UGradeID !=254 AND a.UGradeID !=252 AND  (DeleteFlag=0 OR DeleteFlag=NULL) ORDER BY Level DESC, XP DESC, KillCount DESC, DeathCount ASC");


			if(mssql_num_rows($query) == 0){ 
?>
                           No Data
 <?
 					}else{

									$count = 1;
						while($query2 = mssql_fetch_assoc($query))
						{
 ?>
                    		<tr>
		                        <td><span class="pos"><?=$count?></span></td>
		                        <td></td>
		                        <td><a href="?mod=infochar&CID=<?=$query2->CID?>"><?=$query2['Name']?></a></td>
		                        <td><?=$query2['Level']?></td>
		                        <td><span style="color:#00FF00;"><?=$query2['KillCount']?></span>/<span style="color:#FF0000;"><?=$query2['DeathCount']?></span></td>
                    		</tr>
<?
 $count++;
}
}
?>
                        </tbody>
                    </table>
           		</div>
        	</div>
        	<!-- Begin Ranking 3-->
        	<div class="module col3">
            	<h3>Ranking PlayerTime</h3>
            	<div class="content">
                	<table class="ranking">
                    	<tbody>
	                    	<tr>
		                        <th scope="col">RANK</th>
		                        <th scope="col">&nbsp;</th>
		                        <th scope="col">NOMBRE</th>
		                        <th scope="col">LVL</th>
		                        <th scope="col">K</th>
	                    	</tr>
<?

$query = mssql_query("SELECT TOP 5 * FROM Account a, Character b WHERE b.AID = a.AID AND a.UGradeID !=253 AND a.UGradeID !=255 AND a.UGradeID !=254 AND a.UGradeID !=252 AND  (DeleteFlag=0 OR DeleteFlag=NULL) ORDER BY PlayTime DESC");

			if(mssql_num_rows($query) == 0){ 
?>
                            No Data
 <?
 					}else{
									$count = 1;
						while($query3 = mssql_fetch_assoc($query))
						{
 ?>
                    		<tr>
		                        <td><span class="pos"><?=$count?></span></td>
		                        <td>&nbsp;</td>
		                        <td><a href=""><?=$query3['Name']?></a></td>
		                        <td><?=$query3['Level']?></td>
		                        <td><span style="color:#00FF00;"><?=$query3['KillCount']?></span></td>
                    		</tr>
<?
 $count++;
}
}
?>
                        </tbody>
                    </table>
           		</div>
        	</div>
			
    	</div>
	</div> 