<?php

namespace App\Domain\Iptv\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Str;

Abstract class IptvService
{
    protected $index = '';

    /**
     * @var Client
     */
    protected $http = null;

    public function __construct()
    {
        $this->index = Str::snake(class_basename(static::class));

        $this->http = new Client([
            'base_uri' => '',
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
    }

    public function login(string $user, string $password)
    {
        return $this->http->request('POST', config('endpoints.iptv.login.'.$this->index), [
            'json' => [
                'user' => $user,
                'password' => $password,
            ]
        ])->getBody();
    }
}
