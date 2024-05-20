#### Conceitos para trabalhar

- [x] Testes unitários
- [x] Docker
- [x] API REST
- [x] Git

#### Tecnologias

- [x] Laravel
- [x] PHP Unit
- [x] Docker
- [x] Postgres

#### O Projeto

<p>Trata-se de uma API inspirada no Gympass. Através de requisições, será possível realizar o CRUD completo de academias, 
clientes e check-ins. Também será trabalhado o conceito de localização através de cálculo com latitude e longitude.</p> 

#### Requisitos funcionais

<table>
    <tr>
        <th colspan="2">Academias</th>
    </tr>
    <tr>
        <th>RF01</th>
        <td>Listar todas as academias num raio de localização</td>
    </tr>
    <tr>
        <th>RF02</th>
        <td>Cadastrar nova academia</td>
    </tr>
    <tr>
        <th>RF03</th>
        <td>Editar informações da academia através do seu ID</td>
    </tr>
    <tr>
        <th>RF04</th>
        <td>Remover academia</td>
    </tr>
    <tr>
        <th colspan="2">Clientes</th>
    </tr>
    <tr>
        <th>RF05</th>
        <td>Listar todos os clientes</td>
    </tr>
    <tr>
        <th>RF06</th>
        <td>Cadastrar novo cliente</td>
    </tr>
    <tr>
        <th>RF07</th>
        <td>Editar informações do cliente através do seu ID</td>
    </tr>
    <tr>
        <th>RF08</th>
        <td>Remover cliente</td>
    </tr>
    <tr>
        <th colspan="2">Check-ins</th>
    </tr>
    <tr>
        <th>RF09</th>
        <td>Fazer check-in em uma academia</td>
    </tr>
    <tr>
        <th>RF10</th>
        <td>Localizar check-ins por academia e período</td>
    </tr>
    <tr>
        <th>RF11</th>
        <td>Remover check-in através do seu ID</td>
    </tr>
</table>

#### Requisitos não funcionais

<table>
    <tr>
        <th>RNF01</th>
        <td>A API deve possuir autenticação para realizar certas tarefas (JWT)</td>
    </tr>
    <tr>
        <th>RNF02</th>
        <td>API deverá ser desenvolvida com o framework Laravel</td>
    </tr>
    <tr>
        <th>RNF03</th>
        <td>O banco de dados a ser utilizado será o Postgres</td>
    </tr>
</table>

#### Regras de negócio

<table>
    <tr>
        <th>RN01</th>
        <td>Não poderão ser cadastrados dois clientes com o mesmo e-mail</td>
    </tr>
    <tr>
        <th>RN02</th>
        <td>Não deve ser possível realizar dois check-ins em um mesmo dia</td>
    </tr>
    <tr>
        <th>RN03</th>
        <td>Só deve ser possível fazer check-in em academias que estejam até dez metros de distância</td>
    </tr>
</table>

#### Modelo lógico do banco de dados

<div style="text-align: center; width: 100%;">
    <img src="https://i.ibb.co/3NW9CZW/modelo-logico.jpg" alt="Modelo lógico do banco de dados" />
</div>

#### Rotas

- [x] v1/auth/login [POST] - rota para efetuar o login de usuário e gerar a chave JWT
- [x] v1/auth/logout [POST] - rota para fazer logout de usuário (requer autenticação)
- [x] v1/auth/refresh [POST] - rota para gerar um novo token JWT (requer autenticação)
- [x] v1/auth/me [POST] - rota que retorna as informações do usuário

- [x] v1/gym/all/:latitude/:longitude [GET] - rota para listar todas as academias num raio de 10 quilômetros passando
  latitude e longitude
- [x] v1/gym/store [POST] - rota para adicionar uma nova academia
- [x] v1/gym/update/:gymId [PUT] - rota para alterar as informações de uma academia
- [x] v1/gym/delete/:gymId [DELETE] - rota para remover uma academia

- [x] v1/customer/all [GET] - rota para listar todos os clientes
- [x] v1/customer/store [POST] - rota para adicionar um novo cliente
- [x] v1/customer/update/:customerId [PUT] - rota para alterar as informações de um cliente
- [x] v1/customer/delete/:customerId [DELETE] - rota para remover um cliente

- [x] v1/checkin/all/:gymId/:firstDate/:secondDate [GET] - rota que retorna todos os check-ins realizados em uma
  determinada academia num determinado período
- [x] v1/checkin/store [POST] - rota para registrar um novo check-in
- [x] v1/checkin/delete/:checkInId - rota para deletar um check-in

#### Instruções de uso

É necessário ter as seguintes ferramentas configuradas no computador:

- [x] PHP (8.0)
- [x] Composer
- [x] Docker
- [x] Git

Primeiramente, clone o repositório através do comando:

```
git clone https://github.com/amazingbits/gym-api
```

Em seguida, abra no seu IDE a pasta do projeto. No terminal, digite o seguinte comando para instalar todas as 
dependências do Laravel:

```
composer install
```

Renomeie o arquivo `.env.example` para `.env`.

Em seguida, digite o seguinte comando no terminal para gerar uma chave para a aplicação:

```
php artisan key:generate
```

Então, digite o seguinte comando para criar uma chave para a biblioteca do JWT:

```
php artisan jwt:secret
```

Agora, digite o seguinte comando para criar um container do docker:

```
docker-compose up -d
```

Desta maneira, o projeto está pronto para ser testado.
