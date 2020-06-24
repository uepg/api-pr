<?php

namespace App\Domain\Iptv;

use App\Domain\Iptv\Services\IptvService;
use App\Exceptions\ApiprException;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class IptvDomain
{
    protected function checkUserFormat($user)
    {
        throw_unless(Str::contains($user, '@'),
            new ApiprException('Obrigatório o envio do domínio com o nome do usuario, por exemplo usuario@uepg.br', 400));
    }

    protected function checkIndex($idx)
    {
        throw_unless(Arr::exists(config('endpoints.iptv.login'), $idx),
            new ApiprException('Não encontramos entrada de configuração para o domínio @'.
                str_replace('_', '.', $idx), 404));
    }

    protected function resolveConfigIndex($user)
    {
        $idx = str_replace('.', '_', Str::after($user, '@'));

        $this->checkUserFormat($user);

        $this->checkIndex($idx);

        return $idx;
    }

    protected function resolveClassName($idx)
    {
        $namespace = '\\App\\Domain\\Iptv\\Services\\';

        $class = $namespace . Str::studly($idx);

        throw_unless(class_exists($class), new ApiprException('Não foi implementado o serviço de tratamento para o domínio @'.
            str_replace('_', '.', $idx), 503));

        return $class;
    }

    protected function factory(string $user) : IptvService
    {
        $idx = $this->resolveConfigIndex($user);

        $class = $this->resolveClassName($idx);

        return new $class;
    }

    public function login(string $user, string $password)
    {
        $service = $this->factory($user);

        return $service->login($user, $password);
    }
}
