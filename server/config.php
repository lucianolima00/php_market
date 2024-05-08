<?php
// Parse the .env file and set environment variables
$envFile = __DIR__ . '.env';
if (file_exists($envFile)) {
    $env = file_get_contents($envFile);
    $env = preg_split('/\s+/', $env);
    foreach ($env as $var) {
        if ($var) {
            list($key, $value) = explode('=', $var);
            $_ENV[$key] = $value;
        }
    }
}
if (isset($_ENV['APP_MODE']) && $_ENV['APP_MODE'] == 'production') {
    return [
        'database' => [
            'host' => isset($_ENV['DB_HOST']) ? $_ENV['DB_HOST'] : '127.0.0.1',
            'port' => isset($_ENV['DB_PORT']) ? $_ENV['DB_PORT'] : '5432',
            'username' => isset($_ENV['DB_USERNAME']) ? $_ENV['DB_USERNAME'] : 'postgres',
            'password' => isset($_ENV['DB_PASSWORD']) ? $_ENV['DB_PASSWORD'] : '123456',
            'dbname' => isset($_ENV['DB_NAME']) ? $_ENV['DB_NAME'] : 'market',
            'charset' => 'utf8',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            ]
        ]
    ];

} else if (isset($_ENV['APP_MODE']) && $_ENV['APP_MODE'] == 'test') {
    return [
        'database' => [
            'host' => isset($_ENV['DB_TEST_HOST']) ? $_ENV['DB_TEST_HOST'] : '127.0.0.1',
            'port' => isset($_ENV['DB_TEST_PORT']) ? $_ENV['DB_TEST_PORT'] : '5432',
            'username' => isset($_ENV['DB_TEST_USERNAME']) ? $_ENV['DB_TEST_USERNAME'] : 'postgres',
            'password' => isset($_ENV['DB_TEST_PASSWORD']) ? $_ENV['DB_TEST_PASSWORD'] : '123456',
            'dbname' => isset($_ENV['DB_TEST_NAME']) ? $_ENV['DB_TEST_NAME'] : 'market',
            'charset' => 'utf8',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            ]
        ]
    ];
}

return [];
