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

    'api-key' => 'defina a hash de key aqui',

    /**
     * Mantenha do lado esquedo o índice do domínio, o qual será enviado junto ao nome do usuário,
     * por exemplo joao@uepg.br, o índice deverá ser uepg.br
     */
    'iptv' => [
        'login' => [
                'uel_br' => 'endpoint',
                'uem_br' => 'endpoint',
                'unespar_edu_br' => 'endpoint',
                'uepg_br' => 'endpoint',
                'unicentro_br' => 'endpoint',
                'uenp_edu_br' => 'endpoint',
                'unioeste_br' => 'endpoint',
            ]
    ],

];
