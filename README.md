## Project build

### For each deployment
```bash
   composer install
   composer dumpautoload
   php artisan migrate
   php artisan config:clear

### Execute manually once
   php artisan key:generate
```
--------
## Main Requirements

- PHP 8.2
- MySQL 5.7
- Redis
- Nginx
-------

## Shared folder for all application instances

- /storage/app/public


