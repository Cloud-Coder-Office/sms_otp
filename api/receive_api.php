<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 5/27/2018
 * Time: 4:41 PM
 */
    require_once ('Database.php');
    require_once ('function.php');
    $username     = $_GET['user_name'];
    $pass  	      = $_GET['password'];
    $number       = $_GET['phone_no'];
    $number       = explode(',', $_GET['phone_no'][0]);
    $yourString   = strtoupper($_GET['msg']);

    //$msg = preg_replace("/(\r?\n){2,}/", "\n\n", $yourString);
    //$msg = preg_replace( "/\s+/", "+", $yourString );


    $number         = preg_replace( "/\s+/", "", $number);
    $numbers        = array_unique($number);
    $userName = "40978194";               //$userName = "40912438\40645673";
    $password = "842941";  		     //$password = "679911\793933";

    $data = ["http://portal1.smsgatewaysolution.com/sms/smshttpapi.php?u=".$userName."&p=".$password."&h=".$yourString];

    $r = multiRequest($data);
    //echo $r[0]." and number".$number[$i]."<br/>";

    $j=json_decode($r[0],true);
    print_r($j);

?>

