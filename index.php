<?php
require 'vendor/autoload.php';
require_once 'Bot.php';

$bot = new Bot('2041625054:AAFbFN_6ikKALJ8QBJZjJMMHcTlX4Q2R9yg', 'rave');
dd($bot->get_bot_api('getUpdates'));




