<?php
    ModulsTitle("ArticGames Gunz - Leadder Ranking");
    include('class_include/class_contenido_columna_one.php');
?>  
<div class="mid">
    <div class="module">
        <div>
            <h3><?php print RANKING_7;?></h3>
            <ul class="shopcats">
                <p><?php print RANKING_8;?></p>
                <a href="?mod=rankindividual&page=1"><li><i class="dki person"></i><?php print RANKING_9;?></li></a>
                <a href="?mod=rankcl&page=1"><li><i class="dki world"></i><?php print RANKING_10;?></li></a>
                <li class="active"><i class="dki stats"></i><?php print RANKING_11;?></li>
                <a href="?mod=rankcw"><li><i class="dki star"></i><?php print RANKING_12;?></li></a>
            </ul>
            <div>
               <table class="ranking">
                    <tbody>
                        <tr>
                            <th scope="col">RANK</th>
                            <th scope="col">&nbsp;</th>
                            <th scope="col"><?php print NAMERANKING;?></th>
                            <th scope="col">&nbsp;</th>
                            <th scope="col"><?php print POINTRANKING;?></th>
                        </tr>
                        <tr>
                            <td><span class="pos">1</span></td>
                            <td><img class="zoom_thumb" src="/img/ladder/5.png"></td>
                            <td>ComingSoon</td>
                            <th scope="col">&nbsp;</th>
                            <td>ComingSoon</td>
                        </tr>
                        <tr>
                            <td><span class="pos">2</span></td>
                            <td><img class="zoom_thumb" src="/img/ladder/5.png"></td>
                            <td>ComingSoon</td>
                            <th scope="col">&nbsp;</th>
                            <td>ComingSoon</td>
                        </tr>
                        <tr>
                            <td><span class="pos">3</span></td>
                            <td><img class="zoom_thumb" src="/img/ladder/5.png"></td>
                            <td>ComingSoon</td>
                            <th scope="col">&nbsp;</th>
                            <td>ComingSoon</td>
                        </tr>
                        <tr>
                            <td><span class="pos">4</span></td>
                            <td><img class="zoom_thumb" src="/img/ladder/5.png"></td>
                            <td>ComingSoon</td>
                            <th scope="col">&nbsp;</th>
                            <td>ComingSoon</td>
                        </tr>
                        <tr>
                            <td><span class="pos">5</span></td>
                            <td><img class="zoom_thumb" src="/img/ladder/5.png"></td>
                            <td>ComingSoon</td>
                            <th scope="col">&nbsp;</th>
                            <td>ComingSoon</td>
                        </tr>
                        <tr>
                            <td><span class="pos">6</span></td>
                            <td><img class="zoom_thumb" src="/img/ladder/5.png"></td>
                            <td>ComingSoon</td>
                            <th scope="col">&nbsp;</th>
                            <td>ComingSoon</td>
                        </tr>
                    </tbody>
                </table>
                <ul class="pagination">
                    <ul class="pagination">
                        <!-- Previous page link -->
                        <li><a href="#"><?php print RANKING_13;?></a></li>
                        <!-- Numbered page links -->
                        <li><a href="#" class="active">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href="">5</a></li>
                        <!-- Next page link -->
                        <li><a href=""><?php print RANKING_14;?></a></li>
                    </ul>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php
    include('class_include/class_contenido_columna_three.php');
?> 