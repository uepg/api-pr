<?php

namespace App\Http\Controllers;

use App\Domain\Iptv\Facade\Iptv;
use Illuminate\Http\Request;

/**
 * @group IpTv
 *
 * API broker para autenticação no serviço de IPTV do estado.
 *
 * @package App\Http\Controllers
 */
class IptvController extends Controller
{

    /**
     * Autenticar usuário
     *
     * Realizar a autenticação em diversos sistemas de autenticação das IEES do Paraná.
     *
     * @bodyParam user required Nome do usuário, obrigatoriamente com a identificação do domínio. Example: quill@guardioes.edu.br
     * @bodyParam password required Senha do usuário. Example: minhasenhaforte
     * @bodyParam api-key required Chave secreta para uso da API. Example: hash-gigante-com-uuid-super-secreto
     *
     * @response  {
     *  "cpf": 92929292922,
     *  "nome": "Peter Quill",
     *  "fonecel": "99-9101901901",
     *  "email": "quill@guardioes.edu.br"
     * }
     *
     * @response 401 {
     * "mensagem": "Chave secreta da api incorreta."
     * }
     *
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
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
