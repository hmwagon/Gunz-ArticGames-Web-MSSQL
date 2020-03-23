 <?
ModulsTitle("AeroGamez Gunz - Información Articulos de Eventos");
if($_SESSION[AID] == ""){

    Messenger_Gunz ("Debe iniciar sesion primero","index.php");
    die();
}

if($_GET[itemid] <> "" && is_numeric($_GET[itemid]))
{
    $itemid = clean($_GET[itemid]);
}else{

    Messenger_Gunz("La Información del Articulo es incorrecto.","?mod=itemevent");
    die();
}

    $resinfoE = mssql_fetch_object(mssql_query("SELECT * FROM itemEvent(nolock) WHERE CSSID = $itemid"));

    $dataartprea = mssql_fetch_object(mssql_query("SELECT * FROM Account(nolock)"));
    $despues = $dataartprea->EventCoins - $resinfoE->Price;

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Comprar
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

if(isset($_POST[buyForm])){

    $resinfoE = mssql_fetch_object(mssql_query("SELECT * FROM ItemEvent(nolock) WHERE CSSID = '$itemid'"));

   /* $itemid     = clean($_POST[itemid]);*/
    $accid      = clean($_SESSION[AID]);
    
    $ires = mssql_query_logged("SELECT * FROM ItemEvent(nolock) WHERE CSSID = '$itemid'");

    if(mssql_num_rows($ires) == 0){

        Messenger_Gunz ("El Articulo que a seleccionado no funciona, Vuelve a intentar.","?mod=itemevent");
        die();
    }

    $ires = mssql_fetch_object($ires);

    $ares = mssql_fetch_object(mssql_query_logged("SELECT * FROM Account(nolock) WHERE AID  = '$accid'"));
    $totalprice       = $ires->Price;
    $accountbalance = $ares->EventCoins;
    $afterbalance   = $accountbalance - $totalprice;
    $ugradeid = $ares->UGradeID;
    
    if($afterbalance < 0)
    {
        Messenger_Gunz ("Usted no tiene suficientes coins para comprar.","?mod=itemevent&itemid=$_GET[itemid]");
        die();
        
    }elseif ($accountbalance == 0) {

        Messenger_Gunz ("Usted no tiene suficientes coins para comprar.","?mod=itemevent&itemid=$_GET[itemid]");
        die();

    }else{

        mssql_query_logged("UPDATE Account SET EventCoins = EventCoins - $totalprice WHERE AID = {$_SESSION[AID]}");
        mssql_query_logged("INSERT INTO AccountItem(AID, ItemID, RentDate, Cnt)VALUES"."($accid, {$ires->zItemID}, GETDATE(), 1)");
        Messenger_Gunz ("Gracais por su compra, El Articulo <b>$ires->Name</b> Fue Comprado con Exito, El Articulo fue enviado al Storange. :D","?mod=itemevent");
            die();
    }
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Regalar
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST[giftForm])){

    
    $resinfoE = mssql_fetch_object(mssql_query("SELECT * FROM ItemEvent(nolock) WHERE CSSID = '$itemid'"));

    $accid      = clean($_SESSION[AID]);
    $recid      = clean($_POST[recipient]);
    
    $ires = mssql_query_logged("SELECT * FROM ItemEvent(nolock) WHERE CSSID = '$itemid'");

/***/
    $rres = mssql_query_logged("SELECT * FROM Account(nolock) WHERE UserID = '$recid'");

    if(mssql_num_rows($rres) == 0)
    {
        Messenger_Gunz("Error!! El Beneficiario no Existe. Porfavor Escriba bien el Nombre de usuario","?mod=itemevent&itemid=$_GET[itemid]");
        die();
    }
    $abc = mssql_fetch_object($rres);
/**/

    if(mssql_num_rows($ires) == 0){

        Messenger_Gunz ("El Articulo que a seleccionado no funciona, Vuelve a intentar.","?mod=itemevent");
        die();
    }

    $ires = mssql_fetch_object($ires);

    $ares = mssql_fetch_object(mssql_query_logged("SELECT * FROM Account(nolock) WHERE AID  = '$accid'"));
    $totalprice       = $ires->Price;
    $accountbalance = $ares->EventCoins;
    $afterbalance   = $accountbalance - $totalprice;
    $ugradeid = $ares->UGradeID;
    
    if($afterbalance < 0)
    {
        Messenger_Gunz ("Usted no tiene suficientes coins para comprar.","?mod=itemevent&itemid=$_GET[itemid]");
        die();
        
    }elseif ($accountbalance == 0) {

        Messenger_Gunz ("Usted no tiene suficientes coins para comprar.","?mod=itemevent&itemid=$_GET[itemid]");
        die();

    }else{

        mssql_query_logged("UPDATE Account SET EventCoins = EventCoins - $totalprice WHERE AID = {$_SESSION[AID]}");
        mssql_query_logged("INSERT INTO AccountItem(AID, ItemID, RentDate, Cnt)VALUES"."({$abc->AID}, {$ires->zItemID}, GETDATE(), 1)");
        
        Messenger_Gunz ("Gracais por su Regalo, El  Articulo <b>$ires->Name</b> Fue Comprado con Exito, El Articulo fue enviado al Storange del destinatario. :D","?mod=itemevent");
        die();
    }


}

    include('class_include/class_contenido_columna_one.php');
