		<article class="module width_full">
			<header><h3>Cuenta buscada</h3>
						<ul class="tabla">
<form action="index.php?do=buscarid" method="post" name="form1" class="x">
 <select onchange="this.form.submit()" name="type" >
    <option>UserID:</option>
	</select>
    <input name="busca" type="text" id="busca" placeholder="Nombre" required/>
 <input type="submit" name="Submit" value="Buscar Coins" />
</form>
</ul>
</header>
			<div class="module_content">
<?php
$busca="";
$busca=$_POST['busca'];
if($busca!== ""){
	$busqueda=mssql_query("SELECT * FROM Account WHERE UserID = '".$busca."'");{
		}
while($f = mssql_fetch_array($busqueda)){
	$user = $f['UserID'];
	$aid = $f['AID'];
	$ecoins = $f['EventCoins'];
	$coins = $f['Coins'];
	$name = $f['Name'];
	$RedColor = $f['RedColor'];
	$GreenColor = $f['GreenColor'];
	$BlueColor = $f['BlueColor'];

	?>
	

<table class="tablesorter" cellspacing="0"> 
  <tr>
    <td width="46">AID</td>
    <td width="111">UserID</td>
    <td width="115">Nombre</td>
    <td width="79">EventCoins</td>
    <td width="69">Coins</td>
	<td width="69">R</td>
	<td width="69">G</td>
	<td width="69">B</td>
  </tr>
  <tr>
    <td><? echo $aid; ?></td>
    <td><? echo $user; ?></td>
    <td><? echo $name; ?></td>
    <td><? echo $ecoins; ?></td>
    <td><? echo $coins; ?></td>
	<td><? echo $RedColor; ?></td>
	<td><? echo $GreenColor; ?></td>
	<td><? echo $BlueColor; ?></td>
  </tr>
</table>
<?
}
}
?>
				<div class="clear"></div>
			</div>
		</article>