<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;

class Bot{

   public $token;
   public $name;
   public $bot_url;
   public $telegram_api_url = 'https://api.telegram.org/bot';

    public function __construct($token, $name)
    {
        $this->token = $token;
        $this->name = $name;
        $this->bot_url = $this->telegram_api_url.$this->token.'/';
    }
    public function get_bot_api($method){
        try{
            $client = new Client([
                'base_uri' => $this->bot_url,
                'timeout'  => 2.0,
            ]);
            $response = $client->request('GET', $method);
            return json_decode((string)$response->getBody(), true)['result'];
        } catch (\Exception $e){
            return $e->getCode();
        }


    }
    public function update_users($from, $bdd){
        $result = $bdd->query("SELECT * FROM `users` WHERE `telegram_id` =".$from['id']);
        if ($result->rowCount()<1){
            $req = $bdd->prepare("INSERT INTO `users` (`first_name`, `last_name`, `username`, `language_code`, `telegram_id`) VALUES(?,?,?,?,?)");
            $req->execute(array($from['first_name'], (isset($from['last_name'])) ? $from['last_name'] : 'default', (isset($from['username'])) ? $from['username'] : 'default', $from['language_code'], $from['id']));
            return 'new_user_added';
        }else{
            return 'user_already_exist';
        }

    }
    public function send_message($chat_id, $msg){
        $method_with_message = 'sendMessage?chat_id='.$chat_id.'&text='.$msg;
        $this->get_bot_api($method_with_message);
    }

    public function auto_answer($message, $answers_dictionary){
        foreach ($answers_dictionary as $key => $answer){
            if (strpos(strtolower($message['message']['text']), strtolower($key)) !== FALSE){
                $this->send_message($message['message']['from']['id'], $answer);
                break;
            }
        }
    }
};


?>
