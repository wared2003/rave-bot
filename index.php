<?php
require 'vendor/autoload.php';
require_once 'Bot.php';
require 'inc/bdd-conect.php';
$running = true;
$bot = new Bot('2041625054:AAFbFN_6ikKALJ8QBJZjJMMHcTlX4Q2R9yg', 'rave');
$messages = $bot->get_bot_api('getUpdates');
foreach($messages as $message){
    $bot->update_users($message['message']['from'], $bdd);
};
?>