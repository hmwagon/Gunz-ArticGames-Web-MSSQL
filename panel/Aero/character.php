<?
    if( !ereg("index.php", $_SERVER['PHP_SELF']) )
    {
        header("Location: index.php");
        die();
    }

	$query = mssql_query("SELECT * FROM CHARACTER order by CID asc");

?>

		<article class="module width_full">
			<header><h3>Character List</h3></header>
			<div class="module_content">

			<table class="tablesorter" cellspacing="0"> 
  <tr>
    <td width="19"><strong>CID</strong></td>
     <td width="19"><strong>AID</strong></td>
    <td width="61"><strong>Name</strong></td>
    <td width="54"><strong>Level</strong></td>
    <td width="61"><strong>XP</strong></td>
	<td width="61"><strong>BP</strong></td>
	<td width="61"><strong>PlayTime</strong></td>
	<td width="61"><strong>KILL</strong></td>
	<td width="61"><strong>Death</strong></td>
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
    <td><?php echo "$row[2]";?></td>
    <td><?php echo "$row[3]";?></td>
    <td><?php echo "$row[8]";?></td>
	<td><?php echo "$row[9]";?></td>
	<td><?php echo "$row[30]";?></td>
	<td><?php echo "$row[32]";?></td>
	<td><?php echo "$row[33]";?></td>

</tr>
  <?
  $i++;
  }
   ?>
</table>
			
				<div class="clear"></div>
			</div>
		</article><!-- end of stats article -->