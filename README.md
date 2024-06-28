<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Sobre o Projeto
Este é um projeto de chat em tempo real feito com Laravel e blade na camada view, esse projeto foi feito usando MVC junto com Services, com Requests, com Laravel fortemente tipado, 
com integração de front e back end, desenvolvido totalmente em inglês para seguir um padrão de desenvolvimento, também foi desenvolvido um sistema de logs na autenticação usando
Sanctum conforme foi pedido, para o serviço de chat foi usado o Chatify porque ele já traz todas as funcionalidades pedidas no teste, desenvolvi também algumas funcionalidades a mais 
em cima do sanctum que não foram pedidas, configurei todo o postman pra testar as rotas certinho, também criei um projeto base primeiramente, depois criei as branchs relacionadas a cada tarefa macro que estava fazendo.

Foi um projeto feito com muito empenho e dedicação.

## Executando o projeto

Para execuar o projeto, siga as instruções:
- Clone o projeto.
- Instale as dependências rodando: composer install.
- Rode o comando php artisan generate:key.
- Descomente o env copy example que tem no projeto(ele já tem a configuração do chatify pré definida).
- Rode o comando php artisan migrate.
- Instale o laravel sanctum para a autenticação: https://laravel.com/docs/11.x/sanctum.
- Instale o Chatify para o serviço de chat: https://chatify.munafio.com/
- Rode novamente o comando php artisan migrate porque os serviços do sanctum e do chatify geram outras tabelas.

##Segue o link da documentação do projeto
###*DOCUMENTAÇÃO:* https://documenter.getpostman.com/view/12554925/2sA3duFYJB

**OBS**: o env pré configurado está configurado usando o banco postgre, configure para o teu determinado banco de dados.<br>
**OBS2**: ao rodar o projeto, rode na branch master, que é a branch que eu fiz merge com todas as outras branchs depois do desenvolvimento.

