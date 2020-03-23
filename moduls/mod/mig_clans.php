<?php
if($_SESSION[AID] == ""){

    Messenger_Gunz (MODULS_2,"index.php");
    die();
}

include('class_include/class_contenido_columna_one.php');
?>
<div class="mid">
            				<!-- News Listing -->
                                <div class="module">
                    <script>
    function GetClans() {
        var x = document.getElementById("clanselect").value;
        ZPOSTCMD1("/account/clans", x);
    }
    function PrePost(hrefz0r) {
        var linkz0r = "/account/";
        var linkz0r2 = hrefz0r.getAttribute('id');
        var res = linkz0r.concat(linkz0r2);
        var cid = hrefz0r.getAttribute('data-cid');
        var clid = document.getElementById('LATABLA').getAttribute('data-clid');
        ZPOSTCMD2(res, cid, clid)
    }
</script>


<div class="module">
    <h3>Panel de Cuenta</h3>
    <div class="content">
        <ul class="accounthead">
            <li>
                <a href="?mod=setting">Cuenta</a>
            </li>
            <li>
                <a href="?mod=characters">Personajes</a>
            </li>
            <li>
                <a class="active">Clanes</a>
            </li>
            <li>
                <a href="?mod=premium">Buy premium</a>
            </li>
        </ul>
        <ul class="registerform">
                        <li><form>
                <select id="clanselect" name="clanselect" onchange="GetClans()">
                    <option value="">Select the clan you want to see</option>
                    <option value="56281">BeyonTheSoul</option>                </select>
            </form></li>
                        <br>
            <h1>BeyonTheSoul</h1><br\><br\><img class="laimgpodrida" src="http://emblem.articgamers.net/emblems/noemblem.jpg" \=""><center>Upload Emblem<br></center><br\><br\><h2>Ranking: 0</h2><br\><br\><br\><br\><br\><br\><table class="sample" id="LATABLA" data-clid="56281"><tbody><tr class="lanegradapadre"><td>Name</td><td>Level</td><td>Points</td><td>Grade</td></tr><tr><td>Giscayne</td><td>53</td><td>0</td><td>Master</td></tr><tr><td>gohan7</td><td>33</td><td>0</td><td>Member</td><td><a href="#" id="promote" onclick="PrePost(this)" data-cid="312082"> Promote </a></td><td><a href="#" id="kick" onclick="PrePost(this)" data-cid="312082"> Kick </a></td></tr><tr><td>zl[Fancy]lz</td><td>21</td><td>0</td><td>Member</td><td><a href="#" id="promote" onclick="PrePost(this)" data-cid="312234"> Promote </a></td><td><a href="#" id="kick" onclick="PrePost(this)" data-cid="312234"> Kick </a></td></tr><tr><td>Boatix777</td><td>36</td><td>0</td><td>Member</td><td><a href="#" id="promote" onclick="PrePost(this)" data-cid="312174"> Promote </a></td><td><a href="#" id="kick" onclick="PrePost(this)" data-cid="312174"> Kick </a></td></tr><tr><td>OnlyGirl</td><td>24</td><td>0</td><td>Member</td><td><a href="#" id="promote" onclick="PrePost(this)" data-cid="309951"> Promote </a></td><td><a href="#" id="kick" onclick="PrePost(this)" data-cid="309951"> Kick </a></td></tr></tbody></table>        </br\></br\></br\></br\></br\></br\></br\></br\></br\></br\>
            </ul>
    </div>
</div>                </div>
                			</div>
<?php
include('class_include/class_contenido_columna_three.php');
?>
