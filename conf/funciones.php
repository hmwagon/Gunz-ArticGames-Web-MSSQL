<?php
	
date_default_timezone_set('America/New_York');

function Go_URL($url) {
    echo "<script>document.location = '$url'</script>";
}

function Messenger_Gunz($text, $url) {
    echo " <div id='popup' style='position: absolute; z-index: 9999; display: block; opacity: 1; left: 433px; top: 54.5px;'>
			<span class='button b-close'> <span>X</span></span>
			<h2 align='center'>Messenger AeroGamez</h2>
			<ul>
				<li>$text</li>
			</ul>
			<br />
			<center><a style='color:#000;font-weight: bold; font-size:15px;' href='$url'>Aceptar</a></center> 
		</div>";
}

function mssql_query_logged($query)
{
    return mssql_query($query);
}

function clean($sql) {
    $sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|'|drop table|:|show tables|#|\*|--|\\\\)/"), "", $sql);
    $sql = trim($sql);
    $sql = strip_tags($sql);
    $sql = addslashes($sql);
    return $sql;
}
function ModulsTitle($title)
{
    $_SESSION[PageTitle] = $title;
}
function GetCharNameByCID($cid)
{
    $ncid = clean($cid);
    $a = mssql_fetch_assoc(mssql_query("SELECT Name FROM Character(nolock) WHERE CID = '$ncid'"));
    return $a[Name];
}
function GetClanPercent($Wins, $Losses)
{
    $total = $Wins + $Losses;

    return ($total == 0) ? "0%" : round((100 * $Wins) / $total, 2) . "%";
}

function GetKDRatio($kills, $deaths)
{
    $total = $kills + $deaths;

    $percent = @round((100 * $kills) / $total, 2);

    if($kills == 0 && $deaths == 0)
    {
        return "0 / 0 (100%)";
    }else{
        return sprintf("%d / %d (%d%%)", $kills, $deaths, $percent);
    }
}

function ranking_individual_update()
{
mssql_query("UPDATE Character SET Ranking='0'");
$r = mssql_query("SELECT TOP 142 CID From Character WHERE DeleteFlag='0' Order By Level Desc, XP Desc");
$i = 1;
while($rank = mssql_fetch_row($r)){
	mssql_query("UPDATE Character SET Ranking='$i' WHERE CID='$rank[0]'");
	$i++;
}
}
function ranking_clan_update()
{
mssql_query("UPDATE Clan SET Ranking='0'");
$r = mssql_query("SELECT TOP 142 CLID From Clan WHERE DeleteFlag='0' Order by Point desc");
$i = 1;
while($rank = mssql_fetch_row($r)){
	mssql_query("UPDATE Clan SET Ranking='$i' WHERE CLID='$rank[0]'");
	$i++;
}
}

function CheckIfExistClan($aid){
    $aid = clean($aid);
    $a = mssql_query("SELECT * FROM Character(nolock) WHERE AID = '$aid'");
    if( mssql_num_rows($a) > 0 )
    {
        while($char = mssql_fetch_assoc($a))
        {	

            if(mssql_num_rows(mssql_query("SELECT * FROM Clan(nolock) WHERE MasterCID = '".$char[CID]."' AND (DeleteFlag=0 OR DeleteFlag=NULL)")) == true ){
                
            	return true;
            	break;

            }else{

            	return false;
            }
        }
    }
    return false;
}

function GetClanMasterByCLID($clid)
{
    $clanid = clean($clid);

    $res2 = mssql_query("SELECT ch.Name FROM Character(nolock) ch INNER JOIN Clan(nolock) cl ON ch.CID = cl.MasterCID WHERE cl.CLID = '$clanid'");

    $char = mssql_fetch_row($res2);


    return $char[0];
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////shop
function GetTypeByID($cat)
{
    switch($cat)
    {
        case 1:
            $type = "Armaduras";
        break;
        case 2:
            $type = "Espadas";
        break;
        case 3:
            $type = "Armas";
        break;
        case 4:
            $type = "Especiales";
        break;
        default:
            $type = "Armas";
        break;
    }

    return $type;
}
function GetSexByID($sid)
{
    switch($sid)
    {
        case 0:
            return "Hombre";
        break;
        case 1:
            return "Mujer";
        break;
        case 2:
            return "Todos";
        break;
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function FormatCharNameclanadmin($name, $rank)
{
    switch($rank)
    {
        case 0:
            return $name;
        break;
        case 2:
            return "<font color='#FFF200'>$name</font>";
        break;
        case 104:
            return "<font color='#525252'>$name</font>";
        break;
        case 252:
            return "<font color='#33CC00'>$name</font>";
        break;
        case 253:
            return "<strike><font color='#000000'>$name</font></strike>";
        break;
        case 254:
            return "<font color='#00E1FF'>$name</font>";
        break;
        case 255:
            return "<font color='#ff7700'>$name</font>";
        break;
        default:
            return "<font color='4C0094'>$name</font>";
        break;
    }
} 
    //RECORD ONLINE
    function RecordOnline() {
    $b = mssql_fetch_array(mssql_query("SELECT TOP 1 PlayerCount FROM ServerLog ORDER BY PlayerCount DESC")); 
    echo $b['PlayerCount'];
}
?>