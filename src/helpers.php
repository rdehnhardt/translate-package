<?php

use GuzzleHttp\Client;

if (!function_exists('__')) {
    function __($key)
    {
        $client = new Client(['base_uri' => getenv('TRANSLATE_URL')]);
        $translate = $client->get('translate', ['query' => ['key' => $key]]);

        if ($translate->getStatusCode() == 200) {
            $message = json_decode($translate->getBody()->getContents());

            if ($message->status) {
                return $message->message;
            }
        }
    }
}