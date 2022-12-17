<?php 
// BY BROK - @aaaZaa - @SJJJJ //
if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
  }
  define('MADELINE_BRANCH', 'deprecated');
  include 'madeline.php';
  $settings['app_info']['api_id'] = 579315;
  $settings['app_info']['api_hash'] = '4ace69ed2f78cec268dc7483fd3d3424';
  $MadelineProto = new \danog\MadelineProto\API('brok.madeline', $settings);
$MadelineProto->start();
function bot($method, $datas = []) {
	$token = file_get_contents("token");
	$url = "https://api.telegram.org/bot$token/" . $method;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$res = curl_exec($ch);
	curl_close($ch);
	return json_decode($res, true);
}
function curlGet($url) {
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$res = curl_exec($ch);
return $res;
}
$id = file_get_contents("ID");
$admin = "@SJJJJ"; 
$user = file_get_contents('user');
$type = file_get_contents('type');
if($type == "Channel"){
$updates = $MadelineProto->channels->createChannel(['broadcast' => true, 'megagroup' => false, 'title' => "BROK", 'about' => "- @aaaZaa & @SJJJJ .", ]);
}
if($type == "OldChannel"){
$brokold = file_get_contents('oldchannel');
}
if($type == "BotFather"){ $MadelineProto->messages->sendMessage(['peer' => '@botfather','message'=>'/newbot']);
sleep(1); 
$MadelineProto->messages->sendMessage(['peer' => '@botfather','message'=>'BROK']);
}
$x = 0;
while(true){
$get = curlGet("https://telegram.me/$user");
      preg_match("/(.*)(og:title)(.*)(content\=\")(.*)(\">)/i", $get,$name);
      $name = $name[5];
      echo '@'.$user." => ".$x." => ".date('i:s')."\n";  
$x++;
if($x == '50'){
bot('sendMessage',[
'chat_id' => $id, 
'text' => "- MY Clicks => $x & ID => @$user ."
]);
}
if($x == '250'){
bot('sendMessage',[
'chat_id' => $id, 
'text' => "- MY Clicks => $x & ID => @$user ."
]);
}
if($x == '299'){
bot('sendMessage',[
'chat_id' => $id, 
'text' => "- The Clicks is 300 I am out sorry :(."
]);
}
if(preg_match("/^Telegram\: Contact.*/", $name)){
if($type == 'Account'){
$MadelineProto->account->updateUsername(['username' => $user]);
}
if($type == 'Channel'){
$MadelineProto->channels->updateUsername(['channel' =>$updates['updates'][1], 'username' => $user, ]);
$MadelineProto->messages->sendMessage(['peer' => $updates['updates'][1], 'message' => "- Moved BY @HHzHH ."]);
}
if($type == "OldChannel"){
$MadelineProto->channels->updateUsername(['channel' => $brokold, 'username' => $user, ]);
$MadelineProto->messages->sendMessage(['peer' => $brokold, 'message' => "- Moved BY @HHzHH ."]);
}
if($type == "BotFather"){
$MadelineProto->messages->sendMessage(['peer' => '@botfather','message'=>$user]);
}
bot('sendMessage',[
'chat_id' => "$id", 
'text' =>"- Request Done . 
- ID => 〔 @$user 〕 .
- Clicks => 〔 $x 〕 .
- - - - - -
- BY => @SJJJJ .
- Channel => @aaaZaa ."]);  
file_put_contents('brokmove', '');
exit; 
}
}