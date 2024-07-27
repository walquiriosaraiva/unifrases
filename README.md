# Unifrases
## Laravel 10

## Funcionalidades

- Acesso como admin
- Sair
- Cadastro
- Validações
- Sweat Alert
- Datatable
- Javascript Validation
- FontAwesome 6
- Página principal da tradução

## Instalado

- Laravel 10
- PHP ^8.1
- Composer
- Datatable
- Sweetalert
- Javascript
- FontAwesome 6
- Server Xampp/Laragon

## Instalação

- Faça o clone do código fonte para sua máquina.

- Instalando as dependências usando docker.

## Subindo o projeto local
```bash
docker-compose up -d
```
### rodando composer
```bash
docker-compose run --rm composer install
```
### rodando as migrations
```bash
docker-compose run --rm artisan migrate --seed
```

- Caso seja necessários visualizar rotas e demais comandos do artisan siga o exemplo abaixo e ou veja também todas as possivilidades do artisan:
## listando rotas
```bash
docker-compose run --rm artisan route:list
```
## listando tudo que o artisan oferece
```bash
docker-compose run --rm artisan
```