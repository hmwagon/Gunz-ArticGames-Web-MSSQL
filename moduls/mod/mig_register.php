<?php
ModulsTitle("AeroGamez Gunz - Register");


if($_SESSION[UserID] != "") {

    Messenger_Gunz ("Debe cerrar sesion primero antes de hacer otra cuenta.","index.php");
    die();
}

if(isset($_POST[submit]))
{
    $user           = clean($_POST[userid]);
    $names          = clean($_POST[namea]);
    $email[0]       = clean($_POST[email1]);
    $email[1]       = clean($_POST[email2]);
    $age            = clean($_POST[age]);
    $sex            = clean($_POST[sex]);
    $CountryID      = clean($_POST[CountryID]);
    $question       = clean($_POST[question]);
    $answer         = clean($_POST[answer]);
    $pass[0]        = clean($_POST[pass1]);
    $pass[1]        = clean($_POST[pass2]);
    $recaptcha      = clean($_POST['g-recaptcha-response']);


    $secret = "6Lfw6RYUAAAAABu3XJHbt-omtTdSYN1v8MMwTS5C";
    $ip = $_SERVER['REMOTE_ADDR'];
    $var = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$recaptcha&remoteip=$ip");
    $array = json_decode($var, true);

    $keyWeb         = "6Lfw6RYUAAAAAFgTMzAOzbNHkVqu6TQwOBvh9hmB";
    $KeySecreta     = "6Lfw6RYUAAAAABu3XJHbt-omtTdSYN1v8MMwTS5C";

/*
When your users submit the form where you integrated reCAPTCHA, you'll get as part of the payload a string with the name 
"g-recaptcha-response". In order to check whether Google has verified that user, send a POST request with these parameters:

URL: https://www.google.com/recaptcha/api/siteverify

secret (required) 6Lfefg8TAAAAAArKPUtO-oJSpgvuPkNb1bjeI9hG
response (required) El valor de "g-recaptcha-response".
remoteip  The end user's ip address.
*/


    if (mssql_num_rows( mssql_query("SELECT * FROM Account(nolock) WHERE UserID = '$user'") ) <> 0 ) {

        Messenger_Gunz ("The UserID $userid is already in use","?mod=register");
        die();

    } elseif ($user == "") {

        Messenger_Gunz ("Please enter a UserID","?mod=register");
        die();

    } elseif (strlen($user) < 3){

        Messenger_Gunz ("The user ID is too short (6 characters min)","?mod=register");
        die();
        
    } elseif (strlen($user) > 14){                                               

        Messenger_Gunz ("The user ID is too short (6 characters min)","?mod=register");
        die();
        
    } elseif ($names == "") {

        Messenger_Gunz ("Porfavor Escriba un nombre","?mod=register");
        die();

    } elseif ( mssql_num_rows( mssql_query("SELECT * FROM Account(nolock) WHERE Email = '$email'") ) <> 0 ){

        Messenger_Gunz ("The Email $email is already in use","?mod=register");
        die();

    } elseif ($email[0] != $email[1]){

        Messenger_Gunz ("Please enter an email address","?mod=register");
        die();
  
    } elseif ($email[0] == "" || $email[1] == "") {
        
         Messenger_Gunz ("Please enter an email address","?mod=register");
         die();

    } elseif ($age == "") {

        Messenger_Gunz ("Por favor Seleccione su edad","?mod=register");
        die();

    } elseif ($sex == "") {

        Messenger_Gunz ("Por favor Seleccione su Sexo","?mod=register");
        die();

    } elseif ($CountryID == "") {
       
        Messenger_Gunz ("Por favor Seleccione su país","?mod=register");
        die();

    } elseif ($question == "") {
        
        Messenger_Gunz ("Por favor Seleccione Una pregunta Secreta","?mod=register");
        die();

    } elseif ($answer == "") {
        
        Messenger_Gunz ("Por favor coloque una respuesta secreta","?mod=register");
        die();

    } elseif (strlen($answer) > 30) {
        
        Messenger_Gunz ("Su Respuesta secreta es muy larga","?mod=register");
        die();

    } elseif (strlen($answer) < 3) {
        
        Messenger_Gunz ("Su Respuesta secreta es muy larga","?mod=register");
        die();

    } elseif (ereg('[^A-Za-zñÑ0-9_]{1,64}', $answer)) {

        Messenger_Gunz ("La Respuesta secreta tiene caracteres especiales, intente solo numeros y letras.","?mod=register");
        die();

    } elseif ($pass[0] != $pass[1]) {
        
        Messenger_Gunz ("La contraseña no coincide","?mod=register");
        die();

    } elseif ($pass[0] == "" || $pass[1] == "") {
        
         Messenger_Gunz ("Please enter a password","?mod=register");
         die();

    } elseif (strlen($pass[0]) < 6){

        Messenger_Gunz ("Password is too short (6 characters min to 16)","?mod=register");
        die();
     
    
    } elseif (strlen($pass[0]) > 16){   

        Messenger_Gunz ("Password is too short (6 characters min to 16)","?mod=register");
        die();
     
    
    } elseif (ereg('[^A-Za-zñÑ0-9_]{1,64}', $pass[0])) {
        
        Messenger_Gunz ("La contraseña posee caracteres especiales, intente solo numeros y letras.","?mod=register");
        die();

    }else{

        if ($array['success']) {

            mssql_query("INSERT INTO Account (UserID, UGradeID, PGradeID, RegDate, Name, Email, Age, Sex, CountryID, Question, Answer)Values ('$user', 0, 0, GETDATE(), '$names', '$email[0]', '$age', '$sex', '$CountryID', '$question', '$answer')");
            
            $res = mssql_query("SELECT * FROM Account WHERE UserID = '$user'");
            $usr = mssql_fetch_assoc($res);
            $aid = $usr['AID'];
            
            //Items al registrarce
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900416', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '934524', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '934867', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '9096896', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '9056496', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '9018786', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '96775786', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '90196786', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '93453666', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '954809', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '922104', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '922106', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '998107', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '999107', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '934109', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '934309', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '945309', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '934701', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '934561', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900111', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900112', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '967866', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '905116', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '967868', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '967867', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '901105', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '901107', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900325', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '901165', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '986500', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '986506', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '901100', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900100', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900101', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900103', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900104', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900105', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900106', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900107', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900108', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900109', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900110', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900113', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900114', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900115', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900116', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900117', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900118', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900119', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900120', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900121', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900122', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900123', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900124', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900125', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900126', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '922126', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900127', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900128', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900129', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900130', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900132', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900133', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900134', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900135', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900136', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900137', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900138', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900139', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900140', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900141', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900142', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900143', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900144', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900145', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900146', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900147', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900148', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900149', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900150', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900151', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900152', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900153', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900154', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900155', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900156', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900157', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900158', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900159', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900160', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900161', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900162', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900163', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900164', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900165', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900166', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900167', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900168', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900169', GETDATE(), '120', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900170', GETDATE(), '120', '1')");


mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900401', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900402', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900403', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900405', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900406', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900407', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900408', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900409', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900410', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900411', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900412', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900413', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900414', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900415', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900417', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900418', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '900419', GETDATE(), '200', '1')");


mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731001', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731002', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731003', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731004', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731005', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731006', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731007', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731008', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731009', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731010', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731011', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731012', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731013', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731014', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731015', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731016', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731017', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731018', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731019', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731020', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731021', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731022', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731023', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731024', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731025', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731026', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731027', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731028', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731029', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731030', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731031', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731032', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731033', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731034', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731035', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731036', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731037', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731038', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731039', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731040', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731041', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731042', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731043', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731044', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731045', GETDATE(), '200', '1')");
mssql_query("INSERT INTO AccountItem([AID], [ItemID], [RentDate], [RentHourPeriod], [Cnt])Values('$aid', '731046', GETDATE(), '200', '1')");

            
            mssql_query("INSERT INTO Login ([UserID], [AID], [Password])Values ('$user', '$aid', '$pass[0]')");

            Messenger_Gunz ("La Cuenta <b> $user </b> se Creado Correctamente!! Bienvenido a AeroGamez Gunz","index.php");
            die();
            
        }else{
            
            Messenger_Gunz ("Por favor Complete recaptcha para comprobar que no eres un robot.","?mod=register");
            die();

        }

    }
}

    include('class_include/class_contenido_columna_one.php');
