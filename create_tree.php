<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php');
if ($_POST['parent_id'] && $_POST['position']) {
    try {
        $db = new DB();
        BTreeService::validatePosition();
        $bTree = new BTree((int)$_POST['parent_id'], (int)$_POST['position']);
        //создаем начальное состояние дерева
        $bTree->addMajorStructure();
        //создаем дерево
        $bTree->createRandBtree();
        //инитим всем нодам уникальный id
        BTreeService::setUidNodes($bTree->getBtree());
        //сохраняем
        BTreeModel::saveNodes($bTree->getBtree());
        echo 'Дерево сохранено в базу данных';?>
        <br><a href="/">Вернуться на главную</a>
        <?php
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