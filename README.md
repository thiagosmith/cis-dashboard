# CIS Controls Security Dashboard
Dashboard de dados CIS Benchmarks
Objetivo é receber os dados de avaliação de segurança CIS e concentrar em um sistema capaz de acomapnhar a evolução do ambiente por meio de dados tratados e dashboards visuais.

## Testado em ambiente Linux 
- Debian 13;
- Apache 2.4.66;
- PHP 8.4.16; e
- MariaDB 11.8.3.

## Credenciais:
```
Banco de dados:
Name-DB: cis_dashboard
User-DB: cis_user
Pass-DB: SenhaForte123!

Painel Administrativo:
User: admin
Pass: admin123
Role: admin

User: smith
Pass: smith
Role: user
```

## Instalação:
- Instale o Linux;
- Instale o PHP;
- Instale o MySQL;
- Crie a base de dados;
- Crie o usuário e defina sua senha;
- Importe as tabelas para a base de dados a partir do arquivo cis_dashboard.sql
```
# mysql -u cis_user -pSenhaForte123! cis_dashboard < cis_dashboard.sql
```
