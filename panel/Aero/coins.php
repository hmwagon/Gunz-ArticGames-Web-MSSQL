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
        msgbox ("Please enter a UserID.","index.php?do=coins");
    }
    
    if ($_POST['Coins'] == "")
    {
        msgbox ("Please enter a DCoins Number.","index.php?do=coins");
    }
    
    $ip = ''.($_SERVER['REMOTE_ADDR']);
    $userid = ($_POST['UserID']);
    $dgcoins = ($_POST['Coins']);

/////////////////////////////////////////////////////
// Insuficent Coins.
$res2 = mssql_query_logged("SELECT Coins FROM Account WHERE AID = '".$_SESSION['AID']."'");
$acc = mssql_fetch_assoc($res2);
$result = $acc['Coins']-$item['CashPrice'];
// Insuficent Coins END.
////////////////////////////////////////////////////

    $result1 = mssql_query_logged("SELECT Coins FROM Account WHERE UserID = '$useridby'");
    $result2 = mssql_query_logged("SELECT Coins FROM Account WHERE UserID = '$userid'");

if (mssql_num_rows($result2) == 0)
{
msgbox ("Error, UserID No existe.","index.php?do=coins");
return;
}
    
    $row1 = mssql_fetch_assoc($result1);
    $row2 = mssql_fetch_assoc($result2);
    
    $coins1 = $row1['Coins'];
    $coins2 = $row2['Coins'];
    
    //if ($coins1 < $dgcoins)
    //{
    //    return;
    //}

    $coins1 -= $dgcoins;
    $coins2 += $dgcoins;
    
    mssql_query_logged("UPDATE [Account] SET [Coins] = $coins1 WHERE UserID = '$useridby'");
    mssql_query_logged("UPDATE [Account] SET [Coins] = $coins2 WHERE UserID = '$userid'");
    msgbox ("Coins enviados correctamente.","index.php?do=coins");
}
else gift();

?>
<?php
function gift()
{
?>
<br />
<form name="reg" method="POST" action="index.php?do=coins">
                    <div align="center">
                        <table border="1" style="border-collapse: collapse" width="461" height="100%">
                                        <tr>
                                          <td colspan="2">Enviar Donator Coins</td>
                                      </tr>
                                        <tr>
                                          <td width="162">&middot;<span lang="es"> UserID<font color="#FF9933">*</font></span></td>
                                          <td width="254"><input type="text" name="UserID" id="UserID" placeholder="UserID" required></td>
                                      </tr>
                                        <tr>
                                          <td>&middot;<span lang="es"> Coins <font color="#FF9933">*</font></span></td>
                                          <td><select size="1" name="Coins" id="Coins">
										  <option value="2">2 Coins</option>
										  <option value="4">4 Coins</option>
										  <option value="6">6 Coins</option>
										  <option value="8">8 Coins</option>
						                              <option value="10">10 Coins</option>
                                                      <option value="50" selected>50 Coins</option>
                                                      <option value="75">75 Coins</option>
                                                      <option value="100">100 Coins</option>
                                                      <option value="150">150 Coins</option>
                                                      <option value="200">200 Coins</option>
                                                      <option value="250">250 Coins</option>
                                                      <option value="300">300 Coins</option>
                                                      <option value="350">350 Coins</option>
                                                      <option value="400">400 Coins</option>
                                                      <option value="450">450 Coins</option>
                                                      <option value="500">500 Coins</option>
													  <option value="1000">1000 Coins</option>
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

