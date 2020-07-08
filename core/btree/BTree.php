<?php

/**
 * Class BTree
 * Class for build tree
 */
class BTree
{
    private $parentId;
    private $position;
    const POSITION_LEFT = 1;
    const POSITION_RIGHT = 2;
    /**
     * массив со всеми узлами (по факту можно сразу в бд писать но это тяжело дебажить)
     */
    //TODO запись в бд после заполнения массива узлами
    private $btree = array();
    /**
     * указатель на второй уровень вложености
     */
    const SECOND_LVL = 2;

    public function __construct($parentId, $position)
    {
        $this->parentId = $parentId;
        $this->position = $position;
    }

    /**
     * @param $parent_id
     * @param $position
     * тут формируються первые два узла дерева
     */
    public function addMajorStructure()
    {
        //создаем id наследника
        $idNode = BTreeService::getChildNodeIdForMajorStructure($this->parentId, $this->position);
        //создали корневой узел
        $this->btree[] = $this->addRootNode($this->parentId, $idNode);
        //создаем первого наследника
        $this->btree[] = $this->addFirstChild($this->parentId, $this->position, $idNode);
    }

    /**
     * @param $currentId
     * @param $idNode
     * @return BTreeNode
     */
    private function addRootNode($currentId, $idNode)
    {
        $rootNode = new BTreeNode($currentId, 0, 0, 1, 0);
        $rootNode->setChildNode($idNode);
        return $rootNode;
    }

    /**
     * @param $parentNodeId
     * @param $position
     * @param $idNode
     * @return BTreeNode
     */
    private function addFirstChild($parentNodeId, $position, $idNode)
    {

        $path = $parentNodeId . '.' . $idNode;
        return new BTreeNode($idNode, $parentNodeId, $path, self::SECOND_LVL, $position);
    }

    /**
     * @param $id
     * @param BTreeNode $node
     */
    public function addNode($id, $node)
    {
        //если у текущего узла значение меньше чем у наследника проверяем есть ли в это секции наследник
        if ($node->id <= $id) {
            $nodeRight = $node->getRightNode($this->getBtree());
            if ($nodeRight) {
                $this->addNode($id, $nodeRight);
            } else {
                $node->right = $id;
                $this->createNode($node, $id, self::POSITION_RIGHT);
            }
        } elseif ($node->id > $id) {
            $nodeLeft = $node->getLeftNode($this->getBtree());
            if ($nodeLeft) {
                $this->addNode($id, $nodeLeft);
            } else {
                $node->left = $id;
                $this->createNode($node, $id, self::POSITION_LEFT);
            }
        }
    }

    /**
     * @param $node
     * @param $id
     * @param $position
     * Разширение метода addNode для исправления дублирования
     */
    private function createNode($node, $id, $position)
    {
        $currentNode = new BTreeNode($id, $node->id, 0, $node->level + 1, $position);
        BTreeService::setPathNode($currentNode, $this->getBtree(), 0, [], $currentNode, $currentNode->level);
        $this->btree[] = $currentNode;
    }

    public function getBtree()
    {
        return collect($this->btree);
    }

    public function createRandBtree()
    {
        //первый едемент колекции является root
        $rootNode = $this->getBtree()->first();
        $arrayIndexes = range(1, 10);
        foreach ($arrayIndexes as $arrayIndex) {
            $this->addNode(rand(1, 20), $rootNode);
        }
    }
}