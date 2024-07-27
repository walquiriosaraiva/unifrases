# Leia-me #

Este é um projeto que tem como objetivo unir pessoas de todas as linguas.

### O nosso link principal? ###

* Laravel
* Versão 1.0.0
* [Link unifrases](http://www.unifrases.com/site/Default.aspx)

## Criar as Tabelas: ###
* `php artisan key:generate`
* `php artisan migrate`
* `php artisan config:clear`
* `php artisan config:cache`

## Atualizar as tabelas ###
* `php artisan migrate:refresh`

## Atualizar as tabelas e inserindo dados###
* `php artisan migrate:refresh --seed`

## Inserir dados em uma tabela expecifica
* `php artisan db:seed --class=BancoSeeder`

## Caso precise gerar novamente o dumpautoload das classes novas
* `Exemplo: Cridou a classe BancoSeeder tem que rodar o comando abaixo e em seguida`
* `composer dumpautoload -o`
* `php artisan db:seed --class=BancoSeeder`

## Permissões nas pastas 
* `sudo chgrp -R www-data storage`
* `sudo chmod -R ug+rwx storage`