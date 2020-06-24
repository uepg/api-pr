<?php

namespace App\Domain\Iptv\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\JsonResponse;
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
        try {
            $response = $this->http->request('POST', config('endpoints.iptv.login.' . $this->index), [
                //'http_errors' => false,
                'json' => [
                    'user' => $user,
                    'password' => $password,
                ]
            ]);
        } catch (GuzzleException $exception) {
            throw_if($exception->getResponse()->getStatusCode() >= 500, $exception);

            $response = $exception->getResponse();
        }

        return new JsonResponse(
            json_decode($response->getBody()->getContents(), true),
            $response->getStatusCode()
        );
    }
}
