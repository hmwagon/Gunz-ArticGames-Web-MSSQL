<?php
    ModulsTitle("AeroGamez Gunz - Comprar Coins");


if($_SESSION[AID] == ""){

Messenger_Gunz ("Debe iniciar sesion primero","index.php");
die();

}
    include('class_include/class_contenido_columna_one.php');
?>

<div class="mid">
    <div class="module">
        <div class="module">
            <h3>Donaciones</h3>
            <div class="content">
                <ul class="accounthead">
                    <li>
                        <a href="?mod=setting">Cuenta</a>
                    </li>
                    <li>
                        <a href="?mod=characters">Personajes</a>
                    </li>
                    <li>
                        <a href="?mod=clans">Clanes</a>
                    </li>
                    <li>
                        <a class="active">Comprar Coins</a>
                    </li>
                </ul>
                <script type="text/javascript">
                    function updateForm()
                    {
                        var premium = document.premium.amount.value;
                        var coins = premium*10
                        document.getElementById("coins").innerHTML = coins;

                        document.premium.item_name.value = coins + " Premium Coins";
                        document.premium.item_number.value = coins;
                    }
                </script>
               <p style="color: red; text-align: center"><b>AeroGamez existe gracias a los usuarios que forman esta gran comunidad.</b></p>
                <br>
                <br>
                <ul class="account">
                    <li> Manenter AeroGamez cuesta dinero, por lo cual agradeceremos tu participacion en la comunidad. </li>
                </ul>
                <br>
                <ul class="simple-tabs" id="demo-tabs">
                    <!--<li class="deposito-ve active"> (!) Depósito Venezuela</li>-->
                    <!--<li class="fortumo">Fortumo</li>-->
                    <li class="paygol">Paygol</li>
                    <!--<li class="paypal">Paypal</li>-->
                </ul>

                <div class="clear-float"></div>

                <!--<div id="deposito-ve" class="tab-page active-page">
                    <ul class="account">
                        <li> Ahora puedes obtener PC por depósito bancario en Venezuela! <br> En esta penstaña solo se tiene información para Venezuela.</li>
                    </ul>
                    <br>
                    <p>Tabla de precios por depósitos.</p>
                    <table class="latablitawey">
                        <tbody>
                            <tr>
                                <td class="lanegradapadre">25 BsF</td>
                                <td>40 Premium Coins</td>
                            </tr>
                            <tr>
                                <td class="lanegradapadre">50 BsF</td>
                                <td>80 Premium Coins</td>
                            </tr>
                            <tr>
                                <td class="lanegradapadre">100 BsF</td>
                                <td>160 Premium Coins</td>
                            </tr>
                            <tr>
                                <td class="lanegradapadre">150 BsF</td>
                                <td>240 Premium Coins</td>
                            </tr>
                            <tr>
                                <td class="lanegradapadre">200 BsF</td>
                                <td class="laverdesadapadre">340 Premium Coins</td>
                            </tr>
                            <tr>
                                <td class="lanegradapadre">400 BsF</td>
                                <td class="laverdesadapadre">700 Premium Coins</td>
                            </tr>
                            <tr>
                                <td class="lanegradapadre">600 BsF</td>
                                <td class="laverdesadapadre">1100 Premium Coins</td>
                            </tr>
                            <tr>
                                <td class="lanegradapadre">800 BsF</td>
                                <td class="laverdesadapadre">1500 Premium Coins</td>
                            </tr>
                            <tr>
                                <td class="lanegradapadre">1000 BsF</td>
                                <td class="laverdesadapadre">1900 Premium Coins</td>
                            </tr>
                            <tr>
                                <td class="lanegradapadre">1200 BsF</td>
                                <td class="laverdesadapadre">2400 Premium Coins</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <p>Mas información: <a href="#">click aquí</a>.</p>
                </div>-->

                <!--<div id="fortumo" class="tab-page"> 
                    <p><b>Ahora también puedes comprar por Fortumo</b></p><br>
                    <p>En esta penstaña tiene planes para el resto de paises.</p><br>
                    <p align="center">
                    <a id="fmp-button" href="#" rel="33771f289b428135c6c1d392e22e8d3f/174195" class="fmpboxElement">
                        <img src="//fortumo.com/images/fmp/fortumopay_96x47.png" width="96" height="47" alt="Mobile Payments by Fortumo" border="0">
                    </a>
                    </p>
                </div>-->

                <div id="paygol" class="tab-page active-page">
 <center>   
 <h1>Mantenimiento</h1>                    
<form name="pg_frm" method="post" action="https://www.paygol.com/pay" >
   <input type="hidden" name="pg_serviceid" value="123">
   <input type="hidden" name="pg_currency" value="EUR">
   <input type="hidden" name="pg_name" value="DEMO">
   <input type="hidden" name="pg_custom" value="">
   <input type="hidden" name="pg_price" value="1">
   <input type="hidden" name="pg_return_url" value="http://www.paygol.com/webapps/implementation">
   <input type="hidden" name="pg_cancel_url" value="">
   <input type="image" name="pg_button" src="https://www.paygol.com/webapps/img/buttons/150/black_en_pbm.png" border="0" alt="Realiza pagos con PayGol: la forma mas facil!" title="Realiza pagos con PayGol: la forma mas facil!" >     
</form>
</center>
                </div>

                <!--<div id="paypal" class="tab-page"> 
                    <b>Ahora también puedes comprar por PayPal</b><br>
                    <br>
                    <p>Recibirás 10 PCoins por cada dólar.</p><br>
                    <br>
                    Para donar selecciona la cantidad de dinero que quieres comprar<br>
                    y luego haz click en Pagar Ahora.<br>
                    <br>
                    <strong>Ten en cuenta que las PCoins serán enviadas a la cuenta en que estás logueado en este momento.</strong>
                    <br>
                    <br>
                    Si no recibes tus PCoins, contáctanos por el foro de Soporte.<br>
                    <br>
                    Selecciona la cantidad de dinero a pagar:<br><br>

                    <form name="premium" class="premium" action="https://www.paypal.com/cgi-bin/webscr" method="post" id="premium">
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="hidden" name="business" value="donate@articgamers.net">
                        <input type="hidden" name="lc" value="US">
                        <input type="hidden" name="currency_code" value="USD">
                        <input type="hidden" name="no_note" value="1">
                        <input type="hidden" name="no_shipping" value="1">
                        <input type="hidden" name="tax_rate" value="0.000">

                        <select name="amount" onchange="updateForm();">
                            <option value="5.00" selected="">5 USD</option>
                            <option value="10.00">10 USD</option>
                            <option value="20.00">20 USD</option>
                            <option value="50.00">50 USD</option>
                            <option value="100.00">100 USD</option>
                            <option value="200.00">200 USD</option>
                        </select>
                        <br><br><br>
                        Con esta compra recibirás <span id="coins" style="color: red">50</span> PCoins.
                        <input type="hidden" name="item_name" value="50 Premium Coins">
                        <input type="hidden" name="item_number" value="50">
                        <input type="hidden" name="custom" value="174195">
                        <script type="text/javascript">
                            updateForm();
                        </script><br><br>
                        <input type="image" src="https://www.paypal.com/es_ES/ES/i/btn/btn_paynow_LG.gif" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet."> <img alt="" border="0" src="https://www.paypal.com/es_XC/i/scr/pixel.gif" width="1" height="1"><br>
                    </form>
                </div>-->
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