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

    public static function validatePosition()
    {
        if (($_POST['position'] <= 2) == false) {
            throw new Exception('Поле position должно быть 1 или 2');
        }
    }

    public static function validateParentNode()
    {
        if ($_POST['parent_id'] == 0) {
            throw new Exception('Поле parent_id должно быть больше 0');
        }
    }

    /**
     * @param $node
     * @param \Tightenco\Collect\Support\Collection $bTree
     */
    public static function getInfoAboutNode($node, $bTree, $level, $path, &$editedNode)
    {
        $level += 1;
        $path[] = $node->id;
        //проверяем есть ли у узла родитель
        if ($node->parent_id) {
            if ($node->position == 1) {
                $parentNode = $bTree->where('id', $node->parent_id)->where('left', $node->id)
                    ->first();
                self::getInfoAboutNode($parentNode, $bTree, $level, $path, $editedNode);
            } elseif ($node->position == 2) {
                $parentNode = $bTree->where('id', $node->parent_id)->where('right', $node->id)
                    ->first();
                self::getInfoAboutNode($parentNode, $bTree, $level, $path, $editedNode);
            }
        }else{
            $editedNode->setLevel($level);
            $editedNode->setPath(implode('.', array_reverse($path)));
        }
//        return ['path' => implode('.', array_reverse(self::$path)), 'level' => self::$level];
    }
}