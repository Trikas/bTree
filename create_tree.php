<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
if ($_POST['parent_id'] && $_POST['position']) {
    try {
        BTreeService::validatePosition();
        $bTree = new BTree((int)$_POST['parent_id'], (int)$_POST['position']);
        //создаем начальное состояние дерева
        $bTree->addMajorStructure();
        $bTree->createRandBtree();
        $x = $bTree->getBtree();
        var_dump($x);
    } catch (Exception $exception) {
        echo $exception->getMessage();
        ?><br><a href="/">Вернуться на главную</a>
        <?php
    }
} else {
    ?>
    Поля не должны быть равны 0
    <br><a href="/">Вернуться на главную</a>
    <?php
}