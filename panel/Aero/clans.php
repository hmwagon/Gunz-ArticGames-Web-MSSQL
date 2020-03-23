<?php
    if( !ereg("index.php", $_SERVER['PHP_SELF']) )
    {
        header("Location: index.php");
        die();
    }

    if( isset($_POST['fetchrank']) )
    {
        $query01 = odbc_exec($connection, "
                                SELECT CLID FROM {$_CONFIG[ClanTable]}(nolock) WHERE DeleteFlag=0 AND ((Wins != 0) OR (Losses != 0))
	                            ORDER BY Point Desc, Wins Desc, Losses Asc");
        $rank = 0;

        while( odbc_fetch_row($query01) )
        {
            $rank++;
            $clid = odbc_result($query01, 1);
            odbc_exec($connection, "UPDATE {$_CONFIG[ClanTable]} SET Ranking = $rank WHERE CLID = $clid");
        }

        msgbox("Ranking de clanes generado exitosamente","index.php?do=clans");
        die();
    }
    elseif( isset($_POST['createclan']) )
    {
        $clanname = clean_sql($_POST['clanname']);
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);

        if( $clanname == "" || $type == "" || $id == "" )
        {
             msgbox("Rellene los campos","index.php?do=clans");
            die();
        }

        $query01 = odbc_exec($connection, "SELECT CLID FROM {$_CONFIG[ClanTable]}(nolock) WHERE Name = '$clanname'");
        if( num_rows($query01) != 0 )
        {
           msgbox("Ya existe un clan con el nombre seleccionado","index.php?do=clans");
            die();
        }

        if( $type == 0 )
        {
            $query02 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]}(nolock) WHERE Name = '$id'");
        }
        elseif( $type == 1 )
        {
            $query02 = odbc_exec($connection, "SELECT CID FROM {$_CONFIG[CharTable]}(nolock) WHERE CID = '$id'");
        }
        else
        {
            redirect("index.php?do=clans");
            die();
        }

        if( num_rows($query02) != 1 )
        {
            msgbox("El master seleccionado no existe","index.php?do=clans");
            die();
        }
        else
        {
            odbc_fetch_row($query02);
            $cid = odbc_result($query02, 1);

            $query03 = odbc_exec($connection, "SELECT CLID FROM {$_CONFIG[ClanMembTable]} WHERE CID = '$cid'");

            if( num_rows($query03) != 0 )
            {
                 msgbox("El master seleccionado es miembro de otro clan","index.php?do=clans");
                die();
            }

            odbc_exec($connection, "
                            INSERT INTO {$_CONFIG[ClanTable]} (Name, MasterCID, RegDate)
                            VALUES ('$clanname', '$cid', GETDATE())");

            $query04 = odbc_exec($connection, "SELECT CLID FROM {$_CONFIG[ClanTable]}(nolock) WHERE Name = '$clanname' AND MasterCID = '$cid'");
            odbc_fetch_row($query04);
            $clid = odbc_result($query04, 1);

            odbc_exec($connection, "
                            INSERT INTO {$_CONFIG[ClanMembTable]} (CLID, CID, Grade, RegDate)
                            VALUES ('$clid', '$cid', 1, GETDATE())");

            msgbox("Clan creado exitosamente","index.php?do=clans");
            die();
        }

    }
    elseif( isset($_POST['deleteclan']) )
    {
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);

        if( $type == "" || $id == "" )
        {
           msgbox("Rellene los campos","index.php?do=clans");
            die();
        }

        if( $type == 0 )
        {
            $query01 = odbc_exec($connection, "SELECT CLID, Name FROM {$_CONFIG[ClanTable]}(nolock) WHERE Name = '$id'");
        }
        elseif( $type == 1 )
        {
            $query01 = odbc_exec($connection, "SELECT CLID, Name FROM {$_CONFIG[ClanTable]}(nolock) WHERE CLID = '$id'");
        }
        else
        {
            redirect("index.php?do=clans");
            die();
        }

        if( num_rows($query01) != 1 )
        {
            msgbox("El Clan seleccionado no existe","index.php?do=clans");
            die();
        }
        else
        {
            odbc_fetch_row($query01);
            $clid = odbc_result($query01, 1);
            $name = odbc_result($query01, 2);
            odbc_exec($connection, "DELETE FROM {$_CONFIG[ClanMembTable]} WHERE CLID = '$clid'");
            odbc_exec($connection, "UPDATE {$_CONFIG[ClanTable]} SET Name = NULL, DeleteFlag = 1, DeleteName = '$name' WHERE CLID = '$clid'");

             msgbox("Clan borrado exitosamente","index.php?do=clans");
            die();
        }
    }
    elseif( isset($_POST['resetclan']) )
    {
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);

        if( $type == "" || $id == "" )
        {
msgbox("Rellena los campos","index.php?do=clans");
            die();
        }

        if( $type == 0 )
        {
            $query01 = odbc_exec($connection, "SELECT CLID, Name FROM {$_CONFIG[ClanTable]}(nolock) WHERE Name = '$id'");
        }
        elseif( $type == 1 )
        {
            $query01 = odbc_exec($connection, "SELECT CLID, Name FROM {$_CONFIG[ClanTable]}(nolock) WHERE CLID = '$id'");
        }
        else
        {
            redirect("index.php?do=clans");
            die();
        }

        if( num_rows($query01) != 1 )
        {
            msgbox("El Clan seleccionado no existe","index.php?do=clans");
            die();
        }
        else
        {
            odbc_fetch_row($query01);
            $clid = odbc_result($query01, 1);
            $name = odbc_result($query01, 2);

            odbc_exec($connection, "
                            UPDATE {$_CONFIG[ClanTable]} SET Ranking = 0, Wins=0, Losses=0, Point=1000,
                            RankIncrease=0, LastDayRanking=0 WHERE CLID = '$clid'");

            msgbox("Clan reiniciado exitosamente","index.php?do=clans");
            die();
        }
    }
    elseif( isset($_POST['resetallclans']) )
    {
        odbc_exec($connection, "
                        UPDATE {$_CONFIG[ClanTable]} SET Ranking = 0, Wins=0, Losses=0, Point=1000,
                        RankIncrease=0, LastDayRanking=0");

        msgbox("Todos los clanes han sido reiniciados exitosamente","index.php?do=clans");
        die();
    }
    elseif( isset($_POST['removeemblem']) )
    {
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);

        if( $type == "" || $id == "" )
        {
msgbox("Rellene todos los campos","index.php?do=clans");
            die();
        }

        if( $type == 0 )
        {
            $query01 = odbc_exec($connection, "SELECT CLID, Name FROM {$_CONFIG[ClanTable]}(nolock) WHERE Name = '$id'");
        }
        elseif( $type == 1 )
        {
            $query01 = odbc_exec($connection, "SELECT CLID, Name FROM {$_CONFIG[ClanTable]}(nolock) WHERE CLID = '$id'");
        }
        else
        {
            redirect("index.php?do=clans");
            die();
        }

        if( num_rows($query01) != 1 )
        {
            msgbox("El Clan seleccionado no existe","index.php?do=clans");
            die();
        }
        else
        {
            odbc_fetch_row($query01);
            $clid = odbc_result($query01, 1);
            $name = odbc_result($query01, 2);

            odbc_exec($connection, "
                            UPDATE {$_CONFIG[ClanTable]} SET EmblemURL = NULL, EmblemChecksum = EmblemChecksum + 2
                            WHERE CLID = '$clid'");

            msgbox("Emblema borrado","index.php?do=clans");
            die();
        }
    }
    elseif( isset($_POST['changestats']) )
    {
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);
        $wins = clean_sql($_POST['wins']);
        $losses = clean_sql($_POST['losses']);
        $points = clean_sql($_POST['points']);

        if( $type == "" || $id == "" || $wins == "" || $losses == "" || $points == "")
        {
msgbox("Rellene los campos","index.php?do=clans");
            die();
        }

        if( !is_numeric($wins) || !is_numeric($losses) || !is_numeric($points) )
        {
            msgbox("Los Wins, Losses y Points deben ser valores numéricos","index.php?do=clans");
            die();
        }

        if( $type == 0 )
        {
            $query01 = odbc_exec($connection, "SELECT CLID, Name FROM {$_CONFIG[ClanTable]}(nolock) WHERE Name = '$id'");
        }
        elseif( $type == 1 )
        {
            $query01 = odbc_exec($connection, "SELECT CLID, Name FROM {$_CONFIG[ClanTable]}(nolock) WHERE CLID = '$id'");
        }
        else
        {
            redirect("index.php?do=clans");
            die();
        }

        if( num_rows($query01) != 1 )
        {
            msgbox("El Clan seleccionado no existe","index.php?do=clans");
            die();
        }
        else
        {
            odbc_fetch_row($query01);
            $clid = odbc_result($query01, 1);
            $name = odbc_result($query01, 2);

            odbc_exec($connection, "
                            UPDATE {$_CONFIG[ClanTable]} SET Wins = '$wins', Losses = '$losses', Point = '$points'
                            WHERE CLID = '$clid'");

             msgbox("Stats cambiados exitosamente","index.php?do=clans");
            die();
        }
    }
    elseif( isset($_POST['changerank']) )
    {
        $type = clean_sql($_POST['type']);
        $id = clean_sql($_POST['id']);
        $rank = clean_sql($_POST['rank']);

        if( $type == "" || $id == "" )
        {
msgbox("Rellene los campos","index.php?do=clans");
            die();
        }

        if( $rank != 2 && $rank != 9 )
        {
            msgbox("El rango de miembro de clan es inválido","index.php?do=clans");
            die();
        }

        if( $type == 0 )
        {
            $query01 = odbc_exec($connection, "SELECT CID, Name FROM {$_CONFIG[CharTable]}(nolock) WHERE Name = '$id'");
        }
        elseif( $type == 1 )
        {
            $query01 = odbc_exec($connection, "SELECT CID, Name FROM {$_CONFIG[CharTable]}(nolock) WHERE CID = '$id'");
        }
        else
        {
            redirect("index.php?do=clans");
            die();
        }

        if( num_rows($query01) != 1 )
        {
            msgbox("El Miembro de clan seleccionado no existe","index.php?do=clans");
            die();
        }
        else
        {
            odbc_fetch_row($query01);
            $cid = odbc_result($query01, 1);
            $name = odbc_result($query01, 2);

            $query02 = odbc_exec($connection, "SELECT CLID, Grade FROM {$_CONFIG[ClanMembTable]}(nolock) WHERE CID = '$cid'");
            if( num_rows($query02) != 1 )
            {
 msgbox("El personaje seleccionado no es miembro de ningun clan","index.php?do=clans");
                die();
            }

            odbc_fetch_row($query02);
            if( odbc_result($query02, 2) == 1 )
            {
                 msgbox("El Miembro de clan seleccionado es dueño de un clan y no puedes cambiar su rango","index.php?do=clans");
                die();
            }

            odbc_exec($connection, "UPDATE {$_CONFIG[ClanMembTable]} SET Grade = '$rank' WHERE CID = '$cid'");
           msgbox("Se ha cambiado el rango del miembro de clan exitosamente","index.php?do=clans");
            die();
        }


    }

?>
<br />
<div align="center">
<table border="1" style="border-collapse: collapse" id="fetchrank">
<tr><td colspan="2"><b>Generar Ranking de Clanes</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=clans">
<tr>
    <td width="450" align="center">
   Esto va a actalizar el ranking de todos los clanes<br />Puede demorar si hay muchos clanes<br />
    <input type="submit" name="fetchrank" value="Generar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="createclan">
<tr><td colspan="2"><b>Crear Clan</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=clans">
<tr>
    <td width="450">
   Nombre:&nbsp;&nbsp;<input type="text" name="clanname" placeholder="Nombre clan" required/><br /><br />
    Master:&nbsp;&nbsp;
    <select name="type">
    <option value="0">Nombre</option>
    <option value="1">CID</option>
    </select>&nbsp;&nbsp;<input type="text" name="id" placeholder="Nombre" required/>
    <input type="submit" name="createclan" value="Crear" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="deleteclan">
<tr><td colspan="2"><b>Borrar Clan</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=clans">
<tr>
    <td width="450">
    <select name="type">
    <option value="0">Nombre</option>
    <option value="1">CLID</option>
    </select>:&nbsp;&nbsp;<input type="text" name="id" placeholder="Nombre" required/>
    <input type="submit" name="deleteclan" value="Borrar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="resetclan">
<tr><td colspan="2"><b>Reiniciar puntaje de un clan</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=clans">
<tr>
    <td width="450">
    <select name="type">
    <option value="0">Nombre</option>
    <option value="1">CLID</option>
    </select>:&nbsp;&nbsp;<input type="text" name="id" placeholder="Nombre" required/>
    <input type="submit" name="resetclan" value="Reiniciar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="resetallclans">
<tr><td colspan="2"><b>Reiniciar TODOS los clanes</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form name="resetall" method="post" action="index.php?do=clans">
<tr>
    <td width="450" align="center">
   <b>Advertencia:</b> Esto no puede ser revertido<br /><br />
    <input type="submit" name="resetallclans" value="Reiniciar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="removeemblem">
<tr><td colspan="2"><b>Quitar Emblem a un Clan</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=clans">
<tr>
    <td width="450">
    <select name="type">
    <option value="0">Nombre</option>
    <option value="1">CLID</option>
    </select>:&nbsp;&nbsp;<input type="text" name="id" placeholder="Nombre" required/>
    <input type="submit" name="removeemblem" value="Quitar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="changestats">
<tr><td colspan="2"><b>Cambiar Stats de un Clan</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=clans">
<tr>
    <td width="450">
    <select name="type">
    <option value="0">Nombre</option>
    <option value="1">CLID</option>
    </select>:&nbsp;&nbsp;<input type="text" name="id" placeholder="Nombre" required/>
    Wins:&nbsp;&nbsp;<input type="text" name="wins" placeholder="Wins" required/><br /><br />
    Losses:&nbsp;&nbsp;<input type="text" name="losses" placeholder="Losses" required/>&nbsp;&nbsp;Points:&nbsp;&nbsp;
    <input type="text" name="points" placeholder="Puntos" required/>
    <input type="submit" name="changestats" value="Cambiar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
<br />
<table border="1" style="border-collapse: collapse" id="changerank">
<tr><td colspan="2"><b>Cambiar rango de miembro</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<form method="post" action="index.php?do=clans">
<tr>
    <td width="450">
    <select name="type">
    <option value="0">Nombre</option>
    <option value="1">CID</option>
    </select>:&nbsp;&nbsp;<input type="text" name="id" placeholder="Nombre" required/><br /><br />
    <?php echo $_STR[Clan16]; ?>:&nbsp;&nbsp;
    <select name="rank">
    <option value="9">Normal</option>
    <option value="2">Admin</option>
    </select>
    <input type="submit" name="changerank" value="Cambiar" />
    </td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</form>
</table>
</div>
 <br /> <br />