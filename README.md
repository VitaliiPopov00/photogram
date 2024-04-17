# Установка:<br>
1) Перенести проект любым способом
2) Перейти в директорию проекта
3) Выполнить:
   ```
   composer install
   ```
4) Создать БД (например: photogram)
5) Установить в config/db.php:
   ```
    <?php
    
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=YOUR_DATABASE_NAME',
        'username' => 'YOUR_USERNAME',
        'password' => 'YOUR_PASSWORD',
        'charset' => 'utf8',
    
        // Schema cache options (for production environment)
        //'enableSchemaCache' => true,
        //'schemaCacheDuration' => 60,
        //'schemaCache' => 'cache',
    ];
   ```
6) Выполнить:
   ```
   yii migrate
   ```
### готово! 😊

# API
1) Получение всех файлов:
```
$ curl -i -H "Accept:application/json" "http://{YOUR_DOMAIN}/api/gallery"
```
2) Получение файла по ID:
```
$ curl -i -H "Accept:application/json" "http://{YOUR_DOMAIN}/api/gallery/{ID}"
```   
