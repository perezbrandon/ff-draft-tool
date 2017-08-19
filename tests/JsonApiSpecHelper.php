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
}