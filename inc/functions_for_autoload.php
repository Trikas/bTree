<?php
function core_autoload($class_name)
{
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/core/' . $class_name . '.php')) {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/core/' . $class_name . '.php');
    }
}

function btree_autoload($class_name)
{
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/core/btree/' . $class_name . '.php')) {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/core/btree/' . $class_name . '.php');
    }
}

function pdo_autoload($class_name)
{
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/core/db/' . $class_name . '.php')) {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/core/db/' . $class_name . '.php');
    }
}