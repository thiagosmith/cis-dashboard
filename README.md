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
- Clone o repositório;
- Instale o PHP;
- Instale o MySQL;
- Crie a base de dados;
- Crie o usuário e defina sua senha;
- Importe as tabelas para a base de dados a partir do arquivo cis_dashboard.sql
```
Atualização do Linux:
# apt update
# apt upgrade -y

Clonagem do repositório:
# cd /var/www/html
# apt install git -y
# git clone https://github.com/thiagosmith/cis-dashboard.git

Instalação do Apache2:
# apt install apache2 -y

Instalação do PHP:
# apt install php libapache2-mod-php php-mysql php-cli php-curl php-gd php-mbstring php-xml php-zip -y

Instalação do MariaDB (MySQL):
# apt install mariadb-server -y

Provisonamento do banco de dados:
# mysql -u root
MariaDB [(none)]> CREATE DATABASE cis_dashboard;
MariaDB [(none)]> CREATE USER 'cis_user'@'localhost' IDENTIFIED BY 'SenhaForte123!';
MariaDB [(none)]> GRANT ALL PRIVILEGES ON cis_dashboard.* TO 'cis_user'@'localhost';
MariaDB [(none)]> FLUSH PRIVILEGES;
MariaDB [(none)]> EXIT
# cd cis-dashboard
# mysql -u cis_user -pSenhaForte123! cis_dashboard < cis_dashboard.sql

Reinicialização do Apache2:
# systemctl restart apache2
```

Sistema desenvolvido por para uso inerno e não comercial. Fique a vontade para utilizar, aprimorar, distribuir e cobrar por ele.
