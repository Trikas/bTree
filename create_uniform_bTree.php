<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php');
try {
    //если есть в базе ноды больше уровня 5 удалить их
    BTreeService::destroyAllNodesMoreLevelFive();
    //получаем обьект униформ
    $uniformBTree = new UniformBTree();
    $uniformBTree->InitRootNode();
    $uniformBTree->initCreateUniformBTree();
    BTreeService::setUidNodes($uniformBTree->getBtree());
    BTreeModel::saveNodes($uniformBTree->getBtree());
    echo 'Дерево сохранено в базу данных';
    ?><br><a href="/">Вернуться на главную</a>
    <?php
} catch (Exception $exception) {
    echo $exception->getMessage();
    ?><br><a href="/">Вернуться на главную</a>
    <?php
}
