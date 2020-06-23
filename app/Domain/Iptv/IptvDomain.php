<?php

namespace App\Domain\Iptv;

use App\Domain\Iptv\Services\IptvService;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class IptvDomain
{
    protected function resolveConfigIndex($user)
    {
        $idx = str_replace('.', '_', Str::after($user, '@'));

        throw_unless(Arr::exists(config('endpoints.iptv.login'), $idx), new \Exception('Não encontramos entrada de configuração para o domínio @'.
            str_replace('_', '.', $idx)));

        return $idx;
    }

    protected function resolveClassName($idx)
    {
        $namespace = '\\App\\Domain\\Iptv\\Services\\';

        $class = $namespace . Str::studly($idx);

        throw_unless(class_exists($class), new \Exception('Não reconhecemos o serviço de tratamento para o domínio @'.
            str_replace('_', '.', $idx)));

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
