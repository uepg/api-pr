<?php

namespace App\Http\Controllers;

use App\Domain\Iptv\Facade\Iptv;
use Illuminate\Http\Request;

class IptvController extends Controller
{

    public function login(Request $request)
    {
        $this->validate($request, [
            'user' => 'required',
            'password' => 'required',
        ], [
            'user.required' => 'Nome do usuário deve ser informado',
            'password.required' => 'Senha do usuário deve ser informada',
        ]);

        return Iptv::login($request->user, $request->password);
    }
}
