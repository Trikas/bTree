<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php');
try {
    //если есть в базе ноды больше уровня 5 удалить их
    BTreeService::destroyAllNodesMoreLevelFive();
    //получаем обьект униформ
    $uniformBTree = new UniformBTree();
    //инитим рут узел
    $uniformBTree->InitRootNode();
    // поднимаем метод инициализации создания дерева в нем инкапсулирован метод непосредственно создания
    $uniformBTree->initCreateUniformBTree();
    //set уникальных id
    BTreeService::setUidNodes($uniformBTree->getBtree());
    //save
    BTreeModel::saveNodes($uniformBTree->getBtree());
    echo 'Дерево сохранено в базу данных';
    ?><br><a href="/">Вернуться на главную</a>
    <?php
} catch (Exception $exception) {
    echo $exception->getMessage();
    ?><br><a href="/">Вернуться на главную</a>
    <?php
}
