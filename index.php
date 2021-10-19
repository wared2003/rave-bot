<?php
require 'vendor/autoload.php';
require_once 'Bot.php';
require 'inc/bdd-conect.php';
$word_data = array(
    'bonjour' => "salut, qu'est ce que je peut faire pour toi?",
);
$running = true;
$bot = new Bot('2041625054:AAFbFN_6ikKALJ8QBJZjJMMHcTlX4Q2R9yg', 'rave');
while(1 == 1){
$file    = fopen( "data/last_update_id.txt", "r" );
$last_update_id  = fgets($file);
fclose($file);
$messages = $bot->get_bot_api('getUpdates'.(($last_update_id != '') ? '?offset='.strval(intval($last_update_id)+1) : ''));


    foreach ($messages as $message) {
        $file = fopen("data/last_update_id.txt", "w+");
        fwrite($file, $message['update_id']);
        fclose($file);
        $msg_txt = $message['message']['text'];
        $from = $message['message']['from'];
        $bot->update_users($from, $bdd);
        $bot->send_message($message['message']['from']['id'], 'message reçu');
        echo($msg_txt . '<br>');
    }
    sleep(1);
    };

?>