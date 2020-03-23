<?
if(isset($_POST['submit'])){
    $eliminar = clean_sql($_POST['id']);
    mssql_query("DELETE FROM IndexContent WHERE ICID = '$eliminar'");
    msgbox("Noticia eliminada!","index.php?do=enews");
}else{
		  $qe = mssql_query("SELECT * From IndexContent");
		  if(mssql_num_rows($qe) == 0){
			  echo "No Hay Noticias para agregar ve AQUI-><a href='index.php?do=news'>Agregar Noticias</a>";
		
			  }else{
				  ?>
                 
		<article class="module width_full">
			<header><h3>ELIMINAR NOTICIAS</h3>
			<form method="POST" action="index.php?do=enews">
<ul class="tabla">
          <select name="id">
         <?
		  while($nt = mssql_fetch_object($qe)){
		    echo "<option value='$nt->ICID'>$nt->Title</option>";
		  }
		  
		  ?>
      
          </select>
		  <input type="submit" value="ELIMINAR NOTICIA!" name="submit" />
		  </ul>
	</header>
				<div class="module_content">			
<table class="tablesorter" cellspacing="0"> 
<?
$query = mssql_query("SELECT * FROM IndexContent order by ICID asc");
?>
	
	<tr>
    <td width="41">Nº</td>
    <td width="57">ICID</td>
    <td width="52">Tipo</td>
    <td width="264">Title</td>
    <td width="264">User</td>
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
</tr>
  <?
  $i++;
  }
   ?>
	</table>
	
<?
}}
?>
	<div class="clear"></div>
	</div>
</article>
