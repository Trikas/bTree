<?php


class Tree
{
    const POSITION_LEFT = 1;
    const POSITION_RIGHT = 2;
    public $maxLevel = false;
    /**
     * массив со всеми узлами (по факту можно сразу в бд писать но это тяжело дебажить)
     */
    public $btree = array();

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
     * Разширение метода addNode
     */
    public function createNode($node, $id, $position)
    {
        //если установлено $maxLevelTree то нужно проверять уровень вложености
        //нужно для того чтобы формировать дерево с уровнем вложености 5
        if ($this->maxLevel > $node->level or !$this->maxLevel){
            $currentNode = new BTreeNode($id, $node->id, 0, $node->level + 1, $position);
            BTreeService::setPathNode($currentNode, $this->getBtree(), 0, [], $currentNode, $currentNode->level);
            $this->btree[] = $currentNode;
            return $currentNode;
        }
    }

    /**
     * @param $currentId
     * @param $idNode
     * @return BTreeNode
     */
    public function addRootNode($currentId, $idNode)
    {
        $rootNode = new BTreeNode($currentId, 0, 0, 1, 0);
        $rootNode->setChildNode($idNode);
        return $rootNode;
    }

    public function getBtree()
    {
        return collect($this->btree);
    }

    public function InitRootNode()
    {
        if (!$rootNode = $this->getBtree()->first()) {
            $rootNode = $this->addRootNode(2, 3);
            $this->btree[] = $rootNode;
        } else {
            $this->btree[] = $rootNode;
        }
    }
}