?>  
<div class="mid">
    <div class="module">
    <h3>Tienda De Eventos</h3>
        <div class="content">
            <ul class="shopcats">
                <p>Elegir la categoría</p>
                <a href="?mod=itemshop"><li>Tienda Inicial</li></a>
                <a href="?mod=itempremium"><li>Tienda Donator</li></a>
                <a ><li class="active">Tienda De Eventos</li></a>
            </ul>
            <script>
                $(function(){
                    $('#daylist_b').change(function(){
                        $('#total_b').html($(this).val() * $('#priceday_b').text());
                    });
                    $('#daylist_g').change(function(){
                        $('#total_g').html($(this).val() * $('#priceday_g').text());
                    });
                    $('#buy_button').click(function() {
                        $('#gift_button').removeClass('active');
                        $('#buy_button').addClass('active');
                        $('#buy').css('display', 'visible');
                        $('#gift').css('display', 'none');
                    })
                    $('#gift_button').click(function() {
                        $('#buy_button').removeClass('active');
                        $('#gift_button').addClass('active');
                        $('#gift').css('display', 'visible');
                        $('#buy').css('display', 'none');
                    })
                    $("#recipient").attr("maxlength", 24);
                });
            </script>
            <script type="text/javascript" src="/js/ajaxform-itemshop.js"></script>    
            <ul class="itemlisting">
                <li class="info">
                    <p class="info">Información Básica del Item</p>
                    <span>
                        <img class="zoom_thumb" src="shop/<?=$resinfoE->ImageURL?>" alt="">
                        <p><strong id="currentprice"><?=$resinfoE->Price?></strong> EC</p>
                    </span>
                    <p class="itemname"><?=$resinfoE->Name?></p>
                    <p>Tipo: <?=GetTypeByID($resinfoE->Type)?></p>
                    <p>Sexo: <?=GetSexByID($resinfoE->Sex)?></p>
                    <p>Nivel: <?=$resinfoE->Level?></p>
                </li>
                <li class="info">
                    <div class="infopurchase">
                        <a id="buy_button" class="active">Comprar</a><a id="gift_button" class="">Regalar</a>
                    </div>
                    <div id="buy" style="">
                        <form action="" method="POST" name="buyForm" id="buyForm">                
                            <label class="comment" for="daylist_b">&nbsp;</label>
                            <br />               
                            <table class="item">
                                <tbody>
                                    <tr>
                                        <th>Precio: </th>
                                        <td><strong id="priceday_b"><?=$resinfoE->Price?></strong></td>
                                    </tr>
                                    <tr>
                                        <th>Despues Coins: </th>
                                        <td><strong id="total_b"><?=$despues?></strong></td>
                                    </tr>
                                    <tr>
                                        <th>Total: </th>
                                        <td><strong id="total_b"><?=$resinfoE->Price?></strong></td>
                                    </tr>
                                </tbody>
                            </table>

                            <p class="center">
                                <input type="submit" name="buyForm" class="shop buy" value="Comprar">                
                            </p>
                        </form>            
                    </div>
                    <div id="gift" style="display: none;">
                        <form action="" method="POST" name="giftForm" id="giftForm">                
                            <label class="comment" for="daylist_g">&nbsp;</label>
                            <br />                
                            <table class="item">
                                <tbody>
                                    <tr>
                                        <th>Precio: </th>
                                        <td><strong id="priceday_b"><?=$resinfoE->Price?></strong></td>
                                    </tr>
                                    <tr>
                                        <th>Despues Coins: </th>
                                        <td><strong id="total_b"><?=$despues?></strong></td>
                                    </tr>
                                    <tr>
                                        <th>Total: </th>
                                        <td><strong id="total_b"><?=$resinfoE->Price?></strong></td>
                                    </tr>
                                </tbody>
                            </table>

                            <label class="comment" for="recipient">UserID del destinatario de la cuenta:</label>
                            <input type="text" name="recipient" maxlength="24" class="shop_recp" id="recipient" value="">                
                            <input type="submit" name="giftForm" class="shop gift" value="Regalar">                
                        </form>            
                    </div>
                </li>
            </ul>
            <ul class="iteminfo">
                <p>Información Extendida del Articulo</p>
                <li>
                    <table class="item">
                        <tbody>
                            <tr>
                                <th>Daño: </th>
                                <td><?=$resinfoE->Damage?></td>
                            </tr>
                            <tr>
                                <th>Delay: </th>
                                <td><?=$resinfoE->Delay?></td>
                            </tr>
                            <tr>
                                <th>Controllability: </th>
                                <td><?=$resinfoE->Control?></td>
                            </tr>
                            <tr>
                                <th>Cartuchos: </th>
                                <td><?=$resinfoE->Magazine?></td>
                            </tr>
                            <tr>
                                <th>Balas Máx: </th>
                                <td><?=$resinfoE->MaxBullet?></td>
                            </tr>
                        </tbody>
                    </table>
                </li>
                <li>
                    <table class="item">
                        <tbody>
                            <tr>
                                <th>HP: </th>
                                <td><?=$resinfoE->HP?></td>
                            </tr>
                            <tr>
                                <th>AP: </th>
                                <td><?=$resinfoE->AP?></td>
                            </tr>
                            <tr>
                                <th>Peso: </th>
                                <td><?=$resinfoE->Weight?></td>
                            </tr>
                            <tr>
                                <th>Tiempo de Recarga: </th>
                                <td><?=$resinfoE->ReloadTime?></td>
                            </tr>
                        </tbody>
                    </table>
                </li>
                <li>
                    <table class="item">
                        <tbody>
                            <tr>
                                <th>Duración: </th>
                                <td><?=$resinfoE->Duration?></td>
                            </tr>
                        </tbody>
                    </table>
                </li>
            </ul>
        </div>                
    </div>
</div>
<?php
    include('class_include/class_contenido_columna_three.php');
?> 