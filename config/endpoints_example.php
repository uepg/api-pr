<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Configuração de endpoints
    |--------------------------------------------------------------------------
    | Este é um arquivo de exemplo, versionado com o código, no ambiente de produção
    | renomeie para endpoints.php e configure de acordo com os valores corretos
    |
    | ATENÇÃO: NÃO versione o arquivo de produção ou outro ambiente
    |
    */

    'token' => 'defina a hash de key aqui',

    /**
     * Mantenha do lado esquedo o índice do domínio, o qual será enviado junto ao nome do usuário,
     * por exemplo joao@uepg.br, o índice deverá ser uepg.br
     */
    'iptv' => [
        'login' => [
                'uel_br' => [
                    'url'=> 'endpoint',
                    'api-key'=> 'api-key-da-ies',
                ],
                'uem_br'  => [
                    'url'=> 'endpoint',
                    'api-key'=> 'api-key-da-ies',
                ],
                'unespar_edu_br'  => [
                    'url'=> 'endpoint',
                    'api-key'=> 'api-key-da-ies',
                ],
                'uepg_br'  => [
                    'url'=> 'endpoint',
                    'api-key'=> 'api-key-da-ies',
                    'client_id' => 'client-id-app-sgi-interno-uepg',
                    'client_secret' => 'client-secret-app-sgi-interno-uepg',
                ],
                'unicentro_br'  => [
                    'url'=> 'endpoint',
                    'api-key'=> 'api-key-da-ies',
                ],
                'uenp_edu_br'  => [
                    'url'=> 'endpoint',
                    'api-key'=> 'api-key-da-ies',
                ],
                'unioeste_br'  => [
                    'url'=> 'endpoint',
                    'api-key'=> 'api-key-da-ies',
                ],
            ]
    ],

];
