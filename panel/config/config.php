<?
@session_start();
//MSSQL Server configuration
$_MSSQL[Host]               = "149.56.250.241";
$_MSSQL[User]               = "hdjhaker";
$_MSSQL[Pass]               = "Lorianjeremy23";
$_MSSQL[DBNa]               = "sword";



$r = mssql_connect($_MSSQL[Host], $_MSSQL[User], $_MSSQL[Pass]) or die("No se pudo conectar al SQL");
mssql_select_db($_MSSQL[DBNa], $r) or die("La Base de datos no se encuentra.");

// Panel en español
$_CONFIG[Language]  = "espanol";
// Gunz Database Configuration
$_CONFIG[AccountTable]  = "Account";
$_CONFIG[LoginTable]    = "Login";
$_CONFIG[CharTable]     = "Character";
$_CONFIG[CItemTable]    = "CharacterItem";
$_CONFIG[AItemTable]    = "AccountItem";
$_CONFIG[ClanTable]     = "Clan";
$_CONFIG[ClanMembTable] = "ClanMember";
$_CONFIG[ClanLogTable]  = "ClanGameLog";
// Plugins Configuration
// To Disable, set the variable to 0
// To Enable, set the variable to 1
$_CONFIG[CountryBlock]  = 0;        // Add functions to Block / Unblock access to your GunZ Server
//Offline page
$_CONFIG[OfflinePage]       = "";
// Gunz Database Configuration
$_CONFIG[LoginTable]    = "Login";
$_CONFIG[CharTable]     = "Character";
$_CONFIG[ClanTable]    = "Clan";
$_CONFIG[ClanmemberTable]    = "ClanMember";
$color[255] = array(255,153,51); // Administrator
$color[254] = array(255,153,51); // Developer/Gamemaster
$color[253] = array(255,255,255); // Banned
$color[252] = array(255,153,51); // Hidden GM
$color[2]   = array(0,68,255); // User With Jjang
$color[0]   = array(255,255,255); // Normal User
// Panel en español
$_CONFIG[Language]  = "espanol";
// Gunz Database Configuration
$_CONFIG[LoginTable]    = "Login";
$_CONFIG[CharTable]     = "Character";
$_CONFIG[ClanTable]    = "Clan";
$_CONFIG[ClanmemberTable]    = "ClanMember";
?>