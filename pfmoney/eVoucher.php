<?php

$f=fopen('https://perfectmoney.is/acct/ev_create.asp?AccountID=XXXXXXX&PassPhrase=XXXXXXXXXXX&Payer_Account=U10218621&Amount=0.01', 'rb');


if($f===false){
    echo 'error openning url';
}


$out=array(); $out="";
while(!feof($f)) $out.=fgets($f);

fclose($f);

if(!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $out, $result, PREG_SET_ORDER)){
    echo 'Ivalid output';
    exit;
}

$ar="";
foreach($result as $item){
    $key=$item[1];
    $ar[$key]=$item[2];
}

echo '<pre>';
print_r($ar);
echo '</pre>';
