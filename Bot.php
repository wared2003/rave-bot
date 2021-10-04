<?php
require 'vendor/autoload.php';
require_once 'inc/bdd-conect.php';
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
    public function update_users(){

    }
}


?>