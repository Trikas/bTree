<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
if ($_POST['parent_id'] && $_POST['position']) {
    try {
        BTreeService::validatePosition();
        $bTree = new BTree($_POST['parent_id'], $_POST['position']);
        //создаем начальное состояние дерева
        $bTree->addMajorStructure();
        $x = $bTree->getBtree();


    } catch (Exception $exception) {
        echo $exception->getMessage();
        ?><br><a href="/">Вернуться на главную</a>
        <?php
    }
}else{
    ?>
    Поля не должны быть равны 0
    <br><a href="/">Вернуться на главную</a>
    <?php
}