 <?
ModulsTitle("AeroGamez Gunz - Información Articulos Premium");

if($_GET[itemid] <> "" && is_numeric($_GET[itemid]))
{
    $itemid = clean($_GET[itemid]);
}else{

    Messenger_Gunz("Incorrect item information","?mod=ItemDayShop");
    die();
}

$resinfoP = mssql_fetch_object(mssql_query("SELECT * FROM ItemDayShop(nolock) WHERE CSSID = $itemid"));


    include('class_include/class_contenido_columna_one.php');
?>  
<div class="mid">
    <div class="module">
    <h3>Item of the Day</h3>
        <div class="content">
            <ul class="shopcats">
                <p><?PHP print SHOP_7?></p>
                <a href="?mod=itemshop"><li><?php print SHOP_8;?></li></a>
                <a ><li class="active"><?PHP print SHOP_10;?></li></a>
                <a href="?mod=itemevent"><li><?PHP print SHOP_11;?></li></a>
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
                        <img class="zoom_thumb" src="shop/<?=$resinfoP->ImageURL?>" alt="">
                        <p><strong id="currentprice"><?=$resinfoP->Price?></strong> DC</p>
                    </span>
                    <p class="itemname"><?=$resinfoP->Name?></p>
                    <p><?PHP PRINT SHOP_3;?> <?=GetTypeByID($resinfoP->Type)?></p>
                    <p><?PHP PRINT SHOP_4;?> <?=GetSexByID($resinfoP->Sex)?></p>
                    <p><?PHP PRINT SHOP_5;?> <?=$resinfoP->Level?></p>
					<p>Horas:<?=$resinfoP->TimeOffer?></p>
                </li>
                <li class="info">
                    <div class="infopurchase">
                        <a id="buy_button" class="active">Buy</a><a id="gift_button" class="">Regalar</a>
                    </div>
                    <div id="buy" style="">
                        <form action="" method="POST" name="buyForm" id="buyForm">                
                            <label class="comment" for="daylist_b">&nbsp;</label>
                            <br />               
                            <table class="item">
                                <tbody>
                                    <tr>
                                        <th>Precio: </th>
                                        <td><strong id="priceday_g"><?=$resinfoP->Price?></strong></td>
                                    </tr>
                                    <tr>
                                        <th>Total: </th>
                                        <td><strong id="priceday_g"><p class="dayoff"><?=$resinfoP->PriceOffer?></p></strong></td>
                                    </tr>
                                </tbody>
                            </table>

                            <p class="center">
                                <input style="cursor:no-drop;" type="submit" name="submit" class="shop buy" value="Comprar Item">                
                            </p>
                        </form>            
                    </div>
                    <div id="gift" style="display: none;">
                        <form action="" method="POST" name="" id="">                
                            <label class="comment" for="daylist_g">&nbsp;</label>
                            <br />                
                            <table class="item">
                                <tbody>
                                    <tr>
                                        <th>Precio: </th>
                                        <td><strong id="priceday_g"><?=$resinfoP->Price?></strong></td>
                                    </tr>
                                    <tr>
                                        <th>Total: </th>
                                        <td><strong id="priceday_g"><p class="dayoff"><?=$resinfoP->PriceOffer?></p></strong></td>
                                    </tr>
                                </tbody>
                            </table>

                            <label class="comment" for="recipient">Account Recipent Name:</label>
                            <input type="text" name="recipient" maxlength="24" class="shop_recp" id="recipient" value="">                
                            <input style="cursor:no-drop;" type="submit" name="submit" class="shop gift" value="Regalar Item">                
                        </form>            
                    </div>
                </li>
            </ul>
            <ul class="iteminfo">
                <p>Información Extendida del Item</p>
                <li>
                    <table class="item">
                        <tbody>
                            <tr>
                                <th>Daño: </th>
                                <td><?=$resinfoP->Damage?></td>
                            </tr>
                            <tr>
                                <th>Delay: </th>
                                <td><?=$resinfoP->Delay?></td>
                            </tr>
                            <tr>
                                <th>Controllability: </th>
                                <td><?=$resinfoP->Control?></td>
                            </tr>
                            <tr>
                                <th>Cartuchos: </th>
                                <td><?=$resinfoP->Magazine?></td>
                            </tr>
                            <tr>
                                <th>Balas Máx: </th>
                                <td><?=$resinfoP->MaxBullet?></td>
                            </tr>
                        </tbody>
                    </table>
                </li>
                <li>
                    <table class="item">
                        <tbody>
                            <tr>
                                <th>HP: </th>
                                <td><?=$resinfoP->HP?></td>
                            </tr>
                            <tr>
                                <th>AP: </th>
                                <td><?=$resinfoP->AP?></td>
                            </tr>
                            <tr>
                                <th>Peso: </th>
                                <td><?=$resinfoP->Weight?></td>
                            </tr>
                            <tr>
                                <th>Tiempo de Recarga: </th>
                                <td><?=$resinfoP->ReloadTime?></td>
                            </tr>
                        </tbody>
                    </table>
                </li>
                <li>
                    <table class="item">
                        <tbody>
                            <tr>
                                <th>Duración: </th>
                                <td><?=$resinfoP->Duration?></td>
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