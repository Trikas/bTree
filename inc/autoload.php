<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/functions_for_autoload.php');
spl_autoload_register('core_autoload');
spl_autoload_register('btree_autoload');
spl_autoload_register('pdo_autoload');