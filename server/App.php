<?php


namespace App;

use App\db\DB;
use App\core\Method;
use App\models\Model;
use App\core\Parameter;
use App\core\Controller;

class App
{
    private static DB $db;

    public function __construct(protected array $config)
    {
        static::$db = new DB($this->config);
    }

    public static function connection() : DB
    {
        return static::$db;
    }

    public function run()
    {
        try {
            $controller = new Controller();
            $controller = $controller->load();

            $method = new Method();
            $method = $method->load($controller);

            $parameter = new Parameter();
            $parameter = $parameter->load();

            $controller->$method($parameter);
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }
}