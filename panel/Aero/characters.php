<?php
    if( !ereg("index.php", $_SERVER['PHP_SELF']) )
    {
        header("Location: index.php");
        die();
    }

    if( isset($_POST['changename']) )
    {
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);
        $nname = clean_sql($_POST['nname']);

        if( $type == "" || $id == "" || $nname == "" )
        {
            msgbox("Debes llenar todos los campos","index.php?do=characters");
            die();
        }

        $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE Name = '$nname'");
        if( num_rows($query01) != 0 )
        {
            msgbox("Ya existe un personaje con ese Nombre","index.php?do=characters");
            die();
        }

        if( $type == 0 )
        {
            $query02 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE Name = '$id'");
            $part = "Name";
        }
        elseif( $type == 1 )
        {
            $query02 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE CID = '$id'");
            $part = "CID";
        }
        else
        {
            redirect("index.php?do=characters");
            die();
        }

        if( num_rows($query02) != 1 )
        {
             msgbox("El personaje seleccionado no existe","index.php?do=characters");
            die();
        }
        else
        {
            odbc_exec($connection, "UPDATE {$_CONFIG[CharTable]} SET Name = '$nname' WHERE $part = '$id'");
            msgbox("Nombre cambiado exitosamente","index.php?do=characters");
            die();
        }

    }
    elseif( isset($_POST['deletechar']) )
    {
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);

        if( $type == "" || $id == "" )
        {
            msgbox("Debes llenar todos los campos","index.php?do=characters");
            die();
        }

        if( $type == 0 )
        {
            $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE Name = '$id'");
            $part = "Name";
        }
        elseif( $type == 1 )
        {
            $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE CID = '$id'");
            $part = "CID";
        }
        else
        {
            redirect("index.php?do=characters");
            die();
        }

        if( num_rows($query01) != 1 )
        {
            msgbox("El personaje seleccionado no existe","index.php?do=characters");
            die();
        }
        else
        {
            odbc_exec($connection, "UPDATE {$_CONFIG[CharTable]} SET CharNum = -1, DeleteFlag = 1, Name='', DeleteName='$id' WHERE $part = '$id'");
            msgbox("Personaje borrado exitosamente","index.php?do=characters");
            die();
        }


    }
    elseif( isset($_POST['deletecitems']) )
    {
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);

        if( $type == "" || $id == "" )
        {
            msgbox("Por favor rellene todos los campos","index.php?do=characters");
            die();
        }

        if( $type == 0 )
        {
            $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE Name = '$id'");
            $part = "Name";
        }
        elseif( $type == 1 )
        {
            $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE CID = '$id'");
            $part = "CID";
        }
        else
        {
            redirect("index.php?do=characters");
            die();
        }

        if( num_rows($query01) != 1 )
        {
             msgbox("El personaje seleccionado no existe","index.php?do=characters");
            die();
        }
        else
        {
            odbc_exec($connection, "DELETE FROM {$_CONFIG[CItemTable]} WHERE $part = '$id'");
            msgbox("Items borrados exitosamente","index.php?do=characters");
            die();
        }
    }
    elseif( isset($_POST['deleteaitems']) )
    {
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);

        if( $type == "" || $id == "" )
        {
            msgbox("Por favor rellene los campos","index.php?do=characters");
            die();
        }

        if( $type == 0 )
        {
            $query01 = odbc_exec($connection, "SELECT ac.AID FROM {$_CONFIG[AccountTable]} ac INNER JOIN {$_CONFIG[CharTable]} ch ON ac.AID = ch.AID WHERE ch.Name = '$id'");
        }
        elseif( $type == 1 )
        {
            $query01 = odbc_exec($connection, "SELECT ac.AID FROM {$_CONFIG[AccountTable]} ac INNER JOIN {$_CONFIG[CharTable]} ch ON ac.AID = ch.AID WHERE ch.CID = '$id'");
        }
        elseif( $type == 2 )
        {
            $query01 = odbc_exec($connection, "SELECT AID FROM {$_CONFIG[AccountTable]} WHERE AID = '$id'");
        }
        else
        {
            redirect("index.php?do=characters");
            die();
        }

        if( num_rows($query01) != 1 )
        {
            msgbox("El personaje o cuenta seleccionado no existe","index.php?do=characters");
            die();
        }
        else
        {
            odbc_fetch_row($query01);
            $aid = odbc_result($query01, 1);

            odbc_exec($connection, "DELETE FROM {$_CONFIG[AItemTable]} WHERE AID = '$aid'");
            msgbox("Items borrados exitosamente","index.php?do=characters");
            die();
        }
    }
    elseif( isset($_POST['senditem']) )
    {
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);
        $itemid = clean_sql($_POST['itemid']);

        if( $type == "" || $id == "" || $itemid == "" )
        {
            msgbox("Rellene los campos","index.php?do=characters");
            die();
        }

        if( !is_numeric($itemid) )
        {
            msgbox("Valor numérico incorrecto","index.php?do=characters");
            die();
        }

        if( $type == 0 )
        {
            $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE Name = '$id'");
            $part = "Name";
        }
        elseif( $type == 1 )
        {
            $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE CID = '$id'");
            $part = "CID";
        }
        else
        {
            redirect("index.php?do=characters");
            die();
        }

        if( num_rows($query01) != 1 )
        {
            msgbox("El personaje seleccionado no existe","index.php?do=characters");
            die();
        }
        else
        {
            odbc_fetch_row($query01);
            $cid = odbc_result($query01, 1);

            odbc_exec($connection, "INSERT INTO {$_CONFIG[CItemTable]} (CID, ItemID, RegDate) VALUES ('$cid', '$itemid', GETDATE())");
            msgbox("Item enviado exitosamente","index.php?do=characters");
            die();

        }

    }
    elseif( isset($_POST['deleteitem']) )
    {
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);
        $itemid = clean_sql($_POST['itemid']);

        if( $type == "" || $id == "" || $itemid == "" )
        {
            msgbox("Rellene los campos","index.php?do=characters");
            die();
        }

        if( !is_numeric($itemid) )
        {
            msgbox("alor numérico incorrecto","index.php?do=characters");
            die();
        }

        if( $type == 0 )
        {
            $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE Name = '$id'");
            $part = "Name";
        }
        elseif( $type == 1 )
        {
            $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE CID = '$id'");
            $part = "CID";
        }
        else
        {
            redirect("index.php?do=characters");
            die();
        }

        if( num_rows($query01) != 1 )
        {
             msgbox("El personaje seleccionado no existe","index.php?do=characters");
            die();
        }
        else
        {
            odbc_fetch_row($query01);
            $cid = odbc_result($query01, 1);

            odbc_exec($connection, "DELETE FROM {$_CONFIG[CItemTable]} WHERE CID = '$cid' AND ItemID = '$itemid'");
            msgbox("Item ha sido borrado exitosamente","index.php?do=characters");
            die();
        }
    }
    elseif( isset($_POST['resetchar']) )
    {
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);

        if( $type == "" || $id == "" )
        {
            msgbox("Rellene los campos","index.php?do=characters");
            die();
        }

        if( $type == 0 )
        {
            $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE Name = '$id'");
            $part = "Name";
        }
        elseif( $type == 1 )
        {
            $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE CID = '$id'");
            $part = "CID";
        }
        else
        {
            redirect("index.php?do=characters");
            die();
        }

        if( num_rows($query01) != 1 )
        {
           msgbox("El personaje seleccionado no existe","index.php?do=characters");
            die();
        }
        else
        {
            odbc_exec($connection, "UPDATE {$_CONFIG[CharTable]} SET Level = 1, XP = 0, BP = 1000 WHERE $part = '$id'");
            msgbox("Personaje reiniciado exitosamente","index.php?do=characters");
            die();
        }
    }
    elseif( isset($_POST['changexp']) )
    {
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);
        $exp = clean_sql($_POST['exp']);

        if( $type == "" || $id == "" || $exp == "" )
        {
            msgbox("Rellene los campos","index.php?do=characters");
            die();
        }

        if( !is_numeric($exp) )
        {
             msgbox("Valor numérico incorrecto","index.php?do=characters");
            die();
        }

        if( $type == 0 )
        {
            $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE Name = '$id'");
            $part = "Name";
        }
        elseif( $type == 1 )
        {
            $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE CID = '$id'");
            $part = "CID";
        }
        else
        {
            redirect("index.php?do=characters");
            die();
        }

        if( num_rows($query01) != 1 )
        {
            msgbox("El personaje seleccionado no existe","index.php?do=characters");
            die();
        }
        else
        {
            odbc_exec($connection, "UPDATE {$_CONFIG[CharTable]} SET XP = '$exp' WHERE $part = '$id'");
           msgbox("EXP cambiada exitosamente","index.php?do=characters");
            die();
        }
    }
    elseif( isset($_POST['changelvl']) )
    {
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);
        $lvl = clean_sql($_POST['lvl']);

        if( $type == "" || $id == "" || $lvl == "" )
        {
            msgbox("Por favor rellene los campos","index.php?do=characters");
            die();
        }

        if( !is_numeric($lvl) )
        {
            msgbox("Valor numérico incorrecto","index.php?do=characters");
            die();
        }

        if( $type == 0 )
        {
            $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE Name = '$id'");
            $part = "Name";
        }
        elseif( $type == 1 )
        {
            $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE CID = '$id'");
            $part = "CID";
        }
        else
        {
            redirect("index.php?do=characters");
            die();
        }

        if( num_rows($query01) != 1 )
        {
          msgbox("El personaje seleccionado no existe","index.php?do=characters");
            die();
        }
        else
        {
            odbc_exec($connection, "UPDATE {$_CONFIG[CharTable]} SET Level = '$lvl' WHERE $part = '$id'");
            msgbox("LVL cambiado exitosamente","index.php?do=characters");
            die();
        }
    }
    elseif( isset($_POST['changebounty']) )
    {
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);
        $bounty = clean_sql($_POST['bounty']);

        if( $type == "" || $id == "" || $bounty == "" )
        {
             msgbox("Rellene todos los campos","index.php?do=characters");
            die();
        }

        if( !is_numeric($bounty) )
        {
           msgbox("Valor numérico incorrecto","index.php?do=characters");
            die();
        }

        if( $type == 0 )
        {
            $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE Name = '$id'");
            $part = "Name";
        }
        elseif( $type == 1 )
        {
            $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE CID = '$id'");
            $part = "CID";
        }
        else
        {
            redirect("index.php?do=characters");
            die();
        }

        if( num_rows($query01) != 1 )
        {
            msgbox("El personaje seleccionado no existe","index.php?do=characters");
            die();
        }
        else
        {
            odbc_exec($connection, "UPDATE {$_CONFIG[CharTable]} SET BP = '$bounty' WHERE $part = '$id'");
            msgbox("Bounty cambiado exitosamente","index.php?do=characters");
            die();
        }
    }
    elseif( isset($_POST['changesex'] ) )
    {
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);
        $sex = clean_sql($_POST['sex']);

        if( $type == "" || $id == "" || $sex == "" )
        {
             msgbox("Rellene todos los campos","index.php?do=characters");
            die();
        }

        if( $sex != 0 && $sex != 1 )
        {
            msgbox("Sexo inválido","index.php?do=characters");
            die();
        }

        if( $type == 0 )
        {
            $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE Name = '$id'");
            $part = "Name";
        }
        elseif( $type == 1 )
        {
            $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE CID = '$id'");
            $part = "CID";
        }
        else
        {
            redirect("index.php?do=characters");
            die();
        }

        if( num_rows($query01) != 1 )
        {
           msgbox("El personaje seleccionado no existe","index.php?do=characters");
            die();
        }
        else
        {
            odbc_exec($connection, "UPDATE {$_CONFIG[CharTable]} SET Sex = '$sex' WHERE $part = '$id'");
            msgbox("Sexo cambiado exitosamente","index.php?do=characters");
            die();
        }
    }
    elseif( isset($_POST['changehair']) )
    {
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);
        $hair = clean_sql($_POST['hair']);

        if( $type == "" || $id == "" || $hair == "" )
        {
            msgbox("Rellene todos los campos","index.php?do=characters");
            die();
        }

        if( $hair != 0 && $hair != 1 && $hair != 2 && $hair != 3 )
        {
            msgbox("Pelo inválido","index.php?do=characters");
            die();
        }

        if( $type == 0 )
        {
            $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE Name = '$id'");
            $part = "Name";
        }
        elseif( $type == 1 )
        {
            $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE CID = '$id'");
            $part = "CID";
        }
        else
        {
            redirect("index.php?do=characters");
            die();
        }

        if( num_rows($query01) != 1 )
        {
           msgbox("El personaje seleccionado no existe","index.php?do=characters");
            die();
        }
        else
        {
            odbc_exec($connection, "UPDATE {$_CONFIG[CharTable]} SET Hair = '$hair' WHERE $part = '$id'");
             msgbox("Pelo cambiado exitosamente","index.php?do=characters");
            die();
        }
    }
    elseif( isset($_POST['changeface']) )
    {
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);
        $face = clean_sql($_POST['face']);

        if( $type == "" || $id == "" || $face == "" )
        {
              msgbox("Rellena los campos","index.php?do=characters");
            die();
        }

        if( $face != 0 && $face != 1 && $face != 2 && $face != 3 )
        {
           msgbox("Cara inválida","index.php?do=characters");
            die();
        }

        if( $type == 0 )
        {
            $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE Name = '$id'");
            $part = "Name";
        }
        elseif( $type == 1 )
        {
            $query01 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]} WHERE CID = '$id'");
            $part = "CID";
        }
        else
        {
            redirect("index.php?do=characters");
            die();
        }

        if( num_rows($query01) != 1 )
        {
            msgbox("El personaje seleccionado no existe","index.php?do=characters");
            die();
        }
        else
        {
            odbc_exec($connection, "UPDATE {$_CONFIG[CharTable]} SET Face = '$face' WHERE $part = '$id'");
msgbox("Cara cambiada exitosamente","index.php?do=characters");
            die();
        }
    }

