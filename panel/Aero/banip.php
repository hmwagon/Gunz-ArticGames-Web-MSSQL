		<article class="module width_full">
			<form method="post" action="">
			<header><h3>Banear IP</h3></header>
				<div class="module_content">
						<fieldset>
							<label>IP</label>
							<input type="text" name="ip1" required maxlength="14" />
						</fieldset>
						<fieldset>
							<label>Razon:</label>
							<textarea name="razon" rows="12" required maxlength="14"></textarea>
						</fieldset>
						<input type="submit" name="enviar1" value="Bannear" />
<?
if(isset($_POST['enviar1']))
{
	$ip = $_POST['ip1'];
	$razon = $_POST['razon'];
	
	$insert = "INSERT INTO WebIpBan(ip,fecha,razon)";
	$insert.= "VALUES('".$ip."',GETDATE(),'".$razon."')";
	mssql_query($insert);
	
	
	$date = date("d-m-y - H:i:s");
    $logfile = fopen("logs/log.txt","a+");
    $logtext = "Tiempo: $date IPStaff: {$_SERVER['REMOTE_ADDR']} IPBanned: $ip Razon: $razon $log\r\n";
    fputs($logfile, $logtext);
	fclose($logfile);
	
	msgbox("La ip $id ha sido bannead.","index.php?do=banip");
	?>
	<br><br>
	<h1>Ip <font color="darkgreen"><?=$ip?></font> Baneada Satisfactoreamente.
	<?

}
?>		´
						<div class="clear"></div>
				</div>
			<footer>
				<div class="submit_link">
<select name="ip2">
			<?
			$select = "SELECT * FROM WebIpBan ORDER BY id DESC";
			$query = mssql_query($select);
			$rows = mssql_num_rows($query);
			if($rows>0)
			{
				while($row = mssql_fetch_array($query))
				{
					?>
					<option value="<?=$row['ip']?>"><?=$row['ip']?></option>
					<?
				}
			}else{
				?>
				<option value="">No Hay Ip Baneadas</option>
				<?
			}
			?>
</select>
					<input type="submit" name="enviar2" value="Desbanear IP" class="alt_btn">
				</div>
			</footer>
			<?
if(isset($_POST['enviar2']))
{
	$ip = $_POST['ip2'];
	if(empty($ip) || $ip == "")
	{
		?>
		<br><br><h1>No Hay Ip Baneadas <font color="darkred">Error.</font>
		<?
	}else{
	$delete = "DELETE FROM WebIpBan WHERE ip = '".$ip."'";
	mssql_query($delete);
	msgbox("La ip $id ha sido Desbannead.","index.php?do=banip");
	?>
	<br><br>
	<h1>IP <font color="darkgreen"><?=$ip?></font> Desbaneada Satisfactoriamente.
	<?
}
}
?>
							</form>
		</article>
