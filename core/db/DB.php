<?php


class DB
{
    public $pdo;

    public function __construct()
    {
        //чтобы массив был ассоциативным
        $opt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $this->pdo = new PDO('mysql:host=localhost; dbname=btree', 'homestead', 'secret', $opt);
    }

    public function getRow()
    {
        return $this->pdo->query('SELECT btree.btree_data.id from btree.btree_data');
    }
}