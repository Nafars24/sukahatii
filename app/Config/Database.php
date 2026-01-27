<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    /**
     * Directory for migrations & seeds
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Default connection group
     */
    public string $defaultGroup = 'default';

    /**
     * Default database connection
     *
     * @var array<string, mixed>
     */
    public array $default = [
        'DSN'      => '',
        // WAJIB pakai TCP → JANGAN localhost
        'hostname' => env('database.default.hostname') ?: '127.0.0.1',
        'username' => env('database.default.username'),
        'password' => env('database.default.password'),
        'database' => env('database.default.database'),
        'DBDriver' => 'MySQLi',

        // PORT WAJIB ADA supaya TIDAK pakai socket
        'port'     => env('database.default.port') ?: 3306,

        'DBPrefix' => '',
        'pConnect' => false,

        // Jangan debug di production (bikin Whoops)
        'DBDebug'  => (ENVIRONMENT !== 'production'),

        'charset'  => 'utf8mb4',
        'DBCollat' => 'utf8mb4_general_ci',

        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => false,
        'failover'    => [],
        'foreignKeys' => true,
    ];

    /**
     * Database used for testing
     *
     * @var array<string, mixed>
     */
    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => '',
        'password'    => '',
        'database'    => ':memory:',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => '',
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => 'utf8_general_ci',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => false,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
    ];

    public function __construct()
    {
        parent::__construct();

        // Pastikan test tidak pakai DB production
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}