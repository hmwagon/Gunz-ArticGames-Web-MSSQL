<?

if($_SESSION[AID] == ""){

    Messenger_Gunz (MODULS_2,"index.php");
    die();
}

    $myAID = Clean($_SESSION[AID]);
    $CLID = Clean($_GET['CLID']);


$query = mssql_query ("SELECT * FROM Clan WHERE CLID = '$CLID' and Name IS NOT NULL");

if (mssql_num_rows($query) == 0){

    Messenger_Gunz("El ClanID: $CLID no exsit o se elimina","index.php");
    die();

    }else{

        $queryinfo = mssql_fetch_object($query);

        $Name = $queryinfo->Name;
        ModulsTitle("AeroGamez Gunz - Clan $Name");
        $EmblemUrl = $queryinfo->EmblemUrl;

        if ($EmblemUrl == NULL){

            $EmblemUrl = 'emblem/noemblem.jpg';
        }

        $ranking = $queryinfo->Ranking;
        $Wins = $queryinfo->Wins;
        $Losses = $queryinfo->Losses;
        $Points = $queryinfo->Point;
        $TotalPoints = $queryinfo->TotalPoint;
        $CreationDate = $queryinfo->RegDate;
        $MasterCID = $queryinfo->MasterCID;
        $MCQuery = Mssql_query ("SELECT AID FROM Character WHERE CID = '$MasterCID'");
        $MCQueryinfo = mssql_fetch_object($MCQuery);
        //$MasterName = $MCQueryinfo->Name;
        $MasterAID = $MCQueryinfo->AID;
        If ($myAID == $MasterAID){
        $isleader = 1;
    }

}

if ($_GET['leaveclan'] != ""){

    $leaveCID = Clean($_GET['leaveclan']);

    if ($_GET['confirm'] == "true"){

        $checkcid = mssql_query ("SELECT Name FROM Character WHERE AID = $myAID and DeleteFlag = 0 and CID = $leaveCID");

        if (mssql_num_rows($checkcid) == 1 && $isleader != 1){

            $checkcidinfo = mssql_fetch_assoc ($checkcid);
            $leaveNAME = $checkcidinfo['Name'];
            $checkclan = mssql_query ("SELECT Grade FROM ClanMember WHERE CLID = $CLID and CID = $leaveCID");

        if (mssql_num_rows($checkclan) == 1){

            $checkclaninfo = mssql_fetch_object ($checkclan);
            $checkgrade = $checkclaninfo->Grade;

        if ($checkgrade == 2){

            $checkgradestr = 'Administrator';
        }else{
            $checkgradestr = 'Normal Member';
        }

        mssql_query ("DELETE FROM ClanMember WHERE CLID = $CLID and CID = $leaveCID");
        Messenger_Gunz("Your Characrer: $leaveNAME as $checkgradestr in Clan: $Name has left it Successfully!","index.php");
        die();

        }else{

            Messenger_Gunz("There was an Error, please check your Clan Grade or your entered Link!","?mod=infoclan&CLID=$CLID");
            die();
        }

    }else{

        Messenger_Gunz("There was an Error, please check your Clan Grade or your entered Link!","?mod=infoclan&CLID=$CLID");
        die();
    }

    }else{

        $linkconfirm = '<a href="?mod=infoclan&CLID=' . $CLID . '&leaveclan=' . $leaveCID . '&confirm=true">?mod=infoclan&CLID=' . $CLID . '&leaveclan=' . $leaveCID . '&confirm=true</a>';
        Messenger_Gunz("","?mod=infoclan&CLID=$CLID");
        //Setmessage ("Message From Administration Panel",  Array("Do you really want to leave Clan: $Name?", "If yes, Please Click this link Below!", "$linkconfirm"));
        die();
    }

}elseif ($_GET['resetclanscore'] == "true"){

if ($isleader == 1){

    mssql_query ("UPDATE Clan SET Ranking=0, Wins=0, Losses=0, Point=1000, RankIncrease=0, LastDayRanking=0 WHERE CLID = $CLID");
    Messenger_Gunz("You have Successfully reseted your Clan $Name","?mod=infoclan&CLID=$CLID");
    die();

    }else{
        Messenger_Gunz("There was an Error, please check your Clan Grade or your entered Link!","?mod=infoclan&CLID=$CLID");
        die();
    }
}

if ($isleader != 1){

    $myqueryx = mssql_query ("SELECT CID FROM Character WHERE AID = '$myAID' and DeleteFlag = 0");
    While ($myqueryxinfo = mssql_fetch_object($myqueryx)){

        $querys = mssql_query ("SELECT Grade FROM ClanMember WHERE CID = '$myqueryxinfo->CID' and CLID = $CLID");
        $mygradex = mssql_fetch_object($querys);
        $mygradexx = $mygradex->Grade;
        if ($mygradexx == 2){

            $isleader = 2;
            break;
        }
    }
}
                
