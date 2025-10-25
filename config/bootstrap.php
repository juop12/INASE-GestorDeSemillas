<?php
return [
    'paths' => [
        'migrations' => ROOT . DS . 'config' . DS . 'Migrations',
        'seeds' => ROOT . DS . 'config' . DS . 'Seeds',
    ],
    'migration_base_class' => 'Migrations\AbstractMigration',
    'seed_base_class' => 'Migrations\AbstractSeed',
];
