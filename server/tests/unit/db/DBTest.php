<?php
namespace App\tests\unit\db;

use PDO;
use App\App;
use App\db\DB;
use PDOException;
use PHPUnit\Framework\TestCase;

class DBTest extends TestCase
{
    private static $config;

    public static function setUpBeforeClass(): void
    {
        $_SERVER['REQUEST_URI'] = '/';
        self::$config = require 'config.php';

        (new App(self::$config));
    }

    public function testConnect()
    {
        $db = new DB(self::$config);

        $this->assertInstanceOf(DB::class, $db);
    }

    public function testConnectFail()
    {
        $this->expectException(PDOException::class);

        new DB([]);
    }
}
