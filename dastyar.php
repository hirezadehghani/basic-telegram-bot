<?php

$token = "YOUR BOT TOKEN";
$offset = 0;
$channel_id = "@YOUR CHANNEL ID";
while(true){

$url="https://api.telegram.org/bot".$token."/getupdates?offset=".$offset;
// $chat_id = "CHAT ID";


// Define a context for HTTP.
//BECAUSE OF IRAN FILTERED TELEGRAM I FOUND A WAY FOR CONNECT PHP TO VPN PROGRAM
$aContext = array(
     'http' => array(
         'proxy' => 'tcp://127.0.0.1:2000', // This needs to be the server and the port of the Proxy Server.
         'request_fulluri' => true,
         ),
     );
$cxContext = stream_context_create($aContext);

// Now all file stream functions can use this context.

$newupdate = file_get_contents($url, false, $cxContext);

    //forward from a channel (not support! :(|))
    // $forward = "https://api.telegram.org/bot".$token."/forwardMessage?chat_id=".$channel_id."&from_chat_id=@akhbarefori";

        // file_get_contents($sendText, false, $cxContext);

$arrayresult = json_decode($newupdate,true);

foreach($arrayresult['result'] as $update){
    $uId = $update['update_id'];
    $offset = $uId + 1;
    $chat_id = $update['message']['from']['id'];
    $send_user = $update['message']['from']['first_name'].$update['message']['from']['last_name'];
    $user_name = $update['message']['from']['username'];
    $text = $update['message']['text'];
    $sendText = "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$channel_id."&text=".$text;
    file_get_contents($forward, false, $cxContext);
}
}
echo "<br/><br/><br/>".$url;


?>