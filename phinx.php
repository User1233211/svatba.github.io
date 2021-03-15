<?php

$dic = require __DIR__ . '/app/bootstrap.php';

$pdo = $dic->getService('database.default.connection')->getPdo();

$driver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);

if ($driver == 'mysql')
    $dbname = $pdo->query('select database()')->fetchColumn();
elseif ($driver == 'pgsql')
    $dbname = $pdo->query('select current_database()')->fetchColumn();
else
    throw new RuntimeException('Unknown database driver: ' . $driver);

return [
    'paths' => [
        'migrations' => __DIR__ . '/var/db/migrations',
        'seeds' => __DIR__ . '/var/db/seeds',
    ],
    'environments' => [
        'default' => [
            'name' => $dbname,
            'connection' => $pdo,
        ],
    ],
];
