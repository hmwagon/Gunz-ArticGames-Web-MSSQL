<?php
    include('class_include/class_contenido_columna_one.php');
ModulsTitle("AeroGamez Gunz - Descargas");
?>  
<script>
$(document).ready(function(e){

    $('.tabcontenido').hide().filter(':first').show();

    $('.Tcontenedor ul.shopcats li[data-mostrar]').on('click', function(){

        $('.Tcontenedor ul.shopcats li[data-mostrar]').removeClass('active');
        $('.tabcontenido').hide();

        var mostrar = $(this).data('mostrar');
        $(this).addClass('active');
        $('#' + mostrar).show();

    });
});
</script>
<div class="mid">
    <div class="longcontent">
        <!-- News Listing -->
        <div class="module">
            <div class="Tcontenedor">
                <ul class="shopcats">
                    <p>Elegir Categoría</p>
                    <li data-mostrar="elige1" class="active"><i class="dki add"></i>Descargas</li>
                    <li data-mostrar="elige2"><i class="dki wall"></i>Fondos de Pantalla</li>
                    <li data-mostrar="elige3"><i class="dki vid"></i>Videos</li>
                    <li data-mostrar="elige4"><i class="dki cam"></i>Capturas de pantalla</li>
                    <li data-mostrar="elige5"><i class="dki heart"></i>Kit fanático</li>
                </ul>
                <div id="elige1" class="tabcontenido">
                    <span class="centerfix">
                        <a href='http://updates.aerogamez.com/Installer_AeroGamez_v12.exe' class='big-download'>DESCARGA DEL CLIENTE COMPLETO</a>
                        <div id='filesize'><strong>1.3 MB</strong> Tamaño de Archivo</div>
                    </span>
                    <div align="center">
                        <p>¿Tuvo problemas con la descarga, no le ha funcionado o tuvo algún inconveniente? Pruebe con las opciones aquí debajo.</p>
                        <ul class="mirrors">
                            <li>
<a href="http://updates.aerogamez.com/Installer_AeroGamez_v12.exe" target="_blank">» Enlace 1: Descarga Directa 1.3MB «</a>
<a href="https://mega.nz/#!XlohhQAC!DnxPP6o4IwufA-7tZciTzrkZnlt9555Zo0lgM-ekjiY" target="_blank">» Enlace 1: Mega Cliente Completo «</a>
<a href="https://www.dropbox.com/s/e57wq3p9p4684dv/Cliente_Completo_AeroGamezGunzv12.exe?dl=0" target="_blank">» Enlace 1: Dropbox Cliente Completo «</a>
</li><li></li>
                        </ul>
                        <p class="borderbottom">Consulte esta tabla para ver si su computadora puede ejecutar AeroGunZ</p>
                    </div>
                    <table class="pcrequirements">
                        <tbody>
                            <tr>
                                <th></th>
                                <th scope="col">Requerimientos Mínimos</th>
                                <th scope="col">Requerimientos Recomendados</th>
                            </tr>
                            <tr>
                                <th scope="row">CPU</th>
                                <td>Pentium IV 2.0 GHz</td>
                                <td>Core 2 Duo 3.33 GHz</td>
                            </tr>
                            <tr>
                                <th scope="row">Memory</th>
                                <td>1.8 GB</td>
                                <td> 3 GB or more</td>
                            </tr>
                            <tr>
                                <th scope="row">Video Card</th>
                                <td>Direct3D 9.0 Compatible</td>
                                <td>GeForce 4 MX or Better</td>
                            </tr>
                            <tr>
                                <th scope="row">Hard Drive Space</th>
                                <td>700 GB Space</td>
                                <td>1.5 GB Space</td>
                            </tr>
                            <tr>
                                <th scope="row">Operating System</th>
                                <td>Windows XP, Windows Vista</td>
                                <td>Windows 7, Windows 8.0 or 8.1 or 10</td>
                            </tr>
                            <tr>
                                <th scope="row">Direct X</th>
                                <td>DirectX 9 or higher</td>
                                <td>DirectX 9.0c or higher</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="borderbottom">Por Favor actualiza sus drivers para tener un mejor rendimiento óptimo cuando juegue AeroGunz</p>
                    <span class="driverdownloads">
                        <a href="https://www.microsoft.com/en-us/download/details.aspx?id=17851" class="btn large">NET FrameWork</a>
                        <a href="https://www.microsoft.com/es-es/download/details.aspx?id=34429" class="btn large">DirectX 9.0c</a>
                    </span>
                    <br>                
                </div>
                <div id="elige2" class="tabcontenido">

                </div>
                <div id="elige3" class="tabcontenido">

                </div>
                <div id="elige4" class="tabcontenido">

                </div>
            </div>
        </div>
	</div>
</div>