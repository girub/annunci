# annunci
Iniziamo qualche prova su un parsing xml con php
---
## Introduction

Inizio qualche prova sul parsing xml con insert/update/delete in MySQL.
Alla fine vorrei integrare questo script in un plugin wordpress

---
## Installation

* Import init.sql into your mysql database

* add config.php:

```php
define('FILE_XML_WEB', 'http://mywebsite.com/xml_export/index.php?ida=10');
define('FILE_XML', 'file.xml');


define('DB_SERVERNAME', '');
define('DB_USERNAME', '');
define('DB_PASSWORD', '');
define('DB_NAME', '');

```