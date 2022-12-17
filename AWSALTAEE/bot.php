<?php
// BY BRoK - @SJJJJ - @aaaZaa //
require('conf.php');
if (!file_exists("token")) {
$token =  readline("- Enter Token : ");
file_put_contents("token", $token);
if (!file_exists("ID")) {
$id = readline("- Enter iD : ");
file_put_contents("ID", $id);
}
}
$TT = file_get_contents("token");
$II = file_get_contents("ID");
$tg = new Telegram($TT);
$lastupdid = 1;
while(true){
 $upd = $tg->vtcor("getUpdates", ["offset" => $lastupdid]);
 if(isset($upd['result'][0])){
  $text = $upd['result'][0]['message']['text'];
  $chat_id = $upd['result'][0]['message']['chat']['id'];
$from_id = $upd['result'][0]['message']['from']['id'];
$username = $upd['result'][0]['message']['from']['username'];
$sudo = $II;
if($from_id == $sudo){ 
 if($text == "/start" or $text == "- No . Close The Turbo ."){
 	file_put_contents('brokmove','');
    $tg->vtcor('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"- Hello Bro .\n- Your Can Use This Commands .\n- - - - -\n- BY => @aaaZaa .",
    'inline_keyboard'=>true,
 'reply_markup'=>json_encode([
      'keyboard'=>[
             [['text'=>'- Set User .'],['text'=>'- Turbo info .']],
             [['text'=>'- Move To New Channel .']],
             [['text'=>'- Move To Account .'],['text'=>'- Move To old Channel .']],
             [['text'=>'- Move To BotFather .']],
             [['text'=>'- Run Turbo .']],
             [['text'=>'- Login .']],
      ]	
		]),'resize_keyboard'=>true
	]);
}
if($text == '- Move To old Channel .'){ 
file_put_contents('type','OldChannel');
$tg->vtcor('sendmessage',[ 
'chat_id'=>$chat_id,  
'text'=>"- Send Me The Channel Now Like /old @user .
- Ex => /old @aaaZaa", 
]); 
} 
if($text == '- Move To Account .'){ 
file_put_contents('type','Account');
$tg->vtcor('sendmessage',[ 
'chat_id'=>$chat_id,  
'text'=>"- Done Set Move To Account .", 
]); 
} 
if($text == '- Move To New Channel .'){ 
file_put_contents('type','Channel');
$tg->vtcor('sendmessage',[ 
'chat_id'=>$chat_id,  
'text'=>"- Done Set Move To New Channel .", 
]); 
} 
if($text == '- Move To BotFather .'){ 
file_put_contents('type','BotFather');
$tg->vtcor('sendmessage',[ 
'chat_id'=>$chat_id,  
'text'=>"- Done Set Move To BotFather .", 
]); 
} 
if($text == '- Set User .'){ 
  $tg->vtcor('sendmessage',[ 
  'chat_id'=>$chat_id,  
  'text'=>"- Send Me The User Now Like /Set @user .
  - Ex => /Set @SJJJJ", 
  ]); 
  } 
$brokold = file_get_contents("oldchannel");
$type = file_get_contents('type');
$phone = file_get_contents('phone');
$userbrok = file_get_contents('user');
if($text  == "- Turbo info ."){ 
$tg->vtcor('sendMessage',[ 
'chat_id'=>$chat_id, 
'text'=>"- Turbo info .
- Old Channel => 〔 @$brokold 〕 .
- Move To => 〔 $type 〕 .
- Phone => 〔 $phone 〕 .
- Username => 〔 @$userbrok 〕.
- - - - - -
- BY => @aaaZaa .
", 
]); 
}
if(preg_match('/Set @/', $text )) { 
$ex = explode('/Set @',$text)[1]; 
file_put_contents("user",$ex); 
$tg->vtcor('sendMessage',[ 
'chat_id'=>$chat_id, 
'text'=>"- Done Set User => @$ex .", 
]); 
} 
if(preg_match('/old @/', $text )) { 
  $brok = explode('/old @',$text)[1]; 
  file_put_contents("oldchannel",$brok); 
  $tg->vtcor('sendMessage',[ 
  'chat_id'=>$chat_id, 
  'text'=>"- Done Set Old Channel => @$brok .", 
  ]); 
  } 
  $userbr = file_get_contents('user');
if($text == '- Run Turbo .'){
file_put_contents("brokmove","Yup");
$tg->vtcor('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"- are You Ready To Move @$userbr ?",
'inline_keyboard'=>true,
 'reply_markup'=>json_encode([
      'keyboard'=>[
             [['text'=>'- Yup . I am Ready .'],['text'=>'- No . Close The Turbo .']],
      ]
 ])
]);
}
$brokgetmv = file_get_contents('brokmove');
if($text == '- Yup . I am Ready .' and $brokgetmv == 'Yup'){
  shell_exec('screen -S move -X kill'); 
shell_exec('screen -dmS move php br.php'); 
$tg->vtcor('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"- OK . I'm Start on => @$userbr .",
  'inline_keyboard'=>true,
 'reply_markup'=>json_encode([
      'keyboard'=>[
             [['text'=>'- Close Turbo .']],
      ]
 ])
]);
}
if($text == '- Close Turbo .'){
  file_put_contents('brokmove','');
shell_exec('screen -S move -X kill'); 
$tg->vtcor('sendmessage',[ 
'chat_id'=>$chat_id,  
'text'=>"- Done Close The Turbo .", 
]);
}
if($text == '- Login .'){
	system('rm -rf brok.madeline');
	system('rm -rf brok.madeline.lock');
file_put_contents("step","");
if(file_get_contents("step") == ""){
$tg->vtcor('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"- Send The Number Now .
- Ex => +964**********",
]);
file_put_contents("step","2");
  system('php g.php');

}
}
}
$lastupdid = $upd['result'][0]['update_id'] + 1; 
}
}