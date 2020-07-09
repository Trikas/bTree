<?php

class BTreeService
{
    public static $level = 0;
    public static $path = [];


    /**
     * @param $parentId
     * @param $position
     * Функция которая проверяет позицию относитель родителя и выдает нужный id
     */
    public static function getChildNodeIdForMajorStructure($parentId, $position)
    {
        //слева от родителя id меньше значение
        if ($position == 1) {
            return rand(0, $parentId - 1);
            //справа id больше значение
        } elseif ($position == 2) {
            return rand($parentId, $parentId + 20);
        }
    }

    /**
     * @throws Exception
     */
    public static function validatePosition()
    {
        if (($_POST['position'] <= 2) == false) {
            throw new Exception('Поле position должно быть 1 или 2');
        }
    }

    /**
     * @throws Exception
     */
    public static function validateParentNode()
    {
        if ($_POST['parent_id'] == 0) {
            throw new Exception('Поле parent_id должно быть больше 0');
        }
    }

    /**
     * @param $node
     * @param \Tightenco\Collect\Support\Collection $bTree
     * @param $level
     * @param $path
     * @param $editedNode
     * @param $childLevel
     */
    public static function setPathNode($node, $bTree, $level, $path, &$editedNode, $childLevel)
    {
        $level += 1;
        $path[] = $node->id;
        //проверяем есть ли у узла родитель
        if (isset($node->parent_id) && $node->level != 1) {
            $parentNode = $bTree
                ->where('id', $node->parent_id)
                ->where('level', '=', $childLevel - 1)
                ->first();
            self::setPathNode($parentNode, $bTree, $level, $path, $editedNode, $childLevel - 1);
        } else {
            $editedNode->setPath(implode('.', array_reverse($path)));
        }
    }

    public static function destroyAllNodesMoreLevelFive()
    {
        $bTreeCollect = BTreeModel::all();
        if ($bTreeCollect->isNotEmpty()) {
            $nodesForDelete = $bTreeCollect->where('level', '>', 5)->pluck('id');
            BTreeModel::destroy($nodesForDelete);
        }
    }

    public static function setUidNodes($bTree)
    {
        foreach ($bTree as $key => $node){
            $node->uid = $key;
        }
    }

    public static function mergeCollect(\Illuminate\Support\Collection $sortedNodes, \Illuminate\Support\Collection $parentNodes)
    {
        $parentNodes->map(function ($parentNodes) use ($sortedNodes) {
            $sortedNodes->push($parentNodes);
        });
        return $sortedNodes;
    }

}