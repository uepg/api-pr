<?php

namespace App\Domain\Iptv\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Psr\Http\Message\ResponseInterface;

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

    protected function evalNickName(string $user) : string
    {
        $user = Str::before($user, '@');
        $nickName = config('endpoints.iptv.login.' . $this->index . '.nickname-prefix') . '_' . $user;
        return Str::limit($nickName, 20);
    }

    /**
     * Monta o json de resposta, pode ser sobreposto nas classes específicas para montar o array de acordo com características
     * de cada IEES
     *
     * @param $response
     * @return JsonResponse
     */
    public function evalResponse(string $user, ResponseInterface $response) : JsonResponse
    {
        $responseData = json_decode($response->getBody()->getContents(), true);

        $data = [
            'nome' => $responseData['nome'],
            'email' => $responseData['email'],
            'tipo' => $responseData['tipo'],
            'url' => $responseData['url'],
            'nickname' => $this->evalNickName($user),
        ];

        return new JsonResponse(
            $data,
            $response->getStatusCode()
        );
    }

    public function login(string $user, string $password)
    {
        try {
            $response = $this->http->request('POST', config('endpoints.iptv.login.' . $this->index . '.url'), [
                //'http_errors' => false,
                'json' => [
                    'api-key' => config('endpoints.iptv.login.' . $this->index . '.api-key'),
                    'user' => $user,
                    'password' => $password,
                ]
            ]);
        } catch (GuzzleException $exception) {
            throw_if($exception->getResponse()->getStatusCode() >= 500, $exception);

            $response = $exception->getResponse();
        }

        return $this->evalResponse($user, $response);
    }
}
