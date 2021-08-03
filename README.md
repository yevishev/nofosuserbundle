server settings: apache-php-7.2
                PHP-7.2
                MySQL-5.6
                
**Для распаковки необходимо:**
1. Настроить файл .env для подключения к бд
2. Прописать команды:
- `composer install`
- `php bin/console make:migration`
- `php bin/console doctrine:migrations:migrate`

Ставим папку `/public` на чтение
