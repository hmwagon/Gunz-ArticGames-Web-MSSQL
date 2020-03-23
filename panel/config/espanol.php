<?php

    if( !ereg("index.php", $_SERVER['PHP_SELF']) )
    {
        header("Location: index.php");
        die();
    }
// Modulo Login
$_STR[Login4]   = "Debes de llenar todos los campos en el formulario de acceso";
$_STR[Login5]   = "Tu cuenta no tiene permiso para acceder al panel de administraci�n, todo lo que usted haga se guardara y sera revisado por un administrador.";
$_STR[Login6]   = "Usuario o Contrase�a inv�lidos";

// SACKER s4cker@hotmail.com
$_STR[SACKER0]    = "Men� del Panel";
$_STR[SACKER1]    = "Bienvenido %s!";
$_STR[SACKER2]    = "Home";
$_STR[SACKER3]    = "Admin Chat";
$_STR[SACKER4]    = "Tabla ASCII";
$_STR[SACKER5]    = "Buscar";
$_STR[SACKER6]    = "Manejar Cuentas";
$_STR[SACKER7]    = "Manejar Personajes";
$_STR[SACKER8]    = "Finalizar Sesi&oacute;n";
$_STR[SACKER9]    = "Manejar Clanes";
$_STR[SACKER10]   = "Bloqueo de Pa�ses";
$_STR[SACKER11]   = "Lista de Cuentas";
$_STR[SACKER15]   = "Agregar a ItemShop";
$_STR[SACKER16]   = "Agregar a EventShop";
$_STR[SACKER17]   = "Banned Ip";
$_STR[SACKER18]   = "Banear Usuario";
$_STR[SACKER19]   = "Dar Event Coins";
$_STR[SACKER20]   = "Cuentas login";
$_STR[SACKER21]   = "Personajes";
$_STR[SACKER22]   = "Dar Coins";
$_STR[SACKER23]   = "Poner Noticias";
$_STR[SACKER24]	= "Agregar a DonatorShop";
$_STR[SACKER25]	= "Dar DonatorCoins";
$_STR[SACKER26]	= "Agregar Set Shop";
$_STR[SACKER27]	= "Dar Name Color";
$_STR[SACKER28]	= "Eliminar Noticia";
$_STR[SACKER29]	= "Buscar Cuenta con Coins";
$_STR[SACKER30]	= "Top DonatorCoins";
$_STR[SACKER31]	= "Top EventCoins";
$_STR[SACKER32] = "Top Clan";
$_STR[SACKER33] = "Quitar ItemShop";
$_STR[SACKER34] = "Top UGradeID";
$_STR[SACKER35] = "Registro User";
// Sistema de Mensajes
$_STR[Msg0]     = "Mensaje de:";
$_STR[Msg1]     = "Debes llenar todos los campos";

// Formulario Login
$_STR[Login0]   = "Login del Staff";
$_STR[Login1]   = "Usuario";
$_STR[Login2]   = "Contrase&ntilde;a";
$_STR[Login3]   = "Acceder";

// Inicio
$_STR[Home0]    = "Bienvenido al panel de SackerZ";
$_STR[Home1]    = "Panel creado por Sacker<br />";
$_STR[Home2]    = "Informaci&oacute;n del Servidor";
$_STR[Home3]    = "Cuentas Creadas: ";
$_STR[Home4]    = "<br /> Personajes Creados: ";
$_STR[Home5]    = "<br /> Jugadores Online: ";
$_STR[Home6]    = "Estado";
$_STR[Home7]    = "Nombre";
$_STR[Home8]    = "<br /> Clanes Creados: ";

// NotePad
$_STR[Notepad0] = "Envia una Nota";
$_STR[Notepad1] = "Nota:";
$_STR[Notepad2] = "Enviar Nota";
$_STR[Notepad3] = "Ver Notas";

// Ascii
$_STR[Ascii1]   = "Tabla de Caracteres Ascii";
$_STR[Ascii2]   = "S�mbolo";

// Search
$_STR[Search0]  = "Buscar";
$_STR[Search1]  = "Buscar Personajes";
$_STR[Search2]  = "Buscar Cuentas";
$_STR[Search3]  = "Buscar Clanes";
$_STR[Search4]  = "Buscar Wins/Losses de Clanes";
$_STR[Search5]  = "Nombre";
$_STR[Search6]  = "Nombre Clan";
$_STR[Search7]  = "Nombre Personaje";
$_STR[Search8]  = "Nombre Master";
$_STR[Search9]  = "Este Clan";
$_STR[Search10] = "Gana";
$_STR[Search11] = "Pierde";
$_STR[Search12] = "Max Resultados";
$_STR[Search13] = "Tipo de b�squeda inv�lido";
$_STR[Search14] = "No se han encontrado resultados";
$_STR[Search15] = "Resultados de la b�squeda";

// Logs

