<?php

date_default_timezone_set('America/Los_Angeles');

function connect()
{
    global $_MSSQL;

    $resource = odbc_connect("Driver={SQL Server};Server={$_MSSQL[Host]}; Database={$_MSSQL[DBNa]}", $_MSSQL[User], $_MSSQL[Pass]) or die(odbc_errormsg());
    return $resource;

}

function num_rows($result)
{
    $count = 0;
    while( odbc_fetch_row($result) )
    {
        $count++;
    }
    odbc_fetch_row($result, 0);
    return $count;
}


function clean_sql($sql)
{
    $sql = str_replace("'","''",$sql);
    $sql = preg_replace(sql_regcase("/(from|xp_|execute|exec|sp_executesql|sp_|select|insert|delete|where|drop table|truncate|show tables|#|\*|--|\\\\)/"),"",$sql);
    $sql = strip_tags($sql);
    $sql = addslashes($sql);
    return $sql;
}

function redirect($url)
{
    printf("<meta http-equiv=\"Refresh\" content=\"0; url=%s\">", $url);
    die();
}

/*function writetolog($log){
   /* $date = date("d-m-y - H:i:s");
    $logfile = fopen("logs/log.txt","a+");
    $logtext = "$date - {$_SERVER['REMOTE_ADDR']} $log\r\n";
    fputs($logfile, $logtext);
	fclose($logfile);

    $arch_file = "logs/log.txt";
    if(file_exists($arch_file)){

        $date = date("d-m-y - H:i:s");
        $file = fopen("logs/log.txt", "a+");
        $logtext = "$date - {$_SERVER['REMOTE_ADDR']} $log\r\n";
        fwrite($file, $logtext . PHP_EOL);
        fclose($file);

    }

}*/

function s() { return "PGEgc3R5bGU9ImNvbG9yOiMwOTY7IiBocmVmPSJodHRwOi8vc2Fja2Vyei5ibG9nc3BvdC5jb20v
Ij5QYW5lbCBjcmVhZG8gcG9yIFNhY2tlclo8L2E+"; }
function setmessage($title, $message)
{
    global $_STR;

    $_SESSION[Message] =
    "<br /><table border=\"1\" width=\"60%\" id=\"message\" style=\"border-collapse: collapse\">
	<tr>
		<td><b><i>{$_STR[Msg0]} $title</i></b></td>
	</tr>
	<tr>
		<td>$message</td>
	</tr>
</table><br />";

}

function showmessage()
{
    if( $_SESSION[Message] != "" )
    {
        printf("%s", $_SESSION[Message]);
        unset($_SESSION[Message]);
    }
}

function msgbox($text, $url){
echo "<body  bgcolor='#000000'><script>alert('$text');document.location = '$url'</script></body>"; 
}

function mssql_query_logged($query)
{
    return mssql_query($query);
}

if(!function_exists("alertbox")){
function alertbox($text, $url)
{
    echo "<script>alert('$text');document.location = '$url'</script>";
    die("Javascript disabled");
} }

function login()
{
    global $_STR, $_CONFIG, $connection;
	
    $userid = clean_sql($_POST['userid']);
    $password = clean_sql($_POST['password']);



    $recaptcha = clean_sql($_POST['g-recaptcha-response']);

    if ($recaptcha != ''){

        $secret = "6Lfw6RYUAAAAABu3XJHbt-omtTdSYN1v8MMwTS5C";
        $ip = $_SERVER['REMOTE_ADDR'];
        $var = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$recaptcha&remoteip=$ip");
        $array = json_decode($var, true);

        if ($array['success']) {
        
            if( $userid == "" || $password == "" ){

                    msgbox("Debes de llenar todos los campos en el formulario de acceso", "index.php");
                    redirect("index.php");
                    die();
                }

                $loginquery = odbc_exec($connection, "
                                SELECT a.AID, a.UserID, a.UgradeID FROM {$_CONFIG[AccountTable]} a
                                INNER JOIN {$_CONFIG[LoginTable]} l ON a.AID = l.AID
                                WHERE l.UserID = '$userid' AND l.Password = '$password'
                                ");
                    
                if( num_rows($loginquery) == 1 ){

                    $logindata = odbc_fetch_row($loginquery);
                    $ugradeid = odbc_result($loginquery, 3);
                    if( $ugradeid != 255 ){

                        msgbox("Tu cuenta no tiene permiso para acceder al panel de administración, todo lo que usted haga se guardara y sera revisado por un administrador.", "index.php");
                        redirect("index.php");
                        die();
                    }
                    $_SESSION[AID] = odbc_result($loginquery, 1);
                    $_SESSION[UserID] = odbc_result($loginquery, 2);
                    $_SESSION[UGradeID] = $ugradeid;
                    redirect("index.php");

                }else{
                    
                    msgbox ("Usuario o Contraseña inválidos, Recuerde que todo lo que usted haga sera vigilado.","index.php");
                    die();
                }


        }else{
            
            msgbox ("El recaptcha ha dado un error, Porfavor intenta de nuevo o ponte en contacto con un administrador.","index.php");
            die();

        }
        
    }else{

        msgbox ("Complete el formulario.","index.php");
        die();
    }

}

function logout()
{
    unset($_SESSION[AID], $_SESSION[UserID], $_SESSION[UGradeID]);
	redirect("index.php");
}

function check_ugradeid()
{
    global $_STR, $_CONFIG, $connection;

    $check = odbc_exec($connection, "SELECT UGradeID FROM {$_CONFIG[AccountTable]} WHERE AID = '{$_SESSION[AID]}'");
    odbc_fetch_row($check);
    $cugradeid = odbc_result($check, 1);
    if($cugradeid != 255)
    {
        printf("Tu cuenta no tiene permiso para acceder al panel de administración, todo lo que usted haga se guardara y sera revisado por un administrador.");
        logout();
    }
    else
    {
        $_SESSION[UGradeID] = $check[0 && 2 && 3 && 4 && 5 && 6 && 7 && 8 && 253 && 254 && 255 && 100 && 101 && 102 && 103 && 104 && 105];
    }

}
?>