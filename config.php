<?
@session_start();

//Mssql config Web HG
$_MSSQL[HostingIP]             	= "23.254.202.56";          //IP Del VPS
$_MSSQL[UserName]               = "hdjhaker";  					 //Nombre de Usuario del SQL Server
$_MSSQL[Password]               = "Lorean8099231412mdj23$$%%";						//Password del SQL Server
$_MSSQL[GunzDB]               	= "AeroGamezN";			   			   //Nombre de la base de datos de la Web


@$r = mssql_connect($_MSSQL[HostingIP], $_MSSQL[UserName], $_MSSQL[Password]) or die(include('error_log/400.php'));
@mssql_select_db($_MSSQL[GunzDB], $r) or die(include('error_log/400.php'));

//Controlar la direccion de la pagina web
$URL_BASE = "http://gunz.aerogamez.com/";
$URL_FORUM = "http://forum.aerogamez.com/";

//Signature Img
$img    =   "img/sing.png";

//Name Server
$NAME_SERVER = "AeroGamez Gunz";


//Metas Etiquetas Config.
$metas_header = 
"	
	<meta name='copyright' content='All rights reserved.'>
	<meta name='description' content='Download and enjoy Gunz The Duel, arming yourself with courage and challenge your opponents!'>
	<meta name='keywords' content='Gunz the duel, Gunz, Juego, Aero, AeroGames, AeroGamers, AeroGamez, UGG, ijji, mailet.'>
	<meta name='rebots' content='index, follow'>
	<meta name='dc.language' content='EN'>
	<meta name='dc.source' content='http://aerogamez.com/'> 
	<meta name='dc.relation' content='http://gunz.aerogamez.com/'>
<meta property='og:image' content='http://aerogamez.com/meta.jpg' />
<meta name='author' content='AeroGamers 2017' />
";

// Agregar un balor para poner la web offline.
$_CONFIG[WebsiteGunzOffline] = ""; // Agregar 0 o nada

?>