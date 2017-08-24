<?php
namespace Tests;

const JSON_API_HEADERS = [
    'CONTENT_TYPE' => 'application/vnd.api+json',
    'ACCEPT' => 'application/vnd.api+json'
];

trait JsonApiSpecHelper
{
    public function getApi($uri)
    {
        return $this->get($uri, JSON_API_HEADERS);
    }

    public function getData($response)
    {
        return json_decode($response->getContent(), true)['data'];
    }

    public function countData($response)
    {
        return count(json_decode($response->getContent(), true)['data']);
    }
}
