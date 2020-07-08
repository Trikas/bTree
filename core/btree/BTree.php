<?php

/**
 * Class BTree
 * Class for build tree
 */
class BTree extends Tree
{
    private $parentId;
    private $position;


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