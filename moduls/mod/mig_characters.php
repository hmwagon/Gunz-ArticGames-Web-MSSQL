<?php
if($_SESSION[AID] == ""){

    Messenger_Gunz (MODULS_2,"index.php");
    die();
}

include('class_include/class_contenido_columna_one.php');
?>
<div class="mid">
    <div class="module">
        <div class="module">
            <h3>Panel de Cuenta</h3>
            <div class="content">
                <ul class="accounthead">
                    <li>
                        <a href="?mod=setting">Cuenta</a>
                    </li>
                    <li>
                        <a class="active">Personajes</a>
                    </li>
                    <li>
                        <a href="?mod=clans">Clanes</a>
                    </li>
                    <li>
                        <a href="?mod=premium">Buy premium</a>
                    </li>
                </ul>
                <ul class="simple-tabs" id="demo-tabs">
                    <!--<li class="fortumo-ve active">Informacion</li>-->
                    <li class="fortumo-ar">Cambiar Color</li>
					<!--<li class="fortumo-ve active">Cambiar Color</li>-->
                </ul>
                <div class="clear-float"></div>
               <!-- <div id="fortumo-ve" class="tab-page active-page">
                    <ul class="registerform">
                        <li>
                            <form>
                                <select id="charselect" name="charselect" onchange="GetChars()">
                                    <option value="">Selecciona el char que quieras ver</option>
                                    <option value="292951">Shidorixz</option><option value="311968">Giscayne</option>                            
                                </select>
                            </form>
                        </li>
                        <br>
                        <h1>Shidorixz</h1>
                        <br\><br\>
                        <table class="latablitawey">
                            <tbody>
                                <tr>
                                    <td class="lanegradapadre">Level</td>
                                    <td>37</td>
                                </tr>
                                <tr>
                                    <td class="lanegradapadre">XP</td>
                                    <td>3725481</td>
                                </tr>
                                <tr>
                                    <td class="lanegradapadre">Ranking</td>
                                    <td>55555</td>
                                </tr>
                                <tr>
                                <td class="lanegradapadre">KillCount</td>
                                    <td>107</td>
                                </tr>
                                <tr>
                                    <td class="lanegradapadre">DeathCount</td>
                                    <td>177</td>
                                </tr>
                                <tr>
                                    <td class="lanegradapadre">PlayTime</td>
                                    <td>17h</td>
                                </tr>
                                <tr>
                                    <td class="lanegradapadre">Country</td>
                                    <td>AR</td>
                                </tr>
                                <tr>
                                    <td class="lanegradapadre">Status</td>
                                    <td class="larojadapadre"> Offline </td>
                                </tr>
                            </tbody>
                        </table>           
                        </br\></br\>
                    </ul>
                </div>-->
                <!--<div id="fortumo-ar" class="tab-page">-->
				<div id="fortumo-ve" class="tab-page active-page">
				<script type="text/javascript" src="https://gunz.aerogamez.com/js/js/jscolor.js"></script>
                    <ul class="registerform">
                       <!-- Puede cambiar el color de sus personajes totalmente gratis, Solo debe seleccionar su color y cambiar lo.-->
                        <br> <br>
						<?
							function CharNum($Input) {
		$check = strlen($Input);
		return $check;
	}
	
	
	if(isset($_POST[cambiar])){
				
		$clientcolor = $_POST['hexcolor'];
		if(CharNum($clientcolor) == 6) {
			VIPColorSystem($clientcolor);
			Messenger_Gunz ("Se ha agregado el color a la cuenta.","index.php");
			die();
		}else{
			Messenger_Gunz ("Error al agregar color.","index.php");
			die();
			}		
	}
	function VIPColorSystem($hex){
		$hex = str_replace("#", "", $hex);
		if(strlen($hex) == 3) {
			
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
			
		}else{
			
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		
		mssql_query("UPDATE Account SET RedColor='$r',GreenColor='$g',BlueColor='$b' WHERE UserID='" . $_SESSION['UserID'] . "'");
	}
						?>
						<form name="cambiar" method="post" action="">
							 <span class="centerfix"><input type='readonly' class="color" name='hexcolor' />	
							<input name="cambiar" type="submit" value="Cambiar"></span>	
                        </form>
                    </ul>
                </div>
                <script>
                    var demoTabs = new SimpleTabs(document.getElementById('demo-tabs'));
                </script>
            </div>
        </div>                
    </div>
</div>
<?php
include('class_include/class_contenido_columna_three.php');
?>