if ($_GET['kick'] != ""){

    $kick = Clean($_GET['kick']);


    $query1 = mssql_query ("SELECT Grade, CID FROM ClanMember Where CLID = $CLID and CID = $kick");
    $query1info = mssql_fetch_object($query1);
    $kickCID = $query1info->CID;
    $kickGrade = $query1info->Grade;

    $query3 = mssql_query ("SELECT Name From Character WHERE CID = $kickCID");
    $query3info = mssql_fetch_assoc($query3);
    $kickName = $query3info['Name'];

    if ($isleader < $kickGrade){

        mssql_query("DELETE FROM ClanMember Where CLID = $CLID And CID = $kickCID");
        Messenger_Gunz("You have just kicked $kickName out Successfully!","?mod=infoclan&CLID=$CLID");
        die();

    }else{
        Messenger_Gunz("There was an Error, please check your Clan Grade or your entered Link!","?mod=infoclan&CLID=$CLID");
        die();
    }


    /*setmessage ("Mensaje del sistema", Array("Kick function is Under Construction!"));
    header("Location: index.php?do=Clanadmin&CLID=$CLID");
    die(); */

}elseif ($_GET['demote'] != ""){


    $demote = Clean($_GET['demote']);


    $query1 = mssql_query ("SELECT Grade, CID FROM ClanMember Where CLID = $CLID and CID = $demote");
    $query1info = mssql_fetch_object($query1);
    $demoteCID = $query1info->CID;
    $demoteGrade = $query1info->Grade;

    $query3 = mssql_query ("SELECT Name From Character WHERE CID = $demoteCID");
    $query3info = mssql_fetch_assoc($query3);
    $kickName = $query3info['Name'];



    if ($isleader == 1 && $demoteGrade == 2){

        mssql_query("UPDATE ClanMember SET Grade = 9 Where CLID = $CLID And CID = $demoteCID");
        Messenger_Gunz("You have just demoted $kickName Successfully!","?mod=infoclan&CLID=$CLID");
        die();

    }else{
        Messenger_Gunz("There was an Error, please check your Clan Grade or your entered Link!","?mod=infoclan&CLID=$CLID");
        die();
    }


}elseif ($_GET['promote'] != ""){

    $promote = Clean($_GET['promote']);

    $query1 = mssql_query ("SELECT Grade, CID FROM ClanMember Where CLID = $CLID and CID = $promote");
    $query1info = mssql_fetch_object($query1);
    $promoteCID = $query1info->CID;
    $promoteGrade = $query1info->Grade;

    $query3 = mssql_query ("SELECT Name From Character WHERE CID = $promoteCID");
    $query3info = mssql_fetch_assoc($query3);
    $kickName = $query3info['Name'];



    if ($isleader == 1 && $promoteGrade  == 9){

        mssql_query("UPDATE ClanMember SET Grade = 2 Where CLID = $CLID And CID = $promoteCID");
        Messenger_Gunz("You have just promoted $kickName Successfully!","?mod=infoclan&CLID=$CLID");
        die();

    }else{
        Messenger_Gunz("There was an Error, please check your Clan Grade or your entered Link!","?mod=infoclan&CLID=$CLID");
        die();
    }

}elseif ($_GET['closeclan'] != ""){

    if ($_GET['closeclan'] == 'true' && $isleader == 1){
        if ($_GET['confirm'] == 'true'){
            Mssql_query ("DELETE FROM ClanMember WHERE CLID = $CLID");
            Mssql_query ("DELETE FROM Clan WHERE CLID = $CLID");
            Messenger_Gunz("You have just Deleted (Closed) your Clan: $Name Successfully!","?mod=infoclan&CLID=$CLID");
            die();
        }else{

            $linkconfirm = '<a href="?mod=infoclan&CLID=' . $CLID . '&closeclan=true&confirm=true">?mod=infoclan&CLID=' . $CLID . '&closeclan=true&confirm=true</a>';
            Messenger_Gunz("","?mod=infoclan&CLID=$CLID");
            //Setmessage ("Mensaje del sistema Panel", Array("Do you really want to Close (Delete) Clan: $Name?", "If yes, Please Click this link Below!", "$linkconfirm"));
            die();
        }

    }else{
        Messenger_Gunz("There was an Error, please check your Clan Grade or your entered Link!","?mod=infoclan&CLID=$CLID");
        die();
    }
}

$membersinlistcount = mssql_num_rows(Mssql_query ("SELECT * FROM ClanMember WHERE CLID = '$CLID'"));
include('class_include/class_contenido_columna_one.php');
?>
<div class="mid">
<div class="module">
    <h3>Administracion de Clan</h3>
    <div class="content">
        <ul class="registerform">
            <h1><?=$Name?></h1>
            <img class="laimgpodrida" src="emblem/<?=$EmblemUrl?>" />
            <!--<center>Upload Emblem<br></center>-->
			<div align="center">
			<h1>Ranking: <?=$ranking?></h1><br>
            Point: <?=$Points?><br>
            TotalPoint: <?=$TotalPoints?><br>
            Ganados/Perdidas: <?=$Wins.'/'.$Losses?><br>
            Clan Creado: <?=$CreationDate?><br>
            Lista de Miembros: <?=$membersinlistcount?><br>
			<div>
            <br>
            <table class="sample" id="LATABLA" data-clid="56281">
                <tbody>
                <? //PHP code here
                $ClanMemberquery = Mssql_query ("SELECT * FROM ClanMember WHERE CLID = '$CLID'");

                if (Mssql_num_rows($ClanMemberquery) != 0){

                    echo '<tr class="lanegradapadre">
                            <td>Name</td>
                            <td>Level</td>
                            <td>Rank</td>
                            <td>JoinDate</td>
                            <td>CwPoints</td>
                            <td>Options</td>
                    </tr>';
                While ($CMemberqueryinfo = mssql_fetch_object($ClanMemberquery)){

                    $CMREGD = $CMemberqueryinfo->RegDate;
                    $CMCWP = $CMemberqueryinfo->ContPoint;
                    $CMCID = $CMemberqueryinfo->CID;
                    $CMNamequery = mssql_query ("SELECT Name, Level, AID FROM Character WHERE CID = '$CMCID'");
                    $CMNamequeryinfo = mssql_fetch_object($CMNamequery);
                    $CMName = $CMNamequeryinfo->Name;
                    $CMLevel = $CMNamequeryinfo->Level;
                    $CMRank = $CMemberqueryinfo->Grade;
                    $CMAID = $CMNamequeryinfo->AID;
                    $CMANameqq = Mssql_query("SELECT UGradeID FROM Account WHERE AID = '$CMAID'");
                    $CMANameinfo = mssql_fetch_assoc($CMANameqq);
                    $CMAUGrade = $CMANameinfo['UGradeID'];
                            

                if ($isleader == 1 && $CMRank == 9){

                    $Options = '<a
                        href="?mod=infoclan&CLID=' . $CLID . '&kick=' . $CMCID . '">Kick</a><big> - </big><a
                        href="?mod=infoclan&CLID=' . $CLID . '&promote=' . $CMCID . '">Promote</a>';
                        
                        }elseif($isleader == 1 && $CMRank == 2){

                    $Options = '<a
                         href="?mod=infoclan&CLID=' . $CLID . '&kick=' . $CMCID . '">Kick</a><big> - </big><a
                         href="?mod=infoclan&CLID=' . $CLID . '&demote=' . $CMCID . '">Demote</a>';
                         
                        }elseif ($isleader == 2 && $CMRank == 9){ 

                    $Options = '<a
                        href="?mod=infoclan&CLID=' . $CLID . '&kick=' . $CMCID . '">Kick</a>';
                        }elseif ($isleader == 1 && $CMRank == 1){

                    $Options = '<a href="?mod=infoclan&CLID=' . $CLID . '&closeclan=true"><span style="font-weight: bold; color: rgb(255, 0, 0);">Close Clan</span> <br><a href="?mod=infoclan&CLID=' . $CLID . '&resetclanscore=true"><span style="font-weight: bold; color: rgb(200, 20, 255);">Reset Score</span></a>';
                        }elseif ($CMAID == $myAID){

                    $Options = '<a style="color: rgb(255, 204, 0);" href="?mod=infoclan&CLID=' . $CLID . '&leaveclan=' . $CMCID . '"><span style="font-weight: bold;">Leave Clan</span></a>';
                        }else{

                    $Options = '<span style="font-style: italic;">None</span>'; 
                        }    
            
                switch ($CMRank){
                    Case 9;
                    $CMRankstr = '<span style="font-weight: bold; color: rgb(255, 204, 255);">Member</span>';
                    Break;
                    Case 2;
                    $CMRankstr = '<span style="font-weight: bold; color: rgb(51, 255, 51);">Administrator</span>';
                    Break;
                    Case 1;
                    $CMRankstr = '<span style="font-weight: bold; color: rgb(255, 0, 0);">Leader</span>';
                    Break;
                    Default;
                    $CMRankstr = '<span style="font-weight: bold; color: rgb(102, 0, 0);">Member</span>';
                    Break;
                }
                                
                ?>
                <tr>
                    <td><a href="?mod=infochar&itemid=<?echo '' . $CMCID . ''; ?>"><?=FormatCharNameclanadmin($CMName, $CMAUGrade)?></a></td>
                    <td><?=$CMLevel?></td>
                    <td><?=$CMRankstr?></td>
                    <td><?=$CMREGD?></td>
                    <td><?=$CMCWP?></td>
                    <td><?=$Options?></td>
                </tr>
                <?
                    }
                }else{
                    
                ?>
                <tr>
                    <td>No Data</td><td>0</td><td>0</td><td>No Data</td>
                </tr>
                <?
                }
                ?>
                </tbody>
            </table>        
            </br\></br\></br\></br\></br\></br\></br\></br\></br\></br\>
        </ul>
    </div>
</div> 
</div>
<?php
    include('class_include/class_contenido_columna_three.php');
?>           