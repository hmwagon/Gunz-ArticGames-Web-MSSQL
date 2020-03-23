<?php
    ModulsTitle("AeroGamez Gunz - Guerra de clanes");

    include('class_include/class_contenido_columna_one.php');
?>  
<div class="mid">
    <div class="module">
        <div>
            <h3>Rankings</h3>
            <ul class="shopcats">
                <p>Elegir la categoría</p>
                <a href="?mod=rankindividual&page=1"><li><i class="dki person"></i>Individual</li></a>
                <a href="?mod=rankcl&page=1"><li><i class="dki world"></i>Clan</li></a>
                <li class="active"><i class="dki star"></i>Guerra De Clan</li>
            </ul>
            <div>
                <table class="ranking">
                    <tbody>
                        <tr>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">&nbsp;</th>
                            <th scope="col">PUNTOS</th>
                            <th scope="col">&nbsp;</th>
                            <th scope="col">NOMBRE</th>
                        </tr>
                        <?
                        function img_clan2($clid){

                          $clan = mssql_fetch_array(mssql_query("SELECT EmblemUrl From Clan WHERE CLID='".$clid."' "));

                          return ($clan[0] == "") ? "noemblem.jpg" : $clan[0];

                        }

                        $select = mssql_query("SELECT TOP 30 * FROM ClanGameLog ORDER BY ID DESC");     


                       if(mssql_num_rows($select) <> 0) {

                         while($rowr = mssql_fetch_object($select)) {
                        ?>
                        <tr>
                            <td><?=$rowr->WinnerClanName?></td>
                            <td><img class="zoom_thumb" src="emblem/<?=img_clan2($rowr->WinnerCLID)?>"></td>
                            <td><span style="color:#00FF00;"><?=$rowr->RoundWins?></span>/<span style="color:#FF0000;"><?=$rowr->RoundLosses?></span></td>
                            <td><img class="zoom_thumb" src="emblem/<?=img_clan2($rowr->LoserCLID)?>"></td>
                            <td><?=$rowr->LoserClanName?></td>
                        </tr>
                        <?
                            }

                        }else{
                        ?>
                        <tr>
                            <td>No Data</td>
                            <td><img class="zoom_thumb" src="emblem/noemblem.jpg"></td>
                            <td><span style="color:#00FF00;">0</span>/<span style="color:#FF0000;">0</span></td>
                            <td><img class="zoom_thumb" src="emblem/noemblem.jpg"></td>
                            <td>No Data</td>
                        </tr>
                        <?
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
    include('class_include/class_contenido_columna_three.php');
?> 