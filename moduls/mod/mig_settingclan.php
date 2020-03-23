<?php
if($_SESSION[AID] == ""){

    Messenger_Gunz ("Debe iniciar sesion primero.","index.php");
    die();
}
ModulsTitle("AeroGamez Gunz - subir Emblem Clan");

include('class_include/class_contenido_columna_one.php');

function f() { return "Q29kZWFkbyBwb3IgRGlvc3o="; } 
function Random() { 
    $length = 100; 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz'; 
    $string = "";     

    for ($p = 0; $p < $length; $p++) { 
        $string .= $characters[mt_rand(0, strlen($characters))]; 
    } 

    return $string; 
} 

$clan_query2 = mssql_query("SELECT Password FROM Login(nolock) WHERE UserID = '{$_SESSION[UserID]}'");
$varclanpass   = mssql_fetch_assoc($clan_query2);

                  
$query2 = mssql_query("SELECT Login.UserID, Login.Password, ClanMember.Grade, Clan.EmblemUrl, Clan.Name, Clan.CLID FROM ClanMember INNER JOIN  Clan ON ClanMember.CLID = Clan.CLID INNER JOIN Login INNER JOIN Character ON Login.AID = Character.AID ON ClanMember.CID = Character.CID 
    Where Login.UserID = '$_SESSION[UserID]' and Login.Password = '$varclanpass[Password]' and ClanMember.Grade = '1' "); 
                      

                      if (mssql_num_rows($query2) >= '1'){ ?> 
<div class="mid">
    <div class="module">
        <div class="module">
            <h3>Configuración De Emblemas Clan</h3>
            <form enctype="multipart/form-data" action="" method="POST"> 
            <div class="content">
                <ul class="accounthead">
                    <li>
                        <a class="active">Emblema Clan</a>
                    </li>
                </ul>
                <ul class="registerformupload">
                    <li>
                        <p>Select the images: </p>
                        <span><input name="uploaded" type="file" size="18"></span>
                    </li>
                    <li>
                        <p>Selecciona un clan: </p>
                        <span>
                            <select class="select2" name="clan" required>
                                <? 
                                for($i='';$i < @mssql_num_rows($query2);++$i){ 
                                $row = @mssql_fetch_row($query2); 
                                $ClanName = $row[4]; ?> 
                                <option value="<?=$row[4]?>"><?=$row[4]?></option> 
                                 

                                <? }?> 
                            </select>
                        </span>
                    </li>
                    <li>
                        <p>Captcha:</p>
                        <span><div class="g-recaptcha" data-sitekey="6Lfw6RYUAAAAAFgTMzAOzbNHkVqu6TQwOBvh9hmB"></div></span>
                    </li>
                </ul>
                <span class="centerfix">
                  <input name="submit" type="submit" value="Subir Emblema"> <input class="cancel" value="Cancelar" type="button" onclick="javascript:window.location='index.php';">  
                </span>
            </div>
            </form>
        </div>
    </div>
</div>
<? 
      }else {

        Messenger_Gunz("Error!!! Usted No Tiene Clan","index.php");
        die();

      }

if(isset($_POST[submit])){ 
    
  $emblem = clean($_POST['uploaded']) ; 
  $CLID = clean($_POST['clan']);
  $recaptcha      = clean($_POST['g-recaptcha-response']);


  $secret = "6Lfw6RYUAAAAABu3XJHbt-omtTdSYN1v8MMwTS5C";
  $ip = $_SERVER['REMOTE_ADDR'];
  $var = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$recaptcha&remoteip=$ip");
  $array = json_decode($var, true);
    
    
  $target = "./emblem/"; 
  $target = $target . basename( $_FILES['uploaded']['name']) ; 
  $ok=1; 
  $ext = pathinfo($target); 
  $EXT1 = strtolower($ext['extension']); 
  $f = $ext['basename']; 

  if($EXT1 != "jpg" && $EXT1 != "png" && $EXT1 != "jpeg") { 

      $ok = 0; 

    }else{

      $ok = 1;

    }

   if($_FILES["uploaded"]["size"] > 500000) {

      $ok = 0; 

    }
	
    if ($ok==0) { 

      Messenger_Gunz("Error!!! Tu imagen no ha subido, verifica la extension, el tipo de archivo y minimo la imagen debe pesar 500KB.","index.php?mod=settingclan");
      die();

    }else{ 
        if ($array['success']) {
          $q = mssql_query("SELECT * From Clan Where Name='$CLID'"); 
          $s = mssql_fetch_assoc($q); 
          if(file_exists($s['EmblemUrl'])) { $g = pathinfo($s['EmblemUrl']); unlink("./emblem/".$g['basename']); } 

          if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) { 

            do{ 
                $archivo = Random(); 
                $archivo = $archivo . "."; 
                $archivo = $archivo . $EXT1; 
              } 
            while(file_exists($archivo)); 

            rename("./emblem/".$f,"./emblem/".$archivo); 
            mssql_query ("UPDATE Clan SET EmblemChecksum = EmblemChecksum + 1 WHERE Name = '$CLID'"); 
            mssql_query ("UPDATE Clan SET EmblemUrl = '".$archivo."' WHERE Name = '$CLID'"); 

            Messenger_Gunz("Emblema Subido","index.php");
            die();

        }else{ 

          Messenger_Gunz("Error!!! Pruebe otra ves o intente lo mas tarde.","index.php");
          die();

        }
      }else{
            
            Messenger_Gunz ("Por favor Complete recaptcha para comprobar que no eres un robot.","?mod=settingclan");
            die();

        }
    } 
} 
 

include('class_include/class_contenido_columna_three.php');
?>