<?php
//add autoload script
require_once($_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php');
$dd = BTreeModel::all();
$res = [];
$dd->map(function ($value) use (&$res){
    $res[$value->parent_id.$value->level][] = $value->id;
});
$xx = $res;
?>
<h2>Условие номер #1</h2>
<form action="/create_tree.php" method="post">
    <input type="number" name="parent_id" placeholder="Введите id родителя" required> Любое число кроме 0<br><br>
    <input type="number" name="position" placeholder="Введите position наследника" required> 1 или 2<br><br>
    <input type="submit" value="Сформировать">
</form>
<hr>
<h2>Условие номер #2</h2>
<h3> #2.1</h3>
<a href="/create_uniform_bTree.php">Сформировать дерево в 5 уровней</a>

<form action=""></form>

