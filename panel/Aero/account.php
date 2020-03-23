<?php

$query = mssql_query_logged("SELECT * FROM Account order by AID DESC");

?>

		<article class="module width_full">
			<header><h3>Lista de Cuentas</h3></header>
			<div class="module_content">
				
<table class="tablesorter" cellspacing="0"> 
  <tr>
    <td width="18"><strong>Nº</strong></td>
    <td width="28"><strong>AID</strong></td>
    <td width="57"><strong>UserID</strong></td>
    <td width="68"><strong>UGradeID</strong></td>
    <td width="61"><strong>Coins</strong></td>
    <td width="56"><strong>ECoins</strong></td>

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
    <td><?php echo "$row[2]";?></td>
    <td><?php echo "$row[31]";?></td>
    <td><?php echo "$row[32]";?></td>


</tr>
  <?
  $i++;
  }   ?>
   
</table>

				<div class="clear"></div>
			</div>
		</article>
		



