<?
    if( !ereg("index.php", $_SERVER['PHP_SELF']) )
    {
        header("Location: index.php");
        die();
    }

if (isset($_POST['submit'])){
    $type = clean_sql($_POST['type']);
	$AID = clean_sql($_POST['AID']);
    $id = clean_sql($_POST['id']);
    $gmid = clean_sql($_POST['gmid']);
    $ip = clean_sql($_POST['ip']);
    $reason = clean_sql($_POST['reason']);
	$BanExtra = clean_sql($_POST['BanExtra']);
    $custom = clean_sql($_POST['custom']);
    //--
    if($reason == 1){
        $reason = $custom;
        $custom = str_replace("
        ","</br>",$custom);
    }
    //--
    if ($type == 1){
        $res = mssql_query_logged("SELECT * FROM Account WHERE UserID = '$id'");
        if(mssql_num_rows($res) == 0){
            msgbox("UserID $id doesnt exist","index.php?do=banuser");
}else{
            $data = mssql_fetch_assoc($res);
            $userID = $data['UserID'];
            $UserAID = $data['AID'];
            if($_POST['C1'] == "ON"){
            }
            mssql_query_logged("UPDATE Account SET UGradeID = '253' WHERE UserID = '$userID'");
            mssql_query_logged("INSERT INTO AccountBan (AID, UserID, IP, BanReason, BanDate, Opened, GMUserID, BanExtra)VALUES('$AID', '$id', '$ip', '$reason', GETDATE(), '1', '$gmid', '$BanExtra')");
            msgbox("The user with the ID $id has been banned","index.php?do=banuser");
        }
    }else{
        $res = mssql_query_logged("SELECT * FROM Character WHERE Name = '$id'");
        if(mssql_num_rows($res) == 0){
            msgbox("The character $id doesnt exist","index.php?do=banuser");
        }else{
            $res = mssql_query_logged("SELECT * FROM Character WHERE Name = '$id'");
            $data = mssql_fetch_assoc($res);
            $UserAID = $data['AID'];
            mssql_query_logged("UPDATE Account SET UGradeID = '253' WHERE AID = '$UserAID'");
            mssql_query_logged("INSERT INTO AccountBan (AID, UserID, IP, BanReason, BanDate, Opened, GMUserID, BanExtra)VALUES('$AID', '$id', '$ip', '$reason', GETDATE(), '1', '$gmid', '$BanExtra')");
			
	$date = date("d-m-y - H:i:s");
    $logfile = fopen("logs/log.txt","a+");
    $logtext = "Tiempo: $date IPStaff: {$_SERVER['REMOTE_ADDR']} User banneado  UserID: $AID  GMID:  $gmid $log\r\n";
    fputs($logfile, $logtext);
	fclose($logfile);
            msgbox("El usuario $id Fue Banneado","index.php?do=banuser");
        }
    }

}

?>
		<article class="module width_full">
		<form name="ipban" method="POST" action="index.php?do=banuser">
			<header><h3>Banear User</h3>
<ul class="tabla">
    <input type="submit" value="Banned User" name="submit" />
</ul>
			</header>
<div class="module_content">

	
<div class="tab_content">
<table class="tablesorter" cellspacing="0"> 

<tr>
    <th width="432"><p align="left">GM User ID</th>
    <th width="432"> <p align="left"><input type="text" name="gmid" size="26" required maxlength="14">&nbsp; </th>
	</tr>

<tr>
    <th width="432"><p align="left">User AID</th>
    <th width="432"><p align="left"><input type="text" name="AID" size="26" required maxlength="14">&nbsp; </th>
</tr>
<tr>
    <th width="432"><p align="left">
        <select size="1" name="type">
          <option selected value="1">User ID </option>
          <option value="2">Character Name </option>
        </select>
    </th>
<th width="432"><p align="left"><input type="text" name="id" size="26" required maxlength="14">&nbsp; </th>
</tr>
<tr>
    <th width="432"><p align="left">User IP</th>
    <th width="432"><p align="left"><input type="text" name="ip" size="26" required maxlength="14">&nbsp; </th>
</tr>
<tr>
    <th width="432"><p align="left">Razon de Ban </th>
    <th width="432"><p align="left">
      <select size="1" name="reason" onchange="UpdateCustom()">
        <option selected value="Modificando Cliente">Modificando Cliente</option>
        <option value="Trampas o hacker">Hack o Trampas</option>
        <option value="Insulto a Staff">Insulto a Staff</option>
        <option value="Insulto a Player">Insulto a Player</option>
        <option value="Swap / etc">Swap / etc. </option>
        <option value="Sin razon especifico">Sin razon especifico</option>
        <option value="1">Otros, especifica abajo</option>
    </select></th>
</tr>
<tr>
    <th width="432"><p align="left">Razon Extra </th>
	<th width="432"><p align="left"><textarea  name="BanExtra" size="40" required></textarea></th>
</tr>
</table></div></form>

	
			
				

				<div class="clear"></div>
			</div>
		</article><!-- end of stats article -->
