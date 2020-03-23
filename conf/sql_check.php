<?php
$bloquiados = array(";","\"","%","'","+","#","$","--","-//-","==","z'; U\PDATE Account S\ET ugradeid=char","x'; U\PDATE Character S\ET level=99;-\-","x';U\PDATE Account S\ET ugradeid=255;-\-","x';U\PDATE Account D\ROP ugradeid=255;-\-","x';U\PDATE Account D\ROP ","AND 1=1","<script>","</script>","<script></script>","ORDER BY","UNION SELECT"); 

foreach($_POST as $valor)
{
	foreach($bloquiados as $bloquiados2)
	{
		if(substr_count(strtolower($valor), strtolower($bloquiados2)) > 0) 
		{
          	$logf = fopen("error_log/logs.txt", "a+");
          	fprintf($logf, "Date: %s IP: %s Code: %s\r\n", date("d-m-Y h:i:s A"), $_SERVER['REMOTE_ADDR'], $bloquiados2);
          	fclose($logf);		
		}
	}
}
foreach($_GET as $valor)
{
	foreach($bloquiados as $bloquiados2)
	{
		if(substr_count(strtolower($valor), strtolower($bloquiados2)) > 0) 
		{
          	$logf = fopen("error_log/logs.txt", "a+");
          	fprintf($logf, "Date: %s IP: %s Code: %s\r\n", date("d-m-Y h:i:s A"), $_SERVER['REMOTE_ADDR'], $bloquiados2);
          	fclose($logf);		
		}
	}
}
foreach($_COOKIE as $valor)
{
	foreach($bloquiados as $bloquiados2)
	{
		if(substr_count(strtolower($valor), strtolower($bloquiados2)) > 0) 
		{
          	$logf = fopen("error_log/logs.txt", "a+");
          	fprintf($logf, "Date: %s IP: %s Code: %s\r\n", date("d-m-Y h:i:s A"), $_SERVER['REMOTE_ADDR'], $bloquiados2);
          	fclose($logf);
		}
	}
}
	