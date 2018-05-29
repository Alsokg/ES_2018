<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=test',
    'username' => 'aloskg',
    'password' => '',
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    // Продолжительность кеширования схемы.
    'schemaCacheDuration' => 3600,
    // Название компонента кеша, используемого для хранения информации о схеме
    'schemaCache' => 'cache',
];