?>
<br />
<div align="center">
<table border="1" style="border-collapse: collapse" id="changename">
<tr><td colspan="2"><b>Cambiar nombre de personaje</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=characters">
<tr>
    <td>
    <select name="type">
        <option value="0">Nombre</option>
        <option value="1">CID</option>
    </select>:&nbsp;&nbsp;<input type="text" name="id" placeholder="Nombre" required/>&nbsp;&nbsp;<?php echo $_STR[Char2]; ?>:&nbsp;&nbsp;<input type="text" name="nname" placeholder="Nuevo Nombre" required/>
    &nbsp;&nbsp;<input type="submit" name="changename" value="Cambiar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="deletechar">
<tr><td colspan="2"><b>Borrar personaje</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=characters">
<tr>
    <td>
    <select name="type">
        <option value="0">Nombre</option>
        <option value="1">CID</option>
    </select>:&nbsp;&nbsp;<input type="text" name="id" placeholder="Nombre" required/>
    &nbsp;&nbsp;<input type="submit" name="deletechar" value="Borrar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="deletecitems">
<tr><td colspan="2"><b>Borrar todos los items del equip</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=characters">
<tr>
    <td>
    <select name="type">
        <option value="0">Nombre</option>
        <option value="1">CID</option>
    </select>:&nbsp;&nbsp;<input type="text" name="id" placeholder="Nombre" required/>
    &nbsp;&nbsp;<input type="submit" name="deletecitems" value="Borrar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="deleteaitems">