$_STR[Log0]     = "La UserID de la %s %s ha sido cambiada a %s";
$_STR[Log1]     = "La contrase�a de la %s %s ha sido cambiada a %s";
$_STR[Log2]     = "El rango de la %s %s ha sido cambiado a %s";
$_STR[Log3]     = "Se ha enviado el item %s a todas las cuentas";
$_STR[Log4]     = "Se ha enviado el item %s a la AID %s";

$_STR[Log5]     = "El nombre del personaje %s ha sido cambiado a %s";
$_STR[Log6]     = "El personaje %s ha sido borrado";
$_STR[Log7]     = "Se han borrado todos los items del personaje %s";
$_STR[Log8]     = "Se han borrado todos los items de cuenta de la AID %s";
$_STR[Log9]     = "Se ha enviado el item con ItemID %s a la CID %s";
$_STR[Log10]    = "El item con la ItemID %s ha sido borrado de la CID %s";
$_STR[Log11]    = "Se ha reiniciado el personaje %s";
$_STR[Log12]    = "La EXP del personaje %s ha sido cambiada a %s";
$_STR[Log13]    = "El nivel del personaje %s ha sido cambiado a %s";
$_STR[Log14]    = "El bounty del personaje %s ha sido cambiado a %s";
$_STR[Log15]    = "El sexo del personaje %s ha sido cambiado";
$_STR[Log16]    = "El pelo del personaje %s ha sido cambiado";
$_STR[Log17]    = "La cara del personaje %s ha sido cambiada";

$_STR[Log18]    = "Ranking de clanes generado";
$_STR[Log19]    = "Se a creado el clan %s con MasterCID %s";
$_STR[Log20]    = "El clan %s ha sido borrado";
$_STR[Log21]    = "El clan %s ha sido reiniciado";
$_STR[Log22]    = "Todos los clanes han sido reiniciados";
$_STR[Log23]    = "Se ha quitado el Emblem del clan %s";
$_STR[Log24]    = "Los stats del clan %s han sido cambiados";
$_STR[Log25]    = "El rango del miembro de clan %s ha sido cambiado a %s";

$_STR[Log26]    = "Se ha permitido a todos los pa�ses";
$_STR[Log27]    = "Se ha bloqueado a todos los pa�ses";
$_STR[Log28]    = "El pa�s con counrtycode3 %s ha sido permitido";
$_STR[Log29]    = "El pa�s con counrtycode3 %s ha sido bloqueado";
$_STR[Log30]    = "Se ha establecido un nuevo mensaje de bloqueo: %s";
$_STR[Log31]     = "El Usuario  %s ha resivido %s DCoins";
$_STR[Log32]     = "El Usuario  %s ha resivido %s EventCoins";

// Accounts

$_STR[Acc0]     = "Cambiar UserID";
$_STR[Acc1]     = "Nueva UserID";
$_STR[Acc2]     = "Cambiar";
$_STR[Acc3]     = "Cambiar Contrase�a";
$_STR[Acc4]     = "Nueva Contrase�a";
$_STR[Acc5]     = "Cambiar Rango de Usuario";
$_STR[Acc6]     = "Baneado";
$_STR[Acc7]     = "Usuario Normal";
$_STR[Acc8]     = "Mod Invisible";
$_STR[Acc9]     = "Mod";
$_STR[Acc10]    = "Administrador";
$_STR[Acc11]    = "Enviar item al storage de TODAS las cuentas";
$_STR[Acc12]    = "Duraci�n(Dias)";
$_STR[Acc13]    = "Enviar item al storage";
$_STR[Acc14]    = "Enviar";
$_STR[Acc15]    = "Ya existe una cuenta con la UserID %s";
$_STR[Acc16]    = "La cuenta seleccionada no existe";
$_STR[Acc17]    = "UserID cambiada exitosamente";
$_STR[Acc18]    = "Contrase�a cambiada exitosamente";
$_STR[Acc19]    = "Rango cambiado exitosamente";
$_STR[Acc20]    = "ItemID o duraci�n incorrectos";
$_STR[Acc21]    = "Item enviado al storage de todas las cuentas";
$_STR[Acc22]    = "Item enviado al storage de la cuenta seleccionada";

// Characters

