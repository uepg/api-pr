---
title: API Reference

language_tabs:
- bash
- php
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#IpTv


API broker para autenticação no serviço de IPTV do estado.
<!-- START_53dc9ac32e8061d05e3b0ddf93a455a0 -->
## Autenticar usuário

Realizar a autenticação em diversos sistemas de autenticação das IEES do Paraná.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/iptv/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"user":"quill@guardioes.edu.br","password":"minhasenhaforte","api-key":"hash-gigante-com-uuid-super-secreto"}'

```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://localhost/api/iptv/login',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'user' => 'quill@guardioes.edu.br',
            'password' => 'minhasenhaforte',
            'api-key' => 'hash-gigante-com-uuid-super-secreto',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://localhost/api/iptv/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "user": "quill@guardioes.edu.br",
    "password": "minhasenhaforte",
    "api-key": "hash-gigante-com-uuid-super-secreto"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "cpf": 92929292922,
    "nome": "Peter Quill",
    "fonecel": "99-9101901901",
    "email": "quill@guardioes.edu.br"
}
```
> Example response (401):

```json
{
    "mensagem": "Chave secreta da api incorreta."
}
```
> Example response (404):

```json
{
    "mensagem": "Não encontramos entrada de configuração para o domínio @blablabla."
}
```
> Example response (503):

```json
{
    "mensagem": "Não foi implementado o serviço de tratamento para o domínio @blablabla."
}
```

### HTTP Request
`POST api/iptv/login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `user` | required |  optional  | Nome do usuário, obrigatoriamente com a identificação do domínio.
        `password` | required |  optional  | Senha do usuário.
        `api-key` | required |  optional  | Chave secreta para uso da API.
    
<!-- END_53dc9ac32e8061d05e3b0ddf93a455a0 -->


