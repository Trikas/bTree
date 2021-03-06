<?php

/**
 * Class CreatorBTree
 */
class UniformBTree extends Tree
{

    public function initCreateUniformBTree()
    {
        $this->maxLevel = 5;
        $arrayIndexes = range(1, 10);
        $rootNode = $this->getBtree()->first();
        foreach ($arrayIndexes as $arrayIndex) {
            $this->addNode(rand($arrayIndex, 30), $rootNode);
        }
        $this->createUniformBTree();
    }

    /**
     * метод которы берет все уровни и добавляет в них нужное колличество узлв
     */
    public function createUniformBTree()
    {
        for ($x = 1; $x <= 5; $x++) {
            $level = $this->getBtree()->where('level', $x);
            $level->map(function (BTreeNode $node) {
                //проверяем существования дочерних узлов их может быть
                $leftNode = $node->left;
                $rightNode = $node->right;
                if (is_null($leftNode)) {
                    $node->left = rand($node->id,  $node->id - rand(1, 10));
                    $this->createNode($node, $node->left, self::POSITION_LEFT);
                }
                if (is_null($rightNode)) {
                    $node->right = rand($node->id, $node->id + rand(1, 10));
                    $this->createNode($node, $node->right, self::POSITION_RIGHT);
                }
            });
        }
    }

}