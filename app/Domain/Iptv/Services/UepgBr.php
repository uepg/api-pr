<?php

namespace App\Domain\Iptv\Services;

use App\Domain\Iptv\Services\IptvService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Psr\Http\Message\ResponseInterface;

class UepgBr extends IptvService
{

    public function evalResponse(string $user, ResponseInterface $response): JsonResponse
    {
        $data = json_decode($response->getBody()->getContents(), true);

        $tipo = 'professor';
        if (strtolower($data['usuario']['perfil']['nome']) == 'graduacao') {
            $tipo = 'academico';
        }

        $data = [
            'nome' => $data['usuario']['nome'],
            'email' => $data['usuario']['email'],
            'tipo' => $tipo,
            'url' => 'https://classroom.google.com',
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
                    'client_id' => config('endpoints.iptv.login.' . $this->index . '.client_id'),
                    'client_secret' => config('endpoints.iptv.login.' . $this->index . '.client_secret'),
                    'grant_type' => 'password',
                    'authorizer_version' => '0.2.35+',
                    'username' => $user,
                    'password' => $password,
                ]
            ]);

            return $this->evalResponse($user, $response);

        } catch (GuzzleException $exception) {
            throw_if($exception->getResponse()->getStatusCode() >= 500, $exception);

            $response = $exception->getResponse();

            if($exception->getCode() == 401) {
                $response = [
                    'data' => [
                        'mensagem'=> 'Usuário ou senha inválida!',
                    ],
                    'code' => $response->getStatusCode(),
                ];

                return new JsonResponse(
                    $response['data'],
                    $response['code'],
                );

            }
        }
    }
}
