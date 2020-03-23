<?php
    if( !ereg("index.php", $_SERVER['PHP_SELF']) )
    {
        header("Location: index.php");
        die();
    }
	
	
if (isset($_POST['submit']))
{
    if ($_POST['UserID'] == "")
    {
        msgbox ("Porfavor Inserte un UserID","index.php?do=evcoins");
    }
    
    if ($_POST['EventCoins'] == "")
    {
        msgbox ("Porfavor Inserte una cantidad de EvCoins","index.php?do=evcoins");
    }
    
    $ip = ''.($_SERVER['REMOTE_ADDR']);
    $userid = ($_POST['UserID']);
    $dgcoins = ($_POST['EventCoins']);

$res2 = mssql_query("SELECT EventCoins FROM Account WHERE UserID = '".$_SESSION['AID']."'");
$acc = mssql_fetch_assoc($res2);
$result = $acc['EventCoins']-$item['CashPrice'];

    $result1 = mssql_query("SELECT EventCoins FROM Account WHERE UserID = '$useridby'");
    $result2 = mssql_query("SELECT EventCoins FROM Account WHERE UserID = '$userid'");

if (mssql_num_rows($result2) == 0)
{
msgbox ("Error, AID not found.","index.php?do=evcoins");
return;
}
    
    $row1 = mssql_fetch_assoc($result1);
    $row2 = mssql_fetch_assoc($result2);
    
    $coins1 = $row1['EventCoins'];
    $coins2 = $row2['EventCoins'];

    $coins1 -= $dgcoins;
    $coins2 += $dgcoins;
    
    mssql_query("UPDATE [Account] SET [EventCoins] = $coins1 WHERE UserID = '$useridby'");
    mssql_query("UPDATE [Account] SET [EventCoins] = $coins2 WHERE UserID = '$userid'");
    done();
}
else gift();

?>
<?php
function gift()
{
?>
<br />
<form name="reg" method="POST" action="index.php?do=evcoins">
                    <div align="center">
                        <table border="1" style="border-collapse: collapse" width="461" height="100%">
                                        <tr>
                                          <td colspan="2">Enviar Event Coins (Event Winner) </td>
                                      </tr>
                                        <tr>
                                          <td width="162">&middot;<span lang="es"> <select name="aid">
                                       <option value="AID">AID</option>
                                       <option value="UserID">UserID</option></select>
                                          <font color="#FF9933">*</font></span></td>
                                          <td width="254"><input type="text" name="UserID" id="UserID" placeholder="UserID" required></td>
                                      </tr>
                                        <tr>
                                          <td>&middot;<span lang="es"> ECoins <font color="#FF9933">*</font></span></td>
                                          <td><select size="1" name="EventCoins" id="EventCoins">
										  <option value="2">2 ECoins</option>
										  <option value="4">4 ECoins</option>
										  <option value="6">6 ECoins</option>
										  <option value="8">8 ECoins</option>
						                              <option value="10">10 ECoins</option>
                                                      <option value="50">50 ECoins</option>
                                                      <option value="75">75 ECoins</option>
                                                      <option value="100">100 ECoins</option>
                                                      <option value="150">150 ECoins</option>
                                                      <option value="200">200 ECoins</option>
                                                      <option value="250">250 ECoins</option>
                                                      <option value="300">300 ECoins</option>
                                                      <option value="350">350 ECoins</option>
                                                      <option value="400">400 ECoins</option>
                                                      <option value="450">450 ECoins</option>
                                                      <option value="500">500 ECoins</option>
											</select></td>
                                      </tr>
                                        <tr>
                                          <td colspan="2"><div align="center">
                                            <form name="form1" method="post" action="">
                                              <label>
                                              <input type="submit" name="submit" id="submit" value="Enviar">
                                              </label>
                                            </form>
                                            </div></td>
                                      </tr>
                                    </table>
                    </div>
                    </form>
<?php
}
?>
<?php
function done()
{
    $letratable  =  "EventCoins";
    $userid = ($_POST['UserID']);
    $dgcoins = ($_POST['EventCoins']);
    $date = date("d-m-y - H:i:s");
    $logfile = fopen("logs/log.txt","a+");
    $logtext = "Tiempo: $date IPStaff: {$_SERVER['REMOTE_ADDR']} - StaffID '{$_SESSION[AID]}' - Cantidad: $dgcoins $letratable  - UserAID: $userid $log\r\n";
    fputs($logfile, $logtext);
	fclose($logfile);

msgbox ("Event Coins enviados correctamente.","index.php?do=evcoins");
}
?> 
<br />
<br />