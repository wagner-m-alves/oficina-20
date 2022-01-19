### OFICINA 2.0

## Introdução

Este projeto é a implementação de um sistema simples de
oficina mecânica, cujo objetivo e auxiliar no gerenciamento de orçamentos.

## Detalhes

Esse projeto conta com CRUD de Clientes, CRUD de Vendedores e CRUD de Orçamentos, incluindo filtragem e paginação, conforme requerido no documento de apresentação do projeto. O sistema utiliza FormRequest para validação de dados e Resource para centralizar o retorno dos dados. Tendo em vista que os Orçamentos serão gerados pelos Vendedores, utilizou-se Observer para incluir automaticamente o Vendedor logado no Orçamento. As seeds disponíveis criam dois Usuários, um Admin e um Vendedor, entretanto, não foi implementado ACL.

## Tecnologias Primárias

1. Laravel Framework;
2. Inertia;
3. Vue.JS;
4. Tailwind CSS;

## Tecnologias Secundárias

1. Laravel Jetstream;

## Instuções de Execução

1. Baixe as Dependências do projeto, usando os comandos abaixo:
```
composer install
npm install
```

2. Compile os arquivos, usando o comando abaixo:
```
npm run dev
```

3. Execute as migrations de banco de dados, usando o comando abaixo:
```
php artisan migrate
```

4. Execute as seeds para povoar o banco de dados com dados iniciais, usando o comando abaixo:
```
php artisan db:seed
```

5. Utilize um dos usuários cadastrados no passo anterior para testar o sistema. Segue abaixo as credenciais:
email: admin@admin.com
senha: 12345678

email: harvey.specter@test.com
senha: 12345678
