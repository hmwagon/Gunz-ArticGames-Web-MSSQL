<?php

if($_SESSION[AID] == ""){

    Messenger_Gunz ("Debe iniciar sesion primero","index.php");
    die();
}


if(isset($_POST[Checksubmit]))
{
    $pass 			=   clean($_POST[CheckPass]);
    $ip     		= 	$_SERVER['REMOTE_ADDR'];
    $recaptcha      = clean($_POST['g-recaptcha-response']);

    $secret = "6Lfw6RYUAAAAABu3XJHbt-omtTdSYN1v8MMwTS5C";
    $ip = $_SERVER['REMOTE_ADDR'];
    $var = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$recaptcha&remoteip=$ip");
    $array = json_decode($var, true);

    // Borrar fails antiguos tablas de esto son  IP, UserID, Time las 3 en varchar(500)
    mssql_query("DELETE FROM LoginFails WHERE Time < " . (time() - 3600) );

    // Buscar fails para la ip actual
    $strikeq = mssql_query("SELECT COUNT(*) as strikes, MAX(Time) as lasttime FROM LoginFails WHERE IP = '$ip'");
    $strikedata = mssql_fetch_object($strikeq);

    if( $strikedata->strikes >= 5 && $strikedata->lasttime > ( time() - 900 ) ){

		Messenger_Gunz ("You have failed to login 5 times in the last 15 minutes","?mod=setting");
		die();

	}


    if ($array['success']) {

    	if(mssql_num_rows(mssql_query("SELECT * FROM Login(nolock) WHERE UserID = '{$_SESSION[UserID]}' AND Password = '$pass'")) == 1) {

        	$_SESSION[Modify] = $_SESSION[AID];

    	}else{

	        $_SESSION[Modify] = 0;
	        mssql_query("INSERT INTO LoginFails (IP, UserID, Time) VALUES ('$ip', '$_SESSION[UserID]', '" . time() . "')");
	        Messenger_Gunz("PorFavor Verifique La Contraseña.","?mod=editdata");
	        die();

    	}
    }else{
            
            Messenger_Gunz ("Por favor Complete recaptcha para comprobar que no eres un robot.","?mod=editdata");
            die();

        }
}

include('class_include/class_contenido_columna_one.php');

if($_SESSION[Modify] != $_SESSION[AID])
{
	ModulsTitle("AeroGamezGunz - Verificacion De Contraseña");
?>
<div class="mid">
    <div class="module">
        <div class="module">
            <h3>Verificacion De Contraseña</h3>
            <div class="content">
            	<form method="POST" action="index.php?mod=editdata" name="editacc" class="inputform">
            		<ul class="account">
                        <li>Porfavor, Coloca tu Contraseña para confirmar la cuenta.</li>
                    </ul>
            		<ul class="registerform">
                        <li>
                        	<p>Contraseña:</p>
                        	<span><input name="CheckPass" minlength="6" maxlength="16" placeholder="Introdusca una contraseña" value="" type="password" required></span>
                        </li>
                        <li>
                            <p>Captcha:</p>
                            <span><div class="g-recaptcha" data-sitekey="6Lfw6RYUAAAAAFgTMzAOzbNHkVqu6TQwOBvh9hmB"></div></span>  
                        </li>
  					</ul>
  					<span class="centerfix">
                        <input name="Checksubmit" type="submit" value="submit"> <input class="cancel" value="Cancelar" type="button" onclick="javascript:window.location='index.php';">  
                    </span>
            	</form>
            </div>
        </div>
    </div>
</div>
<?php }else{

	ModulsTitle("AeroGamez Gunz - Editar Cuenta");

	if(isset($_POST[submit]) && $_SESSION[Modify] == $_SESSION[AID]) {

	    $pass[0]        = clean($_POST[pass1]);
	    $pass[1]        = clean($_POST[pass2]);
	    //$email          = clean($_POST[email]);
		$CountryID          = clean($_POST[CountryID]);
	    $question       = clean($_POST[Question]);
	    $answer         = clean($_POST[Answer]);
	    $recaptcha      = clean($_POST['g-recaptcha-response']);

	    $secret = "6Lfw6RYUAAAAABu3XJHbt-omtTdSYN1v8MMwTS5C";
    	$ip = $_SERVER['REMOTE_ADDR'];
    	$var = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$recaptcha&remoteip=$ip");
    	$array = json_decode($var, true);


	    if($pass[0] <> $pass[1]){

	    	Messenger_Gunz("La contraseña no Existe","?mod=editdata");
	    	die();

	    }else{

	    	if ($array['success']) {	

	    		mssql_query("UPDATE Account SET Email = '$email' WHERE AID = '{$_SESSION[AID]}'");

				mssql_query("UPDATE Account SET CountryID = '$CountryID' WHERE AID = '{$_SESSION[AID]}'");

		        if($_POST[C1] == "ON")
		        {
			                  
			    mssql_query("UPDATE Login SET Password = '".$pass[0]."' WHERE AID = '{$_SESSION[AID]}'");
		            $_SESSION['Password'] = $pass[0];
		        }
		        if($_POST[C2] == "ON")
		        {
		            mssql_query("UPDATE Account SET Question = '$question', Answer = '$answer' WHERE AID = '{$_SESSION[AID]}'");
		        }
		        Messenger_Gunz("Datos Actualizados Perfectamente","?mod=setting");

	    	}else{
            
            	Messenger_Gunz ("Por favor Complete recaptcha para comprobar que no eres un robot.","?mod=editdata");
            	die();

        	}
	    }
	}else{

	    $r = mssql_fetch_assoc(mssql_query("SELECT * FROM Account(nolock) WHERE AID = {$_SESSION[AID]}"));
	    $a = mssql_fetch_assoc(mssql_query("SELECT * FROM Login(nolock) WHERE AID = {$_SESSION[AID]}"));

	    $_MEMBER[UserID]        = $r[UserID];
	    $_MEMBER[EMail]         = $r[Email];
	    $_MEMBER[Question]      = $r[Question];
	    $_MEMBER[Answer]        = $r[Answer];
		$_MEMBER[CountryID]     = $r[CountryID];

		
		switch($_MEMBER[CountryID]){
			case 0:
				$COUNTRY_PAISES = "Estados Unidos";
				break;
			case 1:
				$COUNTRY_PAISES = "Republica Dominicana";
				break;
			case 2:
				$COUNTRY_PAISES = "Peru";
				break;
			case 3:
				$COUNTRY_PAISES = "Venezuela";
				break;
			case 4:
				$COUNTRY_PAISES = "Argentina";
				break;	
			case 5:
				$COUNTRY_PAISES = "Australia";
				break;	
			case 6:
				$COUNTRY_PAISES = "Bolivia";
				break;		
			case 7:
				$COUNTRY_PAISES = "Brasil";
				break;		
			case 8:
				$COUNTRY_PAISES = "Canada";
				break;	
			case 9:
				$COUNTRY_PAISES = "Chile";
				break;
			case 10:
				$COUNTRY_PAISES = "China";
				break;	
			case 11:
				$COUNTRY_PAISES = "Colombia";
				break;	
			case 12:
				$COUNTRY_PAISES = "Costarica";
				break;		
			case 13:
				$COUNTRY_PAISES = "Ecuador";
				break;	
			case 14:
				$COUNTRY_PAISES = "El Salvador";
				break;	
			case 15:
				$COUNTRY_PAISES = "España";
				break;
			case 16:
				$COUNTRY_PAISES = "Honduras";
				break;
			case 17:
				$COUNTRY_PAISES = "Israel";
				break;
			case 18:
				$COUNTRY_PAISES = "Italia";
				break;
			case 19:
				$COUNTRY_PAISES = "Japon";
				break;
			case 20:
				$COUNTRY_PAISES = "Maxico";
				break;
			case 21:
				$COUNTRY_PAISES = "Nicaragua";
				break;
			case 22:
				$COUNTRY_PAISES = "Panama";
				break;
			case 23:
				$COUNTRY_PAISES = "Paraguay";
				break;
			case 24:
				$COUNTRY_PAISES = "Portugal";
				break;
			case 25:
				$COUNTRY_PAISES = "Uruguay";
				break;
			case 26:
				$COUNTRY_PAISES = "Vietnam";
				break;
			case 27:
				$COUNTRY_PAISES = "Korea";
				break;
			case '':
				$COUNTRY_PAISES = "No Tiene pais";
				break;
		}

        if ($_MEMBER[Question] == 1) {

            $QuestionIF = "¿Cual es tu ciudad de nacimiento?";
        } elseif ($_MEMBER[Question] == 2) {

            $QuestionIF = "¿Como se llama tu madre?";
        } elseif ($_MEMBER[Question] == 3) {

            $QuestionIF = "¿Como se llama tu padre?";
        } elseif ($_MEMBER[Question] == 4) {

            $QuestionIF = "¿Como se llama tu primera mascota?";
        } elseif ($_MEMBER[Question] == 5) {

            $QuestionIF = "¿Como se llama tu primer personaje en gunz?";
        } elseif ($_MEMBER[Question] == 6) {

            $QuestionIF = "¿En que Año comenzaste a jugar Gunz?";
        } elseif ($_MEMBER[Question] == 7) {

            $QuestionIF = "¿Cómo conociste el juego Gunz?";
        } elseif ($_MEMBER[Question] == 8) {

            $QuestionIF = "Pregunta Secreta";
        }else{

        	Messenger_Gunz("Error!!!!  No tiene Pregunta Secreta","?mod=setting");
        }
	}


?>

<div class="mid">
    <div class="module">
        <div class="module">
            <h3>Editar Cuenta</h3>
            <div class="content">
            	<form method="POST" action="index.php?mod=editdata" name="editacc" class="inputform">
            		<ul class="registerform">
            			<li>
            				<p>UserID: </p>
            				<span><?=$_MEMBER[UserID]?></span>
            			</li>
            			<li>
            				<p>Editar Contraseña: </p>
            				<span><input type="checkbox" name="C1" value="ON" onclick="document.editacc.pass1.disabled = !document.editacc.pass1.disabled; document.editacc.pass2.disabled = !document.editacc.pass2.disabled; document.editacc.pass3.disabled = !document.editacc.pass3.disabled;"></span>
            			</li>
            			<li>
            				<p>Nueva Contraseña: </p>
            				<span><input  placeholder="(6 Caracteres min y max 16)" minlength="6" maxlength="16" disabled type="password" name="pass1" required></span>
            			</li>
            			<li>
            				<p>Repite la Contraseña: </p>
            				<span><input  placeholder="(6 Caracteres min y max 16)" minlength="6" maxlength="16" disabled type="password" name="pass2" required></span>
            			</li>
            			<li>
            				<ul class="account2">
                        		<li>El Correo electronico no se puede cambiar por motivos de seguridad.</li>
                    		</ul>
            			</li>
            			<li>
            				<p>E-Mail: </p>
            				<span><input disabled type="text"  placeholder="*******<?=substr($_MEMBER[EMail], -13)?>"></span>
            			</li>
						<li>
							<p>Pais: </p>
							<span><?  echo $COUNTRY_PAISES; ?></span>
						</li>
						 <li>
            				<p>Cambiar pais:</p>
            				<span>
								<select  name="CountryID" required>
									<option value="" selected>Selecciona otro pais</option>
									<option value="0">Estados Unidos</option>
									<option value="1">Republica Dominicana</option>
									<option value="2">Peru</option>
									<option value="3">Venezuela</option>
									<option value="4">Argentina</option>
									<option value="5">Australia</option>
									<option value="6">Bolivia</option>
									<option value="7">Brasil</option>
									<option value="8">Canada</option>
									<option value="9">Chile</option>
									<option value="10">China</option>
									<option value="11">Colombia</option>
									<option value="12">Costarica</option>
									<option value="13">Ecuador</option>
									<option value="14">El Salvador</option>
									<option value="15">España</option>
									<option value="16">Honduras</option>
									<option value="17">Israel</option>
									<option value="18">Italia</option>
									<option value="19">Japon</option>
									<option value="20">Mexico</option>
									<option value="21">Nicaragua</option>
									<option value="22">Panama</option>
									<option value="23">Paraguay</option>
									<option value="24">Portugal</option>
									<option value="25">Uruguay</option>
									<option value="26">Vietnam</option>
									<option value="27">Korea</option>
                                </select>
							</span>
            			</li>
            			<li>
            				<ul class="account2">
                        		<li>La Pregunta secreta y la Respuesta secreta son usados para recuperar tu Cuenta en Caso de que la Olvides</li>
                    		</ul>
            			</li>
            			<li>
            				<p>Editar P/R: </p>
            				<span><input type="checkbox" name="C2" value="ON" onclick="document.editacc.question.disabled = !document.editacc.question.disabled; document.editacc.answer.disabled = !document.editacc.answer.disabled; "></span>
            			</li>
            			<li>
            				<p>P</p>
            				<span>
	            				<select disabled name="question" required>
	                                    <option value="" selected><? print $QuestionIF; ?></option>
	                                    <option value="1">¿Cual es tu ciudad de nacimiento?</option>
	                                    <option value="2">¿Como se llama tu madre?</option>
	                                    <option value="3">¿Como se llama tu padre?</option>
	                                    <option value="4">¿Como se llama tu primera mascota?</option>
	                                    <option value="5">¿Como se llama tu primer personaje en gunz?</option>
	                                    <option value="6">¿En que Año comenzaste a jugar Gunz?</option>
	                                    <option value="7">¿Cómo conociste el juego Gunz?</option>
	                                    <option value="8">Pregunta Secreta</option>
                                </select>
            				</span>
            			</li>
            			<li>
            				<p>R</p>
            				<span><input disabled minlength="3" maxlength="30" type="text" name="answer" required></span>
            			</li>
            			<li>
                            <p>Captcha:</p>
                            <span><div class="g-recaptcha" data-sitekey="6Lfw6RYUAAAAAFgTMzAOzbNHkVqu6TQwOBvh9hmB"></div></span>
                        </li>
            		</ul>
            		<span class="centerfix">
                        <input name="submit" type="submit" value="Guardar"> <input class="cancel" value="Cancelar" type="button" onclick="javascript:window.location='index.php';">  
                    </span>
            	</form>
            </div>
        </div>
    </div>
</div>
<?	
}

    include('class_include/class_contenido_columna_three.php');
?> 