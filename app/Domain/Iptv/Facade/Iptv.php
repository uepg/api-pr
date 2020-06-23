<?php

namespace App\Domain\Iptv\Facade;

use Illuminate\Support\Facades\Facade;

class Iptv extends Facade
{
    protected static function getFacadeAccessor() { return 'IptvDomain'; }
}
