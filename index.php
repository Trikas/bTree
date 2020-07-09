<?php
//add autoload script
require_once($_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php'); ?>
<h2>Условие номер #1</h2>
<form action="/create_tree.php" method="post">
    <input type="number" name="parent_id" placeholder="Введите id родителя" required> Любое число кроме 0<br><br>
    <input type="number" name="position" placeholder="Введите position наследника" required> 1 или 2<br><br>
    <input type="submit" value="Сформировать">
</form>

<h2>Условие номер #2</h2>
<h3> #2.1</h3>
<a href="/create_uniform_bTree.php">Сформировать дерево в 5 уровней</a>
<hr>
<h3> #2.2</h3>
<form action="/searchPlaceNode.php" method="post">
    <input type="number" name="uid" required placeholder="Введите id ячейки"><br><br>
    <input type="submit" value="Отправить">
</form>
<hr>