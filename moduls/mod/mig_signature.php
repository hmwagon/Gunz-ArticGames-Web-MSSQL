<?php
if($_SESSION[AID] == ""){

    Messenger_Gunz ("Debe iniciar sesion primero.","index.php");
    die();
}

ModulsTitle("AeroGames Gunz - Clan subir Emblem");

$Signat = mssql_query("SELECT CID, Name FROM Character(nolock) WHERE AID = '".$_SESSION['AID']."'AND CharNum != '-1'");

    if( mssql_num_rows($Signat) < 1 )
    {
    	Messenger_Gunz("No tienes personajes","index.php");
        die();
    }

include('class_include/class_contenido_columna_one.php');
?>
<script type="text/javascript">
    function UpdateSignature()
    {
        var CID = document.signature.charlist.value;
        var firma = document.getElementById("firma");
        firma.innerHTML = '<img src="<?=$URL_BASE?>sign.php?CID='+ CID + '" />';
        document.signature.forumcode.value = '[URL="<?=$URL_BASE?>"][IMG]<?=$URL_BASE?>sign.php?CID=' + CID + '[/IMG][/URL]';
        document.signature.directlink.value = "<?=$URL_BASE?>sign.php?CID=" + CID + "";
    }

</script>

<div class="mid">
    <div class="module">
        <div class="module">
            <h3>Firma de Gunz</h3>
            <div class="content">
                <ul class="registerformupload">
                	<form name="signature">
	                	<li>
	                       <ul class="account">
	                            <li>Firma de AeroGunz, Seleccione el personaje para obtener su firma.</li>
	                        </ul>
	                    </li>
	                    <li>
	                    	<p>Selecciona tu Personajes: </p>
	                    	<span>
	                    		<select size="1" name="charlist" onchange="UpdateSignature()">
		                            <?
		                            while( $DataSing = mssql_fetch_row($Signat) )
		                            {
		                            ?>
		                                <option value="<?=$DataSing[0]?>"><?=$DataSing[1]?></option><br />';
		                            <?
		                            }
		                            ?>
								</select>
	                    	</span>
	                    </li>
	                    <li>
	                    	<div Align="center" id="firma"></div>
	                    </li>
	                    <li>
	                    	<p>Código para los Foros: </p>
	                    	<span><input type="text" name="forumcode" onclick="javascript:select();" readonly="readonly"/></span>
	                    </li>
	                    <li>
	                    	<p>Link Directo: </p>
	                    	<span><input type="text" name="directlink" onclick="javascript:select();" readonly="readonly"/></span>
	                    </li>
	                </form>
                </ul>
                <script type="text/javascript">
                	UpdateSignature();
                </script>
            </div>
        </div>
    </div>
</div>
<?php
include('class_include/class_contenido_columna_three.php');
?>