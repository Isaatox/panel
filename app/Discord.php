<?php

namespace App;

use Illuminate\Support\Facades\Http;

class Discord
{

    public static function get()
    {
        $curl = curl_init("https://discordapp.com/api/v8/oauth2/token");
        curl_setopt_array($curl, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => ['grant_type' => 'client_credentials', 'scope' => 'guilds'],
            CURLOPT_HEADER => 0,
            CURLOPT_HTTPHEADER => ['Content-type' => 'application/x-www-form-urlencoded'],
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0
        ]);
            curl_setopt($curl,CURLOPT_PASSWORD, config('services.discord.client_secret'));
            curl_setopt($curl,CURLOPT_USERNAME, config('services.discord.client_id'));
        $exe = curl_exec($curl);
        if($exe == false){
            return curl_error($curl);
        }
        $json = json_decode($exe);
        $user = Http::withToken($json->access_token)->get("https://discordapp.com/api/v8/users/@me")->json();
        dd($user);
        return $json;
    }
}
