# BoraPoupar API

## Descrição

API para o aplicativo BoraPoupar, que tem como um dos objetivos ajudar o usuário a economizar dinheiro.

## Containers

- Laravel 11 / PHP 8.3
- MySQL 8.0
- Redis 7.0

## O que o projeto contém?

- O projeto contém uma API RESTful desenvolvida em Laravel 11, com autenticação utilizando Laravel Sanctum, e um banco de dados MySQL e camada de Cache com Redis. Além disso, o projeto conta com um container Nginx para servir como proxy reverso e balancear a carga entre os containers do Laravel.

- A API foi testada de ponta a ponta utilizando PestPHP, contendo mais de 200 testes automatizados.

- O projeto segue todos os princípios do SOLID e Clean Code, garantindo uma fácil manutenção e escalabilidade.

- O projeto contém um painel administrativo desenvolvido em Laravel Livewire + FilamentPHP para visão geral dos dados.

- O projeto contém um painel de monitoramento utilizando o Laravel Pulse, dessa forma é possível monitorar o status da aplicação em tempo real.

- Analisador de código estático PHPStan + LaraStan em seu maior nível de análise para garantir a qualidade do código.

## Como rodar o projeto?

1. Clone o repositório
2. Execute o comando `docker-compose up -d` para subir os containers
3. Execute o comando `docker-compose exec laravel composer install` para instalar as dependências do Laravel
4. Execute o comando `docker-compose exec laravel php artisan migrate --seed` para criar as tabelas e popular o banco de dados
5. Acesse a aplicação em `http://localhost:8000`

## Como rodar os testes?

1. Execute o comando `docker-compose exec laravel ./vendor/bin/pest`

## Como acessar o painel administrativo?

1. Acesse a aplicação em `http://localhost:8000/admin`
2. Utilize o usuário `admin@admin.com` e senha `password` para acessar o painel

## Como acessar o painel de monitoramento?

1. Faça login no painel administrativo
2. Acesse a rota `/pulse`