<?php
if(!empty($_SESSION['AID'])) {


	if( $_SESSION['AID'] != "" || $_SESSION['UserID'] != "" ) {

		$chkq = mssql_query("SELECT Password FROM Login(nolock) WHERE AID = '" . $_SESSION['AID'] . "' AND UserID = '" . $_SESSION['UserID'] . "'");
						
    	if( mssql_num_rows($chkq) != 1 )
    	{

	        session_unset();
	        session_destroy();
			Messenger_Gunz ("Acceso a cuentas no válido.","index.php");
			die();

		}else{
        	$data = mssql_fetch_row($chkq);
       		if( md5(md5($data[0])) != $_SESSION['Password'] )
        	{
	            session_unset();
	            session_destroy();
				Messenger_Gunz ("Acceso a cuentas no válido.","index.php");
				die();

        	}
    	}
	}
}
if ($_CONFIG[WebsiteGunzOffline] == "") {
//Multi Titulos en los modulos GET
function ParseTitle($content)
{
    if($_SESSION[PageTitle] <> "")
    {
        $r = str_replace("%TITLE%", $_SESSION[PageTitle], $content);
        $_SESSION[PageTitle] = "";
        return $r;
    }else{
        $r = str_replace("%TITLE%", "AeroGamez - Gunz", $content);
        return $r;
    }
}
}else{
//Multi Titulos en los modulos GET
function ParseTitle($content)
{
    if($_SESSION[PageTitle] <> "")
    {
        $r = str_replace("%TITLE%", $_SESSION[PageTitle], $content);
        $_SESSION[PageTitle] = "";
        return $r;
    }else{
        $r = str_replace("%TITLE%", "Mantenimiento- Index", $content);
        return $r;
    }
}
}
ob_start("ParseTitle");

?>
<!doctype html>
<html class="no-js" lang="<?php print clean($_GET["lang"]);?>">
	<head>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-96352008-1', 'auto');
  ga('send', 'pageview');

</script>
<meta name="keywords" content="Gunz, Aerogamers, gunz, online, latinoamerica, españa, español, gratis, gratuito, 2017, venezuela, abierto">
<link rel="alternate" hreflang="es" href="http://gunz.aerogamez.com/" />
<meta name="google-site-verification" content="ab4TyFTyB5O-bmuWDKywJV0uPXn8cZvmyoJ3xEBDRlI" />
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<meta name="googlebot" content="index" />
<meta name="googlebot-news" content="snippet">
<meta name="robots" content="index, follow">
		<meta charset="UTF-8" />
		<title>%TITLE%</title>
		<?php print $metas_header;?><!-- metas-->
		<!-- Style CSS -->
		<link rel="stylesheet" type="text/css" href="<?php print $URL_BASE ?>font-awesome-4.4.0/css/font-awesome.css">
		<link href='<?php print $URL_BASE ?>css/demo.css' media='screen' rel='stylesheet' type='text/css'>
		<link href='<?php print $URL_BASE ?>css/norm.css' media='screen' rel='stylesheet' type='text/css'>
		<link href='<?php print $URL_BASE ?>css/nivo-slider.css' media='screen' rel='stylesheet' type='text/css'>
		<link href='<?php print $URL_BASE ?>css/shadowbox.css' media='screen' rel='stylesheet' type='text/css'>
		<link href='<?php print $URL_BASE ?>css/global.css' media='screen' rel='stylesheet' type='text/css'>
		<link href='<?php print $URL_BASE ?>favicon.png' rel='shortcut icon' type='image/vnd.microsoft.icon'>
		<!-- Scripts -->
		<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<script src="http://code.jquery.com/jquery-1.11.3.js"></script>
		<script type='text/javascript' src='<?php print $URL_BASE ?>js/simple-tabs.js'></script>
		<script type='text/javascript' src='<?php print $URL_BASE ?>js/pene.js'></script>
		<script type='text/javascript' src='<?php print $URL_BASE ?>js/jquery.js'></script>
		<script type='text/javascript' src='<?php print $URL_BASE ?>js/jquery.nivo.slider.pack.js'></script>
		<script type='text/javascript' src='<?php print $URL_BASE ?>js/jquery.elevateZoom.min.js'></script>
		<script type='text/javascript' src='<?php print $URL_BASE ?>js/shadowbox.js'></script>
		<script type='text/javascript' src='<?php print $URL_BASE ?>js/readmore.js'></script>
		<script type='text/javascript' src='<?php print $URL_BASE ?>js/custom.js'></script>
                <script type='text/javascript' src='<?php print $URL_BASE ?>js/js/jscolor.js'></script>
		<script type='text/javascript' src='<?php print $URL_BASE ?>js/bootstrap.min.js'></script>
		<script type='text/javascript' src='<?php print $URL_BASE ?>js/jquery.bpopup.min.js'></script>	
		<style type='text/css'>.readmore-js-toggle, .readmore-js-section { width: 100%; } .readmore-js-section { overflow: hidden; }</style>
		<?php
			if (clean($_GET["lang"])) {

				$_SESSION["lang"] = clean($_GET["lang"]);

			}elseif(!$_SESSION["lang"]) {
	
				$_SESSION["lang"] = "es";

			}
			include ("lang/lang_".$_SESSION["lang"].".php");
		?>
</head>
<body>
<?php
	include('class_content.php');
?>