<tr><td colspan="2"><b>Borrar todos los items del Storage</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=characters">
<tr>
    <td>
    <select name="type">
        <option value="0">Nombre</option>
        <option value="1">CID</option>
        <option value="2">AID</option>
    </select>:&nbsp;&nbsp;<input type="text" name="id" placeholder="Nombre" required/>
    &nbsp;&nbsp;<input type="submit" name="deleteaitems" value="Borrar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="senditem">
<tr><td colspan="2"><b>Enviar item al equip</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=characters">
<tr>
    <td>
    <select name="type">
        <option value="0">Nombre</option>
        <option value="1">CID</option>
    </select>:&nbsp;&nbsp;<input type="text" name="id" placeholder="Nombre" required/>&nbsp;&nbsp;ItemID:&nbsp;&nbsp;<input type="number" name="itemid" required/>
    &nbsp;&nbsp;<input type="submit" name="senditem" value="Enviar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="deleteitem">
<tr><td colspan="2"><b>Borrar item del equip</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=characters">
<tr>
    <td>
    <select name="type">
        <option value="0">Nombre</option>
        <option value="1">CID</option>
    </select>:&nbsp;&nbsp;<input type="text" name="id" placeholder="Nombre" required/>&nbsp;&nbsp;ItemID:&nbsp;&nbsp;<input type="number" name="itemid" required/>
    &nbsp;&nbsp;<input type="submit" name="deleteitem" value="Borrar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="resetchar">
