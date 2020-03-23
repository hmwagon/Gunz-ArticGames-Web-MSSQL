<?
    if( !ereg("index.php", $_SERVER['PHP_SELF']) )
    {
        header("Location: index.php");
        die();
    }
?>


		<article class="module width_full">
			<header><h3>Buscar Rangos</h3>
			<ul class="tabla">
<form method="post" name="from">
    <select onchange="this.form.submit()" name="type" >
    <option value="255">Administradores</option>
    <option value="254">Moderadores</option>
	 <option value="252">GamersMaster</option>
    <option value="253">User Banned</option>
    <!--<option value="2">User Con jjang</option>-->
    </select>
    <input type="submit" name="submit" value="Buscar" />
    
</form>
</ul>
			</header>
			<div class="module_content">

			
<table class="tablesorter" cellspacing="0"> 
  <tr>
    <th width="45" scope="col">AID</th>
    <th width="134" scope="col">UserID</th>
    <th width="71" scope="col">UGradeID</th>
    <th width="95" scope="col">Nombre</th>
	<th width="95" scope="col">Email</th>
    <th width="161" scope="col">Pregunta </th>
    <th width="193" scope="col">Respuesta</th>
  </tr>
<tr>

<?
{
	
$q = $_POST['type'];
if($q <= 0){
	die();
	}else{
$tp = mssql_query("SELECT * From Account WHERE UGradeID = '".$q."'");
while($acc = mssql_fetch_object($tp)){
	
	
?>
  
    <th class="xd" scope="col"><?=$acc->AID;?></th>
    <th class="xd" scope="col"><?=$acc->UserID?></th>
    <th class="xd" scope="col"><?=$acc->UGradeID?></th>
    <th class="xd" scope="col"><?=$acc->Name?></th>
	<th class="xd" scope="col"><?=$acc->Email?></th>
    <th class="xd" scope="col"><?=$acc->Question?></th>
    <th class="xd" scope="col"><?=$acc->Answer?></th>
 

 </tr>
 <? }}}?>
</table>
	<div class="clear"></div>
			</div>
</article>