<?php
    if( !ereg("index.php", $_SERVER['PHP_SELF']) )
    {
        header("Location: index.php");
        die();
    }
	
if( !session_start() )
{
    session_start();
}
require "config/config.php";
include "functions.php";
include "config/sql_check.php";

$connection = connect();
?>
<!DOCTYPE  html>
<head>
<title>Panel AeroGamers - STAFF</title> 
<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
<script src="js/hideshow.js" type="text/javascript"></script>
<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<link href="favicon.png" rel="shortcut icon" />
	
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
<script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>
<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
</head>
<body>
<?php

if($_SESSION['AID'] == "" )
{
    if( isset($_POST['login']) )
    {
        login();
    }
    else
    {

?>
    <div Align="center">
	<br /><br /><br />
	<div Align="center"><img src="logo.png" /></div>
    <form name="login" method="POST" action="index.php">
        <table class="table" width="30%" align="center" id="login" style="border-collapse: collapse">
               <b>Panel AeroGamers Gunz</b>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td width="40%" align="center"><b>Usuario:</b></td>
                <td align="center"><input class="barddd" type="text" name="userid" placeholder="Nombre de Usuario" maxlength="25" required /></td>
            </tr>
            <tr>
                <td align="center"><b>Contraseña:</b></td>
                <td align="center"><input class="barddd" type="password" name="password" required="required" placeholder="Contraseña" maxlength="16" /></td>
            </tr>
            <tr>
                <td align="center"><b>Completa:</b></td>
                <td><div class="g-recaptcha" data-sitekey="6Lfw6RYUAAAAAFgTMzAOzbNHkVqu6TQwOBvh9hmB" data-theme="dark"></div></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                <input type="submit" name="login" value="Iniciar sesion" />
                </td>
            </tr>
        </table>
    </form>
    </div>

<?php
    }
}

if( $_SESSION['AID'] != "" )
{
    check_ugradeid();

    switch( clean_sql($_GET['do']))
    {
	case "account":
            $includefile = "Aero/account.php";
            break;
	case "topclan":
            $includefile = "Aero/topclan.php";
            break;			
	case "login":
            $includefile = "Aero/login.php";
            break;
	case "character":
            $includefile = "Aero/character.php";
            break;
        case "search":
            $includefile = "Aero/search.php";
            break;
		case "buscarid":
            $includefile = "Aero/buscarid.php";
            break;
        case "accounts":
            $includefile = "Aero/accounts.php";
            break;
        case "characters":
            $includefile = "Aero/characters.php";
            break;
        case "clans":
            $includefile = "Aero/clans.php";
            break;
        case "banip":
            $includefile = "Aero/banip.php";
            break;
        case "banuser":
            $includefile = "Aero/banuser.php";
            break;
        case "evcoins":
            $includefile = "Aero/evcoins.php";
            break;
		case "coins":
            $includefile = "Aero/coins.php";
            break;
		case "topugrade";
			$includefile = "Aero/topugrades.php";
			break;
        case "kcoins":
            $includefile = "Aero/kcoins.php";
            break;
		case "news":
            $includefile = "Aero/news.php";
          	break;
		case "enews":
            $includefile = "Aero/enews.php";
            break;			
        case "logout":
            logout();
            break;
        default:
            $includefile = "Aero/panel.php";
            break;

    }
?>
<script>
window.onload = function(){killerSession();}
 
function killerSession(){
setTimeout("window.open('/index.php?do=logout','_top');",900000);
}
</script>
<header id="header"><hgroup><h1 class="site_title"><a href="index.php">Administrador V5</a></h1></hgroup></header>
<section id="secondary_bar"><div class="user"><p><?php echo $_SESSION[UserID]; ?> (<a href="">0 Mensajes</a>)</p></div></section>

<aside id="sidebar" class="column">	
<form class="quick_search"><input type="text" value="Buscador de Personajes" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;" /></form>
		
<hr/>
<h3>General</h3>
<ul class="toggle">
<li class="icn_new_article"><a href="index.php">Home</a></li>
<li class="icn_edit_article"><a href="index.php?do=account">Listas de cuentas</a></li>
<li class="icn_categories"><a href="index.php?do=topclan">Top Clanes</a></li>
<li class="icn_categories"><a href="index.php?do=topugrade">Top UpgradeInfo</a></li>
<li class="icn_view_users"><a href="index.php?do=character">Personajes</a></li>
<li class="icn_jump_back"><a href="index.php?do=login">Cuentas Login</a></li>
<li class="icn_audio"><a href="index.php?do=news">Poner Noticia</a></li>
<li class="icn_jump_back"><a href="index.php?do=enews">Eliminar Noticia</a></li>
<li class="icn_security"><a href="index.php?do=banip">BanniarIP</a></li>
<li class="icn_security"><a href="index.php?do=banuser">BanniarID</a></li>
</ul>


<h3>Tipos Coins</h3>
<ul class="toggle"> 
<li class="icn_view_users"><a href="index.php?do=coins">Coins</a></li>
<li class="icn_view_users"><a href="index.php?do=evcoins">EventCoins</a></li>
</ul>		
                      
<h3>Accounts</h3>
<ul class="toggle"> 
<li class="icn_jump_back"><a href="index.php?do=search">Buscar</a></li>
<li class="icn_jump_back"><a href="index.php?do=buscarid">Buscar Cuentas</a></li>
<li class="icn_jump_back"><a href="index.php?do=accounts">Manejar Cuentas</a></li>
<li class="icn_jump_back"><a href="index.php?do=characters">Manejar Personajes</a></li>
<li class="icn_jump_back"><a href="index.php?do=clans">Manejar Clanes</a></li>
<li class="icn_logou"><a href="index.php?do=logout">Finalizar Cpanel</a></li>
</ul>
<?php
 if( $_CONFIG[CountryBlock] == 1 )
 {
 ?>
<?php
}
?>
<footer><hr /><p><strong>Copyright &copy; 2013 Website</strong></p><p><a href="http://AeroGamez.net"> AeroGamez.net</a></p></footer>
</aside><!-- end of sidebar -->

<section id="main" class="column"><h4 class="alert_info">Hola Bienvenido al panel de administrador recuerde que todo estara Siendo vigilado.</h4><article><div><?php include $includefile; ?></div></article></section>
<span>
<?php
}
?>
</span>
</body>
</html>