<?php
//add autoload script
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/inc/autoload.php');
?>
<form action="/create_tree.php" method="post">
    <input type="number" name="parent_id" placeholder="Введите id родителя" required> Любое число кроме 0<br><br>
    <input type="number" name="position" placeholder="Введите position наследника" required> 1 или 2<br><br>
    <input type="submit" value="Сформировать">
</form>
