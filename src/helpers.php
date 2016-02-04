<?php

use GuzzleHttp\Client;

if (!function_exists('__')) {
    function __($key)
    {
        $locale = array_key_exists('locale', $_SESSION) ? $_SESSION['locale'] : getenv('TRANSLATE_LOCALE');

        $client = new Client(['base_uri' => getenv('TRANSLATE_URL')]);
        $translate = $client->get('translate', ['query' => ['key' => $key, 'locale' => $locale]]);

        if ($translate->getStatusCode() == 200) {
            $message = json_decode($translate->getBody()->getContents());

            if ($message->status) {
                return $message->message;
            }
        }
    }
}

if (!function_exists('getLocales')) {
    function getLocales()
    {
        $client = new Client(['base_uri' => getenv('TRANSLATE_URL')]);
        $translate = $client->get('locales');

        if ($translate->getStatusCode() == 200) {
            return json_decode($translate->getBody()->getContents());
        }
    }
}