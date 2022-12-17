<?php
// BY BRoK - @x_BRK - @i_BRK //
date_default_timezone_set("Asia/Baghdad");
  if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
  }
  define('MADELINE_BRANCH', 'deprecated');
  include 'madeline.php';
  $settings['app_info']['api_id'] = 579315;
  $settings['app_info']['api_hash'] = '4ace69ed2f78cec268dc7483fd3d3424';
  $MadelineProto = new \danog\MadelineProto\API('BROK.madeline', $settings);
require("conf.php"); 
$TT = file_get_contents("token");
$tg = new Telegram("$TT");
$lastupdid = 1; 
while(true){ 
 $upd = $tg->vtcor("getUpdates", ["offset" => $lastupdid]); 
 if(isset($upd['result'][0])){ 
  $text = $upd['result'][0]['message']['text']; 
  $chat_id = $upd['result'][0]['message']['chat']['id']; 
$from_id = $upd['result'][0]['message']['from']['id']; 
$sudo = file_get_contents("ID");;
if($from_id == $sudo){
try{
if(file_get_contents("step") == "2"){
if($text !== "- Login ."){
  file_put_contents('phone',$text);
$MadelineProto->phone_login($text);
$tg->vtcor('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"- Send Me the Code Now .",
]);
file_put_contents("step","3");
}
}elseif(file_get_contents("step") == "3"){
if($text){
$authorization = $MadelineProto->complete_phone_login($text);
if ($authorization['_'] === 'account.password') {
$tg->vtcor('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"- Send Me The Password Now .",
]);
file_put_contents("step","4");
}else{
$tg->vtcor('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"- Done Login To New Account .",
]);
file_put_contents("step","");
exit;
}
}
}elseif(file_get_contents("step") == "4"){
if($text){
$authorization = $MadelineProto->complete_2fa_login($text);
$tg->vtcor('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"- Done Login To New Account .",
]);
file_put_contents("step","");
exit;
}
}
}catch(Exception $e) {
  $tg->vtcor('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"- There is Some Errors .",
]);
exit;
}}
$lastupdid = $upd['result'][0]['update_id'] + 1;
}
}