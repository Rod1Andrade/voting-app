
# Voting App

The voting application is a full stack application based on the [AppIdeas](https://github.com/florinpop17/app-ideas/blob/master/Projects/2-Intermediate/Voting-App.md) Repository.

## User Stories

- [ ] User can see a list of items he can vote on
- [ ] These items must have a button that the user can click on to vote
- [ ] After the user clicked a button, the user should see all the votes

## Bonus features

- [x] Store items and votes in a database
- [x] Only allow authenticated users to vote

## Backend

<img src="https://app.travis-ci.com/Rod1Andrade/voting-app.svg?branch=main" alt="Travis CI status">

Inicialmente o backend foi construído sem a utilização de nenhum framework, somente adicionando funcionalides e utilizado o [``simple-router``](https://github.com/Rod1Andrade/simple-router) um projeto no qual eu estou trabalhando.

Porém surgiu a necessidade de fazer deploy da aplicação, que no caso foi escolhida a plataforma Heroku. E por medidas de segurança, tanto de chave, quanto da geração de token, e credências de banco de dados, foi escolhido o micro-framework laravel/lumen para dar suporte as necessidades do projeto. De agora em diante do o projeto sera segmentado a partir deste framework.

Vale ressaltar que a transição de todo o ``core`` foi bem simples devido a arquitetura escolhida, basicamente foi necessário mudar ``external`` e os ``controllers``, o domínio e a infra estrutura foram códigos que se mantiveram inalterados.

## Frontend

Hasn't started yet
