<?php
namespace App\tests\unit\db;

use PDO;
use App\db\Connection;
use PHPUnit\Framework\TestCase;

class ConnectionTest extends TestCase
{
    public function testConnect()
    {
        $pdo = Connection::connect();

        $this->assertInstanceOf(PDO::class, $pdo);
    }
}
