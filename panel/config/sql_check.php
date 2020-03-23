<?php

date_default_timezone_set('America/Los_Angeles');

$bloquiados = array(";","\"","%","'","+","#","$","--","-//-","==","z'; U\PDATE Account S\ET ugradeid=char","x'; U\PDATE Character S\ET level=99;-\-","x';U\PDATE Account S\ET ugradeid=255;-\-","x';U\PDATE Account D\ROP ugradeid=255;-\-","x';U\PDATE Account D\ROP ","AND 1=1","<script>","</script>","<script></script>","ORDER BY","UNION SELECT"); 
foreach($_POST as $valor)
{
	foreach($bloquiados as $bloquiados2)
	{
		if(substr_count(strtolower($valor), strtolower($bloquiados2)) > 0) 
		{
		
		  echo "<script>alert('Oops, something went wrong.');document.location = 'index.php'</script>";
		  die();
		}
	}
}
foreach($_GET as $valor)
{
	foreach($bloquiados as $bloquiados2)
	{
		if(substr_count(strtolower($valor), strtolower($bloquiados2)) > 0) 
		{

		 echo "<script>alert('Oops, something went wrong.');document.location = 'index.php'</script>";
		  die();
		}
	}
}
foreach($_COOKIE as $valor)
{
	foreach($bloquiados as $bloquiados2)
	{
		if(substr_count(strtolower($valor), strtolower($bloquiados2)) > 0) 
		{
		
		  echo "<script>alert('Oops, something went wrong.');document.location = 'index.php'</script>";
		  die();
		}
	}
	}
	