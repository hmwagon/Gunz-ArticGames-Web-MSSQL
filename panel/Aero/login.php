<?

$query = mssql_query("SELECT * FROM Login order by AID asc");
?>
		<article class="module width_full">
			<header><h3>Cuentas Login</h3></header>
			<div class="module_content">

			<table class="tablesorter" cellspacing="0"> 

  <tr>
    <td width="51">Nº</td>
    <td width="52"><span class="style28"><strong>AID</strong></span></td>
    <td width="154">UserID</td>
	<td width="154">Password</td>
    <td width="219">Last Conection</td>
    <td width="198">Last IP </td>
  </tr>
  
  <?
 for($i=0;$i < mssql_num_rows($query);)
{
$row = mssql_fetch_row($query);
$rank = $i+1;
  ?>
  <tr>
    <td><?php echo "$rank";?></td>
	<td><?php echo "$row[1]";?></td>
    <td><?php echo "$row[0]";?></td>
	<td><?php echo "$row[2]";?></td>
    <td><?php echo "$row[3]";?></td>
    <td><?php echo "$row[4]";?></td>
  </tr>
  
  <?
  $i++;
  }
   ?>
</table>
			
				<div class="clear"></div>
			</div>
		</article><!-- end of stats article -->