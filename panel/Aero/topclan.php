<?php
$query = mssql_query("SELECT * FROM Clan  WHERE (DeleteFlag != 1) Order by CLID Desc");
?>


		<article class="module width_full">
			<header><h3>TOP Clanes</h3></header>
			<div class="module_content">

			
<table class="tablesorter" cellspacing="0"> 

  <tr>
  
    <td width="18"><strong>Nº</strong></td>
    <td width="28"><strong>CLID</strong></td>
    <td width="57"><strong>Name</strong></td>
    <td width="68"><strong>Points</strong></td>
    <td width="61"><strong>MasterCID</strong></td>
    <td width="56"><strong>Wins</strong></td>
    <td width="64"><strong>Losser</strong></td>

</tr>
  <?
 for($i=0;$i < mssql_num_rows($query);)
{
$row = mssql_fetch_row($query);
$rank = $i+1;
  ?>
  <tr>
  
    <td><?php echo "$rank";?></td>
	<td><?php echo "$row[0]";?></td>
    <td><?php echo "$row[1]";?></td>
    <td><?php echo "$row[4]";?></td>
    <td><?php echo "$row[5]";?></td>
    <td><?php echo "$row[6]";?></td>
    <td><?php echo "$row[13]";?></td>


</tr>
  <?
  $i++;
  }   ?>
   
</table>
			
			
				<div class="clear"></div>
			</div>
		</article>
