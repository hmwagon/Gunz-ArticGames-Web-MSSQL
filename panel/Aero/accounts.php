<?php
    if( !ereg("index.php", $_SERVER['PHP_SELF']) )
    {
        header("Location: index.php");
        die();
    }

    if( isset($_POST['changeuserid']) )
    {
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);
        $nuserid = clean_sql($_POST['nuserid']);
        

        if( $type == "" || $id == "" || $nuserid == "" )
        {
            msgbox("UserID Cambiado","index.php?do=accounts");
            die();
        }

        $query01 = odbc_exec($connection, "SELECT AID FROM {$_CONFIG[AccountTable]}(nolock) WHERE UserID = '$nuserid'");
        if( num_rows($query01) != 0 )
        {
            msgbox("Ya existe una cuenta con la UserID","index.php?do=accounts");
            die();
        }

        if( $type == 0 )
        {
            $query02 = odbc_exec($connection, "SELECT AID FROM {$_CONFIG[AccountTable]}(nolock) WHERE UserID = '$id'");
            $part = "UserID";
        }
        elseif( $type == 1 )
        {
            $query02 = odbc_exec($connection, "SELECT UserID FROM {$_CONFIG[AccountTable]}(nolock) WHERE AID = '$id'");
            $part = "AID";
        }
        else
        {
            redirect("index.php?do=accounts");
            die();
        }

        if( num_rows($query02) != 1 )
        {
            msgbox("La cuenta seleccionada no existe","index.php?do=accounts");
            die();
        }
        else
        {
            odbc_exec($connection, "UPDATE {$_CONFIG[AccountTable]} SET UserID = '$nuserid' WHERE $part = '$id'");
			odbc_exec($connection, "UPDATE {$_CONFIG[LoginTable]} SET UserID = '$nuserid' WHERE $part = '$id'");
            msgbox("El UserID fue cambiado","index.php?do=accounts");
            die();
        }
    }
    elseif( isset($_POST['changepassword']) )
    {
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);
        $passw = clean_sql($_POST['npassw']);

        if( $type == "" || $id == "" || $passw == "" )
        {
           msgbox("Debes llenar todos los campos","index.php?do=accounts");
            die();
        }

        if( $type == 0 )
        {
            $query02 = odbc_exec($connection, "SELECT AID FROM {$_CONFIG[AccountTable]}(nolock) WHERE UserID = '$id'");
            $part = "UserID";
        }
        elseif( $type == 1 )
        {
            $query02 = odbc_exec($connection, "SELECT UserID FROM {$_CONFIG[AccountTable]}(nolock) WHERE AID = '$id'");
            $part = "AID";
        }
        else
        {
            redirect("index.php?do=accounts");
            die();
        }

        if( num_rows($query02) != 1 )
        {
           msgbox("La cuenta seleccionada no existe","index.php?do=accounts");
            die();
        }
        else
        {
            odbc_exec($connection, "UPDATE {$_CONFIG[LoginTable]} SET Password = '$passw' WHERE $part = '$id'");
            msgbox("Contraseña cambiada exitosamente","index.php?do=accounts");
            die();
        }
    }
    elseif( isset($_POST['changeugradeid']) )
    {
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);
        $rank = clean_sql($_POST['rank']);

        if($rank != 253 && $rank != 0 && $rank != 252 && $rank != 254 && $rank != 255 && $rank != 3 && $rank != 4 && $rank != 5 && $rank != 6 && $rank != 7 && $rank != 8 && $rank != 100 && $rank != 101 && $rank != 102 && $rank != 103 && $rank != 104  && $rank != 105  && $rank != 2)
        {
             msgbox("Invalid Rank","index.php?do=accounts");
            die();
        }

        if( $type == "" || $id == "" || $rank == "" )
        {
		  msgbox("Debes llenar todos los campos","index.php?do=accounts");
          die();
        }

        if( $type == 0 )
        {
            $query02 = odbc_exec($connection, "SELECT AID FROM {$_CONFIG[AccountTable]}(nolock) WHERE UserID = '$id'");
            $part = "UserID";
        }
        elseif( $type == 1 )
        {
            $query02 = odbc_exec($connection, "SELECT UserID FROM {$_CONFIG[AccountTable]}(nolock) WHERE AID = '$id'");
            $part = "AID";
        }
        elseif( $type == 2 )
        {
            $query02 = odbc_exec($connection, "SELECT AID FROM {$_CONFIG[CharTable]}(nolock) WHERE Name = '$id'");
            if( num_rows($query02) != 1 )
            {
                msgbox("La cuenta seleccionada no existe","index.php?do=accounts");
                die();
            }
            else
            {
                odbc_fetch_row($query02);
                $id = odbc_result($query02, 1);
                $part = "AID";
            }
        }
        else
        {
            redirect("index.php?do=accounts");
            die();
        }

        if( $type != 2 && num_rows($query02) != 1 )
        {
            msgbox("La cuenta seleccionada no existe","index.php?do=accounts");
            die();
        }
        else
        {
            odbc_exec($connection, "UPDATE {$_CONFIG[AccountTable]} SET UgradeID = '$rank' WHERE $part = '$id'");
            msgbox("Rango cambiado exitosamente","index.php?do=accounts");
            die();
        }
    }
    elseif( isset($_POST['sendallstorage']) )
    {
        $itemid = clean_sql($_POST['itemid']);
        $rentperiod = clean_sql($_POST['rentperiod']);

        if($rentperiod == "")
            $rentperiod = 0;

        if( !is_numeric($itemid) || !is_numeric($rentperiod) )
        {
            msgbox("ItemID o duración incorrectos","index.php?do=accounts");
            die();
        }

        if($rentperiod == 0)
        {
            odbc_exec($connection, "
                        INSERT INTO {$_CONFIG[AItemTable]} (AID, ItemID, RentDate, cnt)
                        (SELECT ac.AID, '$itemid', GETDATE(), 1 FROM {$_CONFIG[AccountTable]}(nolock) ac)");
        }
        else
        {
            $rentperiod = $rentperiod*24;
            odbc_exec($connection, "
                        INSERT INTO {$_CONFIG[AItemTable]} (AID, ItemID, RentDate, RentHourPeriod, cnt)
                        (SELECT ac.AID, '$itemid', GETDATE(), '$rentperiod', 1 FROM {$_CONFIG[AccountTable]}(nolock) ac)");
        }
        msgbox("Item enviado al storage de todas las cuentas","index.php?do=accounts");
        die();

    }
    elseif( isset($_POST['sendstorage']) )
    {
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);
        $itemid = clean_sql($_POST['itemid']);
        $rentperiod = clean_sql($_POST['rentperiod']);

        if($rentperiod == "")
            $rentperiod = 0;

        if( !is_numeric($itemid) || !is_numeric($rentperiod) )
        {
           msgbox("ItemID o duración incorrectos","index.php?do=accounts");
            die();
        }

        if( $type == 0 )
        {
            $query02 = odbc_exec($connection, "SELECT AID FROM {$_CONFIG[AccountTable]}(nolock) WHERE UserID = '$id'");
        }
        elseif( $type == 1 )
        {
            $query02 = odbc_exec($connection, "SELECT UserID FROM {$_CONFIG[AccountTable]}(nolock) WHERE AID = '$id'");
        }
        else
        {
            redirect("index.php?do=accounts");
            die();
        }

        if( num_rows($query02) != 1 )
        {
           msgbox("La cuenta seleccionada no existe","index.php?do=accounts");
            die();
        }
        else
        {
            if( $type == 0 )
            {
                odbc_fetch_row($query02);
                $id = odbc_result($query02, 1);
            }

            if($rentperiod == 0)
            {
                odbc_exec($connection, "
                            INSERT INTO {$_CONFIG[AItemTable]} (AID, ItemID, RentDate, cnt)
                            VALUES('$id', '$itemid', GETDATE(), 1)");
            }
            else
            {
                $rentperiod = $rentperiod*24;
                odbc_exec($connection, "
                            INSERT INTO {$_CONFIG[AItemTable]} (AID, ItemID, RentDate, RentHourPeriod, cnt)
                            VALUES('$id', '$itemid', GETDATE(), '$rentperiod', 1)");
            }

            msgbox("Item enviado al storage de la cuenta seleccionada","index.php?do=accounts");
            die();
        }



    }
?>
<br />
<div align="center">
<table border="1" style="border-collapse: collapse" id="changeuserid">
<tr><td colspan="2"><b>Cambiar UserID</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=accounts">
<tr>
    <td>
    <select name="type">
        <option value="0">UserID</option>
        <option value="1">AID</option>
    </select>:&nbsp;&nbsp;<input type="text" name="id" required placeholder="UserID" maxlength="20" />&nbsp;&nbsp; Nueva UserID: &nbsp;&nbsp;<input type="text" name="nuserid" placeholder="Nuevo UserID" required maxlength="20" />
    &nbsp;&nbsp;<input type="submit" name="changeuserid" value="Cambiar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="changepassword">
<tr><td colspan="2"><b>Cambiar Contraseña</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=accounts">
<tr>
    <td>
    <select name="type">
        <option value="0">UserID</option>
        <option value="1">AID</option>
    </select>:&nbsp;&nbsp;<input type="text" name="id" placeholder="Contraseña" maxlength="20" required/>&nbsp;&nbsp;Nueva Contraseña: &nbsp;&nbsp;<input type="text" name="npassw" placeholder="Nueva Contraseña" required maxlength="20" />
    &nbsp;&nbsp;<input type="submit" name="changepassword" value="Cambiar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="changeugradeid">
<tr><td colspan="2"><b>Cambiar Rango de Usuario</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=accounts">
<tr>
    <td>
    <select name="type">
        <option value="0">UserID</option>
        <option value="1">AID</option>
        <option value="2">Nombre del personaje</option>
    </select>:&nbsp;&nbsp;<input type="text" name="id" placeholder="UserID" required maxlength="20" />&nbsp;&nbsp;
    <select name="rank">
        <option value="253">Banned</option>
        <option value="0">Normal</option>
        <option value="2">JJang de Cuenta</option>
        <option value="100">Criminal</option>
        <option value="101">Advertido 1º</option>
        <option value="102">Advertido 2º</option>
        <option value="103">Advertido 3º</option>
        <option value="104">Baneado en Chat</option>
        <option value="105">Penalty</option>
		<option value="252">GameMaster (GM)</option>
		<option value="254">Moderador</option>
		<option value="255">Administrador</option>
    </select>
    &nbsp;&nbsp;<input type="submit" name="changeugradeid" value="Cambiar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="sendallstorage">
<tr><td colspan="2"><b>Enviar item al storage de TODAS las cuentas</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=accounts">
<tr>
    <td>
    ItemID:&nbsp;&nbsp;<input type="text" name="itemid" placeholder="ItemID" required maxlength="20" />&nbsp;&nbsp;Duración(Dias):&nbsp;&nbsp;<input type="number" name="rentperiod" value="5" required maxlength="2" />
    &nbsp;&nbsp;<input type="submit" name="sendallstorage" value="Enviar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="sendstorage">
<tr><td colspan="2"><b>Enviar item al storage</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=accounts">
<tr>
    <td>
    <select name="type">
        <option value="0">UserID</option>
        <option value="1">AID</option>
    </select>
    :&nbsp;&nbsp;<input type="text" name="id" placeholder="ItemID"  required maxlength="20" />
    ItemID:&nbsp;&nbsp;<input type="text" name="itemid"  required maxlength="20" /><br /><br />Duración(Dias):&nbsp;&nbsp;<input type="number" name="rentperiod" value="0"  required maxlength="2" />
    &nbsp;&nbsp;<input type="submit" name="sendstorage" value="Enviar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
</div>