<?
if($_SESSION[AID] != "")
{
    session_unset();
    session_destroy();
    Go_URL("index.php");
	die();

}else{
	
	Messenger_Gunz ("No se puede dejar que se desconecte No These Online!","index.php");
	die();

}


?>