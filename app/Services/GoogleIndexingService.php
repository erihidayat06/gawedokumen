<?php

namespace App\Services;

use Google\Client;
use Google\Service\Indexing;

class GoogleIndexingService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
        // Mengambil file JSON dari storage/app/google-indexing.json
        $this->client->setAuthConfig(storage_path('app/gawe-dokumen-indexing-0d6cce167f4b.json'));
        $this->client->addScope('https://www.googleapis.com/auth/indexing');
    }

    public function updateUrl($url)
    {
        $indexing = new Indexing($this->client);
        $urlNotification = new \Google\Service\Indexing\UrlNotification();
        $urlNotification->setUrl($url);
        $urlNotification->setType('URL_UPDATED');

        return $indexing->urlNotifications->publish($urlNotification);
    }
}
