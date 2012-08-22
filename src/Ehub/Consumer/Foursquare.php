<?php

namespace Ehub\Consumer;

class Foursquare
{
    private $clientId;
    private $clientSecret;

    function __construct($clientId, $clientSecret, $redirectUrl)
    {
        $this->clientId = (empty($clientId)) ? CLIENT_ID : $clientId;
        $this->clientSecret = (empty($clientSecret)) ?
            CLIENT_SECRET : $clientSecret;
    }
}