$_STR[Char0]    = "Cambiar nombre de personaje";
$_STR[Char1]    = "Nombre";
$_STR[Char2]    = "Nuevo Nombre";
$_STR[Char3]    = "Cambiar";
$_STR[Char4]    = "Borrar personaje";
$_STR[Char5]    = "Borrar";
$_STR[Char6]    = "Borrar todos los items del equip";
$_STR[Char7]    = "Borrar todos los items del Storage";
$_STR[Char8]    = "Enviar item al equip";
$_STR[Char9]    = "Borrar item del equip";
$_STR[Char10]   = "Enviar";
$_STR[Char11]   = "Reiniciar Personaje (Lvl 1, XP: 0, BT: 1000)";
$_STR[Char12]   = "Reiniciar";
$_STR[Char13]   = "Cambiar EXP de personaje";
$_STR[Char14]   = "Cambiar Nivel de personaje";
$_STR[Char15]   = "Cambiar Bounty de personaje";
$_STR[Char16]   = "Cambiar Sexo de personaje";
$_STR[Char17]   = "Hombre";
$_STR[Char18]   = "Mujer";
$_STR[Char19]   = "Cambiar Pelo de personaje";
$_STR[Char20]   = "Pelo";
$_STR[Char21]   = "Cambiar Cara de personaje";
$_STR[Char22]   = "Cara";
$_STR[Char23]   = "Ya existe un personaje con el Nombre %s";
$_STR[Char24]   = "El personaje seleccionado no existe";
$_STR[Char25]   = "Nombre cambiado exitosamente";
$_STR[Char26]   = "Personaje borrado exitosamente";
$_STR[Char27]   = "Items borrados exitosamente";
$_STR[Char28]   = "El personaje o cuenta seleccionado no existe";
$_STR[Char29]   = "Item enviado exitosamente";
$_STR[Char30]   = "Item borrado exitosamente";
$_STR[Char31]   = "Personaje reiniciado exitosamente";
$_STR[Char32]   = "Valor num�rico incorrecto";
$_STR[Char33]   = "EXP cambiada exitosamente";
$_STR[Char34]   = "LVL cambiado exitosamente";
$_STR[Char35]   = "Bounty cambiado exitosamente";
$_STR[Char36]   = "Sexo inv�lido";
$_STR[Char37]   = "Sexo cambiado exitosamente";
$_STR[Char38]   = "Pelo inv�lido";
$_STR[Char39]   = "Pelo cambiado exitosamente";
$_STR[Char40]   = "Cara inv�lida";
$_STR[Char41]   = "Cara cambiada exitosamente";

// Clans

$_STR[Clan0]    = "Generar Ranking de Clanes";
$_STR[Clan1]    = "Esto va a actalizar el ranking de todos los clanes<br />Puede demorar si hay muchos clanes<br />";
$_STR[Clan2]    = "Generar";
$_STR[Clan3]    = "Crear Clan";
$_STR[Clan4]    = "Nombre";
$_STR[Clan5]    = "Crear";
$_STR[Clan6]    = "Borrar Clan";
$_STR[Clan7]    = "Borrar";
$_STR[Clan8]    = "Reiniciar puntaje de un clan";
$_STR[Clan9]    = "Reiniciar TODOS los clanes";
$_STR[Clan10]   = "Reiniciar";
$_STR[Clan11]   = "Quitar Emblem a un Clan";
$_STR[Clan12]   = "Quitar";
$_STR[Clan13]   = "Cambiar Stats de un Clan";
$_STR[Clan14]   = "Cambiar";
$_STR[Clan15]   = "Cambiar rango de miembro";
$_STR[Clan16]   = "Rango";
$_STR[Clan17]   = "<b>Advertencia:</b> Esto no puede ser revertido<br /><br />";
$_STR[Clan18]   = "Ranking de clanes generado exitosamente";
$_STR[Clan19]   = "Ya existe un clan con el nombre seleccionado";
$_STR[Clan20]   = "El master seleccionado no existe";
$_STR[Clan21]   = "El master seleccionado es miembro de otro clan";
$_STR[Clan22]   = "Clan creado exitosamente";
$_STR[Clan23]   = "El Clan seleccionado no existe";
$_STR[Clan24]   = "Clan borrado exitosamente";
$_STR[Clan25]   = "Clan reiniciado exitosamente";
$_STR[Clan26]   = "Todos los clanes han sido reiniciados exitosamente";
$_STR[Clan27]   = "Emblem quitado exitosamente";
$_STR[Clan28]   = "Las Wins, Losses y Points deben ser valores num�ricos";
$_STR[Clan29]   = "Stats cambiados exitosamente";
$_STR[Clan30]   = "El Miembro de clan seleccionado no existe";
$_STR[Clan31]   = "El rango de miembro de clan es inv�lido";
$_STR[Clan32]   = "El personaje seleccionado no es miembro de ningun clan";
$_STR[Clan33]   = "El Miembro de clan seleccionado es due�o de un clan y no puedes cambiar su rango";
$_STR[Clan34]   = "Se ha cambiado el rango del miembro de clan exitosamente";

// Country Restriction plugin

$_STR[Country0] = "Permitir a todos los Pa�ses";
$_STR[Country1] = "Permitir";
$_STR[Country2] = "Bloquear a todos los Pa�ses";
$_STR[Country3] = "Bloquear";
$_STR[Country4] = "Permitir a un pa�s";
$_STR[Country5] = "Bloquear a un pa�s";

$_STR[Country6] = "Todos los pa�ses han sido permitidos";
$_STR[Country7] = "Todos los pa�ses han sido  bloqueados";
$_STR[Country8] = "Pa�s permitido exitosamente";
$_STR[Country9] = "Pa�s bloqueado exitosamente";
$_STR[Counrty10]= "Mensaje de bloqueo establecido exitosamente";
$_STR[Country11]= "Establecer un nuevo mensaje de pa�s bloqueado";
$_STR[Country12]= "Establecer";


//Creditos
$_STR[CSACKER1] = "Panel Admin Creado Por Sacker.";



?>