<tr><td colspan="2"><b>Reiniciar Personaje (Lvl 1, XP: 0, BT: 1000)</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=characters">
<tr>
    <td>
    <select name="type">
        <option value="0">Nombre</option>
        <option value="1">CID</option>
    </select>:&nbsp;&nbsp;<input type="text" name="id" placeholder="Nombre" required/>
    &nbsp;&nbsp;<input type="submit" name="resetchar" value="Reiniciar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="changexp">
<tr><td colspan="2"><b>Cambiar EXP de personaje</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=characters">
<tr>
    <td>
    <select name="type">
        <option value="0">Nombre</option>
        <option value="1">CID</option>
    </select>:&nbsp;&nbsp;<input type="text" name="id" placeholder="Nombre" required/>&nbsp;&nbsp;EXP:&nbsp;&nbsp;<input type="number" name="exp" required />
    &nbsp;&nbsp;<input type="submit" name="changexp" value="Cambiar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="changelvl">
<tr><td colspan="2"><b>Cambiar Nivel de personaje</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=characters">
<tr>
    <td>
    <select name="type">
        <option value="0">Nombre</option>
        <option value="1">CID</option>
    </select>:&nbsp;&nbsp;<input type="text" name="id" placeholder="Nombre" required/>&nbsp;&nbsp;LvL:&nbsp;&nbsp;<input type="number" name="lvl" required />
    &nbsp;&nbsp;<input type="submit" name="changelvl" value="Cambiar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="changebounty">
<tr><td colspan="2"><b>Cambiar Bounty de personaje</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=characters">
<tr>
    <td>
    <select name="type">
        <option value="0">Nombre</option>
        <option value="1">CID</option>
    </select>:&nbsp;&nbsp;<input type="text" name="id" placeholder="Nombre" required/>&nbsp;&nbsp;Bounty:&nbsp;&nbsp;<input type="number" name="bounty" required/>
    &nbsp;&nbsp;<input type="submit" name="changebounty" value="Cambiar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="changesex">
<tr><td colspan="2"><b>Cambiar Sexo de personaje</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=characters">
<tr>
    <td>
    <select name="type">
        <option value="0">Nombre</option>
        <option value="1">CID</option>
    </select>:&nbsp;&nbsp;<input type="text" name="id" placeholder="Nombre" required/>&nbsp;&nbsp;
    <select name="sex">
        <option value="0">Hombre</option>
        <option value="1">Mujer</option>
    </select>
    &nbsp;&nbsp;<input type="submit" name="changesex" value="Cambiar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="changehair">
<tr><td colspan="2"><b>Cambiar Pelo de personaje</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=characters">
<tr>
    <td>
    <select name="type">
        <option value="0">Nombre</option>
        <option value="1">CID</option>
    </select>:&nbsp;&nbsp;<input type="text" name="id" placeholder="Nombre" required/>&nbsp;&nbsp;Pelo
    <select name="hair">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>
    &nbsp;&nbsp;<input type="submit" name="changehair" value="Cambiar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="changeface">
<tr><td colspan="2"><b><?php echo $_STR[Char21]; ?></b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=characters">
<tr>
    <td>
    <select name="type">
        <option value="0">Cambiar Cara de personaje</option>
        <option value="1">CID</option>
    </select>:&nbsp;&nbsp;<input type="text" name="id" placeholder="Nombre" required/>&nbsp;&nbsp;Cara
    <select name="face">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>
    &nbsp;&nbsp;<input type="submit" name="changeface" value="Cambiar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
</div>
 <br /> <br />