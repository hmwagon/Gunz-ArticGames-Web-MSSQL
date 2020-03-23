<?php
if($_SESSION[AID] == ""){

    Messenger_Gunz ("Debe iniciar sesion primero.","index.php");
    die();
}
ModulsTitle("AeroGamez Gunz - Ajuste");

include('class_include/class_contenido_columna_one.php');
?>
<div class="mid">
    <div class="module">
        <div class="module">
            <h3>Panel de Cuenta</h3>
            <div class="content">
                <ul class="accounthead">
                    <li>
                        <a class="active">Cuenta</a>
                    </li>
                    <li>
                        <a href="?mod=characters">Personajes</a>
                    </li>
                    <li>
                        <a href="?mod=clans">Clanes</a>
                    </li>
                    <li>
                        <a href="?mod=premium">Comprar Coins</a>
                    </li>
                </ul>
                <ul class="account">
                <?
                    $Accress = mssql_query("SELECT Email FROM Account(nolock) WHERE AID = '{$_SESSION[AID]}'");
                    $_MEMBER[Accress]   = mssql_fetch_assoc($Accress);
                    $Logress = mssql_query("SELECT Password FROM login(nolock) WHERE AID = '{$_SESSION[AID]}'");
                    $_MEMBER[Logress]   = mssql_fetch_assoc($Logress);

                ?>
                    <center>
                        <li><b>Nombre de Usuario:</b>: <? print $_SESSION[UserID];?></li>
                        <li><b>Correo:</b>: ********<?=substr($_MEMBER[Accress][Email], -13)?></li>
                        <li><b>Contraseña:</b>: ******<?=substr($_MEMBER[Logress][Password], 6)?></li>
                        <li><b><a href="?mod=characters"><b><i class="dki add"></i></b></a><b>Color</b>: None</b></li>
                        <b>
                            <li>Event Coins: <strong><?=$_MEMBER[AccountData][EventCoins]?></strong></li>
                            <li><a href="?mod=premium"><i class="dki add"></i></a>Donator Coins: <strong><?=$_MEMBER[AccountData][Coins]?></strong></li>
                        </b>
                    </center>
                </ul>
                <b>
                    <ul class="account">
                        <li><a href="?mod=editdata">Editar Cuenta</a></li>
                    </ul>
                </b>
            </div>
        </div>
    </div>
</div>
<?php
include('class_include/class_contenido_columna_three.php');
?>