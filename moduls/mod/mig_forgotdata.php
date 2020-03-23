<?php
ModulsTitle("AeroGamez Gunz - Recuperar Cuenta");


if($_SESSION[UserID] != "") {

    Messenger_Gunz ("Debe cerrar sesion antes de recupetar una cuenta.","index.php");
    die();

}



if( $_GET['paso'] == 3 ){

    if(isset($_POST[submit])){
        
        $userid     = $_SESSION['RstUserID'];
        $email      = clean($_POST[email]);
        $question   = $_SESSION['RstQuestion'];
        $answer     = clean($_POST[answer]);
        $pass1      = clean($_POST[pass1]);
        $pass2      = clean($_POST[pass2]);
        $recaptcha      = clean($_POST['g-recaptcha-response']);

        $secret = "6Lfw6RYUAAAAABu3XJHbt-omtTdSYN1v8MMwTS5C";
        $ip = $_SERVER['REMOTE_ADDR'];
        $var = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$recaptcha&remoteip=$ip");
        $array = json_decode($var, true);


        $errorcount = 0;

    	if ($userid == ""){

            $errorcount++;
            Messenger_Gunz ("Por Favor Introduza Un UserID","?mod=forgotdata");
            die();

        } elseif (mssql_num_rows(mssql_query("SELECT * FROM Account(nolock) WHERE UserID = '$userid'")) != 1){

            $errorcount++;
            Messenger_Gunz ("UserID '$userid' No Existe","?mod=forgotdata");
            die();

        } elseif($email == ""){

            $errorcount++;
            Messenger_Gunz ("Por Favor Introduza Un E-Mail","?mod=forgotdata");
            die();

        } elseif($question == ""){

            $errorcount++;
            Messenger_Gunz ("El UserID '$userid' no tiene pregunta secreta","?mod=forgotdata");
            die();

        } elseif($answer == ""){

            $errorcount++;
            Messenger_Gunz ("Por Favor Introduza Una Respuesta Secreta","?mod=forgotdata");
            die();

        } elseif (ereg('[^A-Za-zñÑ0-9_]{1,64}', $answer)) {

            $errorcount++;
            Messenger_Gunz ("La Respuesta secreta tiene caracteres especiales, intente solo numeros y letras.","?mod=forgotdata");
            die();

        } elseif (strlen($pass1) < 6){

            $errorcount++;
            Messenger_Gunz ("Por Favor Introduzca Un Contraseña Mas Larga (6 a 14 Caracteres)","?mod=forgotdata");
            die();

        } elseif (ereg('[^A-Za-zñÑ0-9_]{1,64}', $pass1)){

            $errorcount++;
            Messenger_Gunz ("La Contraseña tiene caracteres especiales, intente solo numeros y letras.","?mod=forgotdata");
            die();

        } elseif($pass1 != $pass2){

            $errorcount++;
            Messenger_Gunz ("Las Passwords No Coinciden","?mod=forgotdata");
            die();

        } elseif($errorcount == 0){

            if ($array['success']) {

                $rs1 = mssql_query("SELECT * FROM Account(nolock) WHERE UserID = '$userid' AND Email = '$email' AND Question = '$question' AND Answer = '$answer'");

                if(mssql_num_rows($rs1) != 1){

                    Messenger_Gunz ("Informacion Incorrecto. Verifique si el Correo o respuesta secreta sean correctos.","?mod=forgotdata");
                    die();

                }else{

                    $pass1 = substr(($pass1), 0, 18);
            	    mssql_query("UPDATE Login SET Password = '$pass1' WHERE UserID = '$userid'");
                    Messenger_Gunz ("Su Contraseña fue cambiada satisfactoriamente. Bienvenido otra ves, <b>$userid</b> :)","index.php");
                    die();
                }

            }else{
            
                Messenger_Gunz ("Por favor Complete recaptcha para comprobar que no eres un robot.","?mod=editdata");
                die();

            }
        }

    }else{

        Go_URL("?mod=forgotdata");
    }




}elseif($_GET['paso'] == 2){

    if(isset($_POST[submit])) {
        
        $userid         = clean($_POST[userid]);
        $recaptcha      = clean($_POST['g-recaptcha-response']);

        $secret = "6Lfw6RYUAAAAABu3XJHbt-omtTdSYN1v8MMwTS5C";
        $ip = $_SERVER['REMOTE_ADDR'];
        $var = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$recaptcha&remoteip=$ip");
        $array = json_decode($var, true);


        $query005 = mssql_query("SELECT * FROM Account(nolock) WHERE UserID = '$userid'");

        $RstData = mssql_fetch_assoc($query005);

        $_SESSION['RstUserID'] = $userid;

        $_SESSION['RstQuestion'] = $RstData['Question'];


        $_SESSION['RstQuess'] = $RstData['Question'];

        if ($_SESSION['RstQuess'] == 1) {

            $_SESSION['RstQuesss'] = "¿Cual es tu ciudad de nacimiento?";
        } elseif ($_SESSION['RstQuess'] == 2) {

            $_SESSION['RstQuesss'] = "¿Como se llama tu madre?";
        } elseif ($_SESSION['RstQuess'] == 3) {

            $_SESSION['RstQuesss'] = "¿Como se llama tu padre?";
        } elseif ($_SESSION['RstQuess'] == 4) {

            $_SESSION['RstQuesss'] = "¿Como se llama tu primera mascota?";
        } elseif ($_SESSION['RstQuess'] == 5) {

            $_SESSION['RstQuesss'] = "¿Como se llama tu primer personaje en gunz?";
        } elseif ($_SESSION['RstQuess'] == 6) {

            $_SESSION['RstQuesss'] = "¿En que Año comenzaste a jugar Gunz?";
        } elseif ($_SESSION['RstQuess'] == 7) {

            $_SESSION['RstQuesss'] = "¿Cómo conociste el juego Gunz?";
        } elseif ($_SESSION['RstQuess'] == 8) {

            $_SESSION['RstQuesss'] = "Pregunta Secreta";
        }else{
            $_SESSION['RstQuesss'] = "No tiene Pregunta Secreta";
        }


        if ($array['success']) {

            if($userid == ""){

                Messenger_Gunz ("Por Favor Introduzca un UserID","?mod=forgotdata");
                die();

            } elseif (strlen($userid) < 3){

                Messenger_Gunz ("Error el usuario que debe ingresar debe tener (3 a 14 characters min). Por favor comoniquese con un administrador para mas respuestas.","?mod=forgotdata");
                die();

            } elseif (strlen($userid) > 14){   

                Messenger_Gunz ("Error el usuario que a ingresado a sobrepasado el limine de characters ( 14 max). Por favor comoniquese con un administrador para mas respuestas.","?mod=forgotdata");
                die();

            } elseif (mssql_num_rows($query005) == 0){

                Messenger_Gunz ("UserID <b>$userid</b> No Existe","?mod=forgotdata");
                die();

            } elseif($_SESSION['RstQuestion'] == ""){

                Messenger_Gunz ("UserID <b>$userid</b> No tiene pregunta Secreta","?mod=forgotdata");
                die();

            }
        }else{
            
                Messenger_Gunz ("Por favor Complete recaptcha para comprobar que no eres un robot.","?mod=editdata");
                die();

        }

        include('class_include/class_contenido_columna_one.php');
?>
<div class="mid">
    <div class="module">
        <div class="module">
            <h3>Recuperar Cuenta</h3>
            <div class="content">
                <form action="?mod=forgotdata&paso=3" method="POST" name="forgotdata" id="Forgot" class="inputform">
                    <ul class="account">
                        <li> Ingrese el correo electrónico donde está registrada su cuenta: </li>
                    </ul>
                    <ul class="registerform">            
                        <li>
                            <p>Nombre de Usuario: </p>
                            <span><b><?=$userid?></b></span>
                        </li>
                        <li>
                            <p>Correo: </p>
                            <span><input type="text" maxlength="50" name="email" placeholder="<?php print REGISTRO_8;?>" required></span>
                        </li>
                        <li>
                            <p>Pregunta Secreta:</p>
                            <span><?=$_SESSION['RstQuesss']?></span>
                        </li>
                        <li>
                            <p>Respuesta Secreta:</p>
                            <span><input type="text" minlength="3" maxlength="30" name="answer" placeholder="<?php print REGISTRO_13;?>" required></span>
                        </li>
                        <li class="account">
                            <li> Ingrese el correo electrónico donde está registrada su cuenta: </li>
                        </li>
                        <li>
                            <p>Contraseña:</p>
                            <span><input type="password" minlength="6" maxlength="16" name="pass1" placeholder="<?php print REGISTRO_5;?>" required></span>
                        </li>
                        <li>
                            <p>Repetir Contraseña:</p>
                            <span><input type="password" minlength="6" maxlength="16" name="pass2" placeholder="<?php print REGISTRO_19;?>" required></span>
                        </li>
                        <li>
                            <p>Captcha:</p>
                            <span><div class="g-recaptcha" data-sitekey="6Lfw6RYUAAAAAFgTMzAOzbNHkVqu6TQwOBvh9hmB"></div></span>  
                        </li>
                    </ul>
                    <ul class="centerfix">
                        <input type="submit" name="submit" value="Guardar"> <input onclick="javascript:window.location='index.php';" type="button" class="cancel" value="Cancelar">        
                    </ul>
                </form>
            </div>
        </div>
    </div>
</div>
<?
        include('class_include/class_contenido_columna_three.php');

    }else{
         Go_URL("?mod=forgotdata");
    }

}else{
    include('class_include/class_contenido_columna_one.php');
?>
<div class="mid">
    <div class="module">
        <div class="module" xmlns="http://www.w3.org/1999/html">
        <h3>Recuperar Cuenta</h3>
            <div class="content">
                <form action="?mod=forgotdata&paso=2" method="POST" name="forgotdata" id="Forgot" class="inputform">
                    <ul class="account">
                        <li> Ingrese el correo electrónico donde está registrada su cuenta: </li>
                    </ul>
                    <ul class="registerform">            
                        <li>
                            <p>Nombre de Usuario: </p>
                            <span><input minlength="3" maxlength="14" type="Text" name="userid" placeholder="Nombre de usuario" value="" required></span>
                        </li>
                        <li>
                            <p>Captcha:</p>
                            <span><div class="g-recaptcha" data-sitekey="6Lfw6RYUAAAAAFgTMzAOzbNHkVqu6TQwOBvh9hmB"></div></span>  
                        </li>
                    </ul>
                    <ul class="centerfix">
                        <input type="submit" name="submit" value="Aceptar"> <input onclick="javascript:window.location='index.php';" type="button" class="cancel" value="Cancelar">        
                    </ul>
                </form>
            </div>
        </div>                
    </div>
</div>
<?
include('class_include/class_contenido_columna_three.php');

}

?>





