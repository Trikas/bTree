<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Container\Container;

class DB{
    public function __construct()
    {
        $this->initDb();
    }

    public function initDb()
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver'    => DRIVER,
            'host'      => HOST,
            'database'  => DB_NAME,
            'username'  => USERNAME,
            'password'  => PASS,
            'charset'   => CHARSET,
            'collation' => COLLATION,
            'prefix'    => '',
        ]);

        $capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
    }
}