?>  
<div class="mid">
    <div class="module">
        <div class="module">
            <h3>Registro</h3>
            <div class="content">
                <form action="" method="POST" name="register" id="register" class="inputform">        
                    <p><strong>Hola!</strong> Estamos Felices de que hayas decidido unirse a AeroGamez Gunz! Por favor, complete la planilla mostrada debajo para crear tu cuenta. Por favor, asegúrese de que todos los campos correctos. </p>
                    <ul class="registerform">
                        <li>
                            <p>Nombre de Usuario:</p>
                            <span><input name="userid" minlength="3" maxlength="14" placeholder="6-18 Caracteres" value="" type="text" required></span></span>
                        </li>
                        <li>
                            <p>Nombre:</p>
                            <span><input name="namea" minlength="3" maxlength="50" placeholder="Ingrese su nombre personal" value="" type="Text" required></span>
                        </li>
                        <li>
                            <ul class="account2">
                                <li>Una ves que su cuenta este registrada no podra cambiar el correo Electronico por motivos de seguridad.</li>
                            </ul>
                        </li>
                        <li>
                            <p>Correo:</p>
                            <span><input name="email1" maxlength="50" placeholder="support@AeroGamez.com" value="" type="email" required></span>
                        </li>
                        <li>
                            <p>Confirmar Correo:</p>
                            <span><input name="email2" maxlength="50" placeholder="Repetir support@AeroGamez.com" value="" type="email" required></span>
                            
                        </li>
                        <li>
                            <p>Edad:</p>
                            <span>
                                <select name="age" required>
                                  <option value="" selected>Seleccione una Edad</option>
                                  <option value='9'>9</option>
                                  <option value='10'>10</option>
                                  <option value='11'>11</option>
                                  <option value='12'>12</option>
                                  <option value='13'>13</option>
                                  <option value='14'>14</option>
                                  <option value='15'>15</option>
                                  <option value='16'>16</option>
                                  <option value='17'>17</option>
                                  <option value='18'>18</option>
                                  <option value='19'>19</option>
                                  <option value='20'>20</option>
                                  <option value='21'>21</option>
                                  <option value='22'>22</option>
                                  <option value='23'>23</option>
                                  <option value='24'>24</option>
                                  <option value='25'>25</option>
                                  <option value='26'>26</option>
                                  <option value='27'>27</option>
                                  <option value='28'>28</option>
                                  <option value='29'>29</option>
                                  <option value='30'>30</option>
                                  <option value='31'>31</option>
                                  <option value='32'>32</option>
                                  <option value='33'>33</option>
                                  <option value='34'>34</option>
                                  <option value='35'>35</option>
                                  <option value='36'>36</option>
                                  <option value='37'>37</option>
                                  <option value='38'>38</option>
                                  <option value='39'>39</option>
                                  <option value='40'>40</option>
                                  <option value='41'>41</option>
                                  <option value='42'>42</option>
                                  <option value='43'>43</option>
                                  <option value='44'>44</option>
                                  <option value='45'>45</option>
                                  <option value='46'>46</option>
                                  <option value='47'>47</option>
                                  <option value='48'>48</option>
                                  <option value='49'>49</option>
                                  <option value='50'>50</option>
                                  <option value='51'>51</option>
                                  <option value='52'>52</option>
                                  <option value='53'>53</option>
                                  <option value='54'>54</option>
                                  <option value='55'>55</option>
                                  <option value='56'>56</option>
                                  <option value='57'>57</option>
                                  <option value='58'>58</option>
                                  <option value='59'>59</option>
                                  <option value='60'>60</option>
                                  <option value='61'>61</option>
                                  <option value='62'>62</option>
                                  <option value='63'>63</option>
                                  <option value='64'>64</option>
                                  <option value='65'>65</option>
                              </select>
                            </span>
                            
                        </li>
                        <li>
                            <p>Sexo:</p>
                            <span>
                                <select name="sex" required>
                                    <option value="" selected>Seleccione un genero de sexo</option>
                                    <option value="0">Hombre</option>
                                    <option value="1">Mujer</option>
                                    <!--<option value="2">Otro</option>-->
                                </select>
                            </span>
                        </li>
                        <li>
                            <ul class="account2">
                                <li>Selecciona bien tu pais porque de el depende la imagen de tu pais dentro del Gunz.</li>
                            </ul>
                        </li>
                        <li>
                            <p>País</p>
                            <span>
                                <select name="CountryID" required>
                                <option value="" selected>Selecciona tu pais</option>
                                <option value="0">Estados Unidos</option>
                                <option value="1">Republica Dominicana</option>
								<option value="2">Peru</option>
								<option value="3">Venezuela</option>
								<option value="4">Argentina</option>
								<option value="5">Australia</option>
								<option value="6">Bolivia</option>
								<option value="7">Brasil</option>
								<option value="8">Canada</option>
								<option value="9">Chile</option>
								<option value="10">China</option>
								<option value="11">Colombia</option>
								<option value="12">Costa Rica</option>
								<option value="13">Ecuador</option>
								<option value="14">El Salvador</option>
								<option value="15">España</option>
								<option value="16">Honduras</option>
								<option value="17">Israel</option>
								<option value="18">Italia</option>
								<option value="19">Japon</option>
								<option value="20">Mexico</option>
								<option value="21">Nicaragua</option>
								<option value="22">Panama</option>
								<option value="23">Paraguay</option>
								<option value="24">Portugal</option>
								<option value="25">Uruguay</option>
								<option value="26">Vietnam</option>
                              </select>
                            </span>
                            
                        </li>
                        <li>
                            <p>Contraseña:</p>
                            <span><input name="pass1" minlength="6" maxlength="16" placeholder="6-18 caracteres, debe contener los números" value="" type="password" required></span>
                            
                        </li>
                        <li>
                            <p>Repeat Password:</p>
                            <span><input name="pass2" minlength="6" maxlength="16" placeholder="Repetir Contraseña" value="" type="password" required></span>
                            
                        </li>
                        <li>
                            <p>Rregunta Secreta:</p>
                            <span>
                                <select name="question" required>
                                    <option value="" selected>Seleccioná una pregunta secreta</option>
                                    <option value="1">¿Cual es tu ciudad de nacimiento?</option>
                                    <option value="2">¿Como se llama tu madre?</option>
                                    <option value="3">¿Como se llama tu padre?</option>
                                    <option value="4">¿Como se llama tu primera mascota?</option>
                                    <option value="5">¿Como se llama tu primer personaje en gunz?</option>
                                    <option value="6">¿En que Año comenzaste a jugar Gunz?</option>
                                    <option value="7">¿Cómo conociste el juego Gunz?</option>
                                    <option value="8">Pregunta Secreta</option>
                                </select>
                            </span>
                            
                        </li>
                        <li>
                            <p>Respuesta Secreta:</p>
                            <span><input name="answer" minlength="3" maxlength="30" placeholder="**********" value="" type="text" required></span>
                            
                        </li>
                        <li>
                            <p>Captcha:</p>
                            <span><div class="g-recaptcha" data-sitekey="6Lfw6RYUAAAAAFgTMzAOzbNHkVqu6TQwOBvh9hmB"></div></span>
                        </li>
                    </ul>
                    <span class="centerfix">
                        <input name="submit" type="submit" value="Registrar"> <input class="cancel" value="Cancelar" type="button" onclick="javascript:window.location='index.php';">  
                    </span>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    include('class_include/class_contenido_columna_three.php');
?>  