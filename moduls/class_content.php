<script>
    function show_popup()
    {
        $('#popup').bPopup();
    }
    window.setTimeout("show_popup()", 500);
</script>
<!-- Top bar -->
<div class="topbar">
	<div class="sw">
		<!--<span class="rightx addmargin-l">
			<a href="#" class="topbtn"><?php print LOGIN_1;?></a>
			<a href="#" class="topbtn"><?php print LOGIN_2;?></a>
		</span>-->
		<!-- Language Select -->
		<ul class="languageselect">
			<span>LOCATION / LANGUAGE</span>
			<li><a href="index.php?lang=en" class="active"><i class="fgi us"></i></a></li>
			<li><a href="index.php?lang=es"><i class="fgi sp"></i></a></li>
			<li><a href="index.php?lang=br"><i class="fgi br"></i></a></li>
		</ul>
	</div>
</div>
<!-- Begin main site -->
<div class="sw">
	<!-- Logo -->
	<div class="logo"><a href="#"><img src="img/assets/logo.png" alt=""></a></div>
	<!-- Social Icons -->
	<ul class="socicons">
		<p>Síguenos en</p>
		<li><a href="#"><i class="socicon fb"></i></a></li>
		<li><a href="#"><i class="socicon yt"></i></a></li>
		<li><a href="#"><i class="socicon tw"></i></a></li>
	</ul>
	<!-- Navigation Links -->
	<nav>
		<ul>
			<li><a href="<?php echo $URL_BASE ?>">inicio</a></li>
	        <?php if ($_SESSION[AID] == "") { ?> <li><a href="<?php echo $URL_BASE ?>?mod=register">Registrarse</a></li> <?}?>
			<li><a href="<?php echo $URL_BASE ?>?mod=rankindividual">Rankings</a></li>
			<li><a href="<?php echo $URL_BASE ?>?mod=downloads">Media y Descargas</a></li>
			<li><a href="<?php echo $URL_BASE ?>?mod=itemshop">Tienda de Articulos</a></li>
			<li><a href="<? print $URL_FORUM;?>" target="_blank">Foro</a></li>
		</ul>
	</nav>	
<div class="mainhead">
	<!-- Account Panel or Login -->
	<script>
	    function Chkbox() {
	        if(document.getElementById('chkbox').checked) {
	        	
	            document.getElementById('chkbox').checked = false;
	        }
	        else {
	            document.getElementById('chkbox').checked = true;
	        }
	    }
	</script>

	<?php 

if($_SESSION[AID] == "") {  

	if(isset($_POST[loginre])) {

	    $user   = 	clean($_POST[userid]);
	    $pass   = 	clean($_POST[pass]);
	    $ip     = 	$_SERVER['REMOTE_ADDR'];

	    // Borrar fails antiguos tablas de esto son  IP, UserID, Time las 3 en varchar(500)
	    mssql_query("DELETE FROM LoginFails WHERE Time < " . (time() - 3600) );

	    // Buscar fails para la ip actual
	    $strikeq = mssql_query("SELECT COUNT(*) as strikes, MAX(Time) as lasttime FROM LoginFails WHERE IP = '$ip'");
	    $strikedata = mssql_fetch_object($strikeq);

	    if( $strikedata->strikes >= 5 && $strikedata->lasttime > ( time() - 900 ) ){

			Messenger_Gunz ("No ha logrado ingresar 5 veces en los últimos 15 minutos.","index.php");
			die();

		}

	    $loginquery = mssql_query("SELECT l.UserID, l.AID, c.UGradeID, l.Password FROM Login(nolock) l INNER JOIN Account(nolock) c ON l.AID = c.AID WHERE l.UserID = '$user' AND l.Password = '$pass'");
	    if(mssql_num_rows($loginquery) == 1){

	        $logindata = mssql_fetch_row($loginquery);

	        $_SESSION[UserID] 		= $logindata[0];
	        $_SESSION[AID] 			= $logindata[1];
	        $_SESSION[UGradeID] 	= $logindata[2];
	        $_SESSION[Password] 	= md5(md5($logindata[3]));

	        $url = ($_SESSION[URL] == "") ? "index.php" : $_SESSION[URL];
	        $_SESSION[URL] = "";

	        Go_URL("$url");

	    }else{

	        mssql_query("INSERT INTO LoginFails (IP, UserID, Time) VALUES ('$ip', '$user', '" . time() . "')");
			Messenger_Gunz ("ID de usuario o contraseña incorrectos.","index.php");
			die();

	    }
	}	

	?>
	<div class="module login">
	    <h3>Entrar</h3>
	    <div class="content">
	        <form id="login" name="loginre" method="POST" action="">
	            <input type="text" minlength="3" maxlength="14" placeholder="Nombre de usuario" name="userid" required style="border-radius: 0px 10px 0px 0px;">
	            <input type="password" minlength="6" maxlength="16" placeholder="Contraseña" id="password" name="pass" required style="border-radius: 0px 0px 0px 10px;"><br>
					<span id="rememberme">
						<input type="checkbox" value="">Recuérdame
					</span>
	            <span class="right"><input type="submit" name="loginre" value="Login"></span>
	            <p>¿Has olvidado tu <a href='?mod=forgotdata'>Usuario</a> / <a href='?mod=forgotdata'> Contraseña?</a></p>
	        </form>
	        <span class="rightx"><a href="?mod=register" class="small-r">Registro Rápido</a></span>
	    </div>
	</div> 
	<?php 
		}else{
					$query2 = mssql_query("SELECT Coins, EventCoins FROM Account(nolock) WHERE AID = '{$_SESSION[AID]}'");
    				$_MEMBER[AccountData]   = mssql_fetch_assoc($query2);
			?>
<script language="javascript">
function UpdateClan()
{
	var Emblem = document.getElementById("imageclan");
	var ClanList = document.getElementById("clanlist");
	var MasterTxt = document.getElementById("clanmaster");
	var ClanLink = document.getElementById("editlink");

	var ClanData = ClanList.value;
	var CData = ClanData.split("-|-");

	MasterTxt.innerHTML = CData[1];
	Emblem.src = "<? print $URL_BASE; ?>emblem/" + CData[3];
	ClanLink.href =  "?mod=infoclan&CLID=" + CData[2];

}
</script>
		<div class="module login">
		    <h3>Bienvenid@, <strong><? print $_SESSION[UserID];?></strong></h3>
		    <div class="content profilemini">
<?
if(CheckIfExistClan($_SESSION[AID]))
{

//href="?mod=infoclan&CLID="
?>
				<form>
		            <a id="editlink" href><img id="imageclan" src="<? print $URL_BASE;?>emblem/noemblem.jpg" /></a>
		            <select onChange="UpdateClan()" id="clanlist" name="selclan">                
		            	<option selected>Seleccione un Clan</option>
<?
$qr = mssql_query("SELECT CID FROM Character(nolock) WHERE AID = '{$_SESSION[AID]}' AND DeleteFlag = 0");
if( mssql_num_rows($qr) > 0 )
{
	while($char = mssql_fetch_assoc($qr))
	{
	         $queryc = mssql_query("SELECT * FROM ClanMember(nolock) WHERE CID = '{$char[CID]}'");

	         if( mssql_num_rows($queryc) > 0 )
	         {
	            $a = mssql_fetch_assoc($queryc);
	            $b = mssql_fetch_assoc(mssql_query("SELECT * FROM Clan(nolock) WHERE CLID = '{$a[CLID]}' AND DeleteFlag = 0"));

	             $_CLAN[Name]       = $b[Name];
	             $_CLAN[Master]     = GetClanMasterByCLID($a[CLID]);
	             $_CLAN[CLID]       = $a[CLID];
	             $_CLAN[Emblem]     = ($b[EmblemUrl] == "") ? "emblem/noemblem.jpg" : $b[EmblemUrl];

	             $info = implode("-|-", $_CLAN);

	             if($_CLAN[Name] <> "")
	                echo "
						<option value = '$info'>{$_CLAN[Name]}</option>
					";
					echo $_CLAN[CLID];
	         }
	    }
}
?>      
		            </select>
		            <a href="?mod=settingclan" class="btn st2">configuración del clan</a>
	            </form>
<?
	}else{
?>
 <p align="center">No Tiene Clan</p>
<?
	}
?>  
		        <ul class="yourcoins">
		        	<li>M: <strong id="clanmaster"></strong></li>
		            <!--<li>Artic Coins: <strong>598</strong></li>-->
		            <li>Event Coins: <strong><?=$_MEMBER[AccountData][EventCoins]?></strong></li>
		            <li>Coins: <strong><?=$_MEMBER[AccountData][Coins]?></strong></li>
		        </ul>
		        <a href="?mod=setting" class="btn st4">Configuración de la Cuenta</a>
		        <a href="?mod=logout" class="btn st4">Salir</a>
		    </div>
		</div> 
				<?}?>
		 <!-- Slider -->
		<div id="slider" class="nivoSlider">
<a href="#" class="nivo-imageLink" ><img src="http://gunz.aerogamez.com/img/assets/slider/lider01.jpg" data-thumb="http://gunz.aerogamez.com/img/assets/slider/lider01.jpg" alt="" style="width: 730px; visibility: hidden;"></a>

<a href="#" class="nivo-imageLink" ><img src="http://gunz.aerogamez.com/img/assets/slider/lider02.jpg" data-thumb="http://gunz.aerogamez.com/img/assets/slider/lider02.jpg" alt="" style="width: 730px; visibility: hidden;"></a>

<a href="#" class="nivo-imageLink" ><img src="http://gunz.aerogamez.com/img/assets/slider/lider03.jpg" data-thumb="http://gunz.aerogamez.com/img/assets/slider/lider03.jpg" alt="" style="width: 730px; visibility: hidden;"></a>
		</div>
	</div>
<?php 
	include('class_moduls.php');
?>