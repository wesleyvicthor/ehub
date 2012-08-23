<?php

namespace Ehub\Consumer;

class Foursquare
{
    private $clientId;
    private $clientSecret;

    const CLIENT_ID = 'XUMRGSZXCNDZPAAHD0AASWT0JGKENFBWSVZAPFFNAESFUDW4';
    const CLIENT_SECRET = 'I0WGDZAGZDVW04QAO4FECC01GKTQO55X5GY0TIJG2GHGT1HC';
    const VERIFIED_DATE = '20120321';
    const API_URL = 'https://api.foursquare.com/v2/';

    function __construct($clientId, $clientSecret, $verifiedDate,$redirectUrl)
    {
        $this->clientId = (empty($clientId)) ? self::CLIENT_ID : $clientId;
        $this->clientSecret = (empty($clientSecret)) ?
        self::CLIENT_SECRET : $clientSecret;
        $this->verifiedDate = (empty($verifiedDate)) ?
        self::VERIFIED_DATE : $verifiedDate;
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    public function getVerifiedDate()
    {
        return $this->verifiedDate;
    }

    public function get($feature, $args)
    {
        $params = '?';
        if(!empty($args)){
            while (list($key, $val) = each($args)) {
                $params .= "{$key}={$val}&";
            }
        }

        $url = self::API_URL . $feature . $params .
        'client_id=' . $this->clientId .
        '&client_secret=' . $this->clientSecret .
        '&v=' . $this->verifiedDate;
        return json_decode(file_get_contents($url));
    }

    public function getPlace($placeId)
    {
        $place = $this->get("venues/{$placeId}");
        $location = $place->response->venue->location;
        $latLon = $location->lat . ',' . $location->lng;

        $foodPlaces = $this->explore($latLon)->response->groups[0]->items;

        return $this->getNearLocations($latLon);
    }

    public function getNearLocations($latLon, $section = 'food')
    {

        $items = $this->explore($latLon, $section)->response->groups[0]->items;

        $places = array();
        foreach ($items as $item) {
            $venue = $item->venue;
            $icon = $venue->categories[0]->icon;
            $photourl = $icon->prefix . '32' . $icon->name;

            $place = new \StdClass();
            $place->name = $venue->name;
            $place->address = $venue->location->address;
            $place->phone = $venue->contact->formattedPhone;
            $place->photourl = $photourl;

            $places[] = $place;
        }

        return $places;
    }

    public function explore($latLon, $section)
    {
        $args = array(
            //'ll' => '23.526605235257595,-46.737089991858504',
            'll' => $latLon,
            'llAcc' => '500',
            //'section' => 'food',
            'section' => $section,
            'novelty' => 'new'
            );
        $result = $this->get('venues/explore', $args);

        return $result;

    }


}