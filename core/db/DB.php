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
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'btree',
            'username'  => 'homestead',
            'password'  => 'secret',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);



        $capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
    }
}

