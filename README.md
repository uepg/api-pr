# API PR

Api do tipo broker (bridge) de serviços para as IEES do Estado do Paraná

Esquema Geral de Funcionamento

1 - Broker envia para o endpoint de cada IES em um POST com content-type json:
user
password
api-key (opcional)

Exemplo:
```console
curl -X POST "https://apipr.apps.uepg.br/api/iptv/login" -H "Content-Type: application/json" -H "Accept: application/json" -d '{"user":"user01@uepg.br","password":"senha01","api-key":"chaveDevTeste"}'
```

2 - O endpoint de cada IES deve retornar

2.1 - Em caso de sucesso, um json com HTTP response code 200, com os seguintes campos:
nome (string)

email (string)

tipo (string)

url (string)

turmas [codturma, nometurma, cursoturma]

O campo "tipo" pode ser "academico" ou "professor"

O campo "url" é o endereço da página inicial para direcionar o usuario no navegador interno do app

O campo "turmas" é um array. Os campos "codturma", "nometurma", "cursoturma" podem ser informados para o professor ou acadêmico

Exemplo json de retorno de sucesso:
```yaml
{"nome":"nome sobrenome","email":"user01@uepg.br","tipo":"academico","turmas":[{"codturma":"123456","nometurma":"L\u00f3gica Computacional - Turma A","cursoturma":"Engenharia de Computa\u00e7\u00e3o"},{"codturma":"654321","nometurma":"Estrutura de Dados","cursoturma":"Engenharia de Computa\u00e7\u00e3o"}]}
```

2.2 - Em caso de erro, um json com HTTP response code 401, com o seguinte campo:
mensagem (string)

Exemplo json de retorno de erro:
```yaml
{"mensagem":"Usuario ou senha inv\u00e1lida"}
```

3 - Exemplos
Exemplos (sucesso):
```console
curl -X POST "https://apipr.apps.uepg.br/api/iptv/login" -H "Content-Type: application/json" -H "Accept: application/json" -d '{"user":"user01@uepg.br","password":"senha01","api-key":"chaveDevTeste"}'
```

Exemplo (erro):
```console
curl -X POST "https://apipr.apps.uepg.br/api/iptv/login" -H "Content-Type: application/json" -H "Accept: application/json" -d '{"user":"user01@uepg.br","password":"senhaXXX","api-key":"chaveDevTeste"}'
```





