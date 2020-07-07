<?php


class BTreeNode
{
    //Инициализируем поля узла дерева
    public $id;
    public $parent_id;
    public $path;
    //число перентов равно уровню вложености дерева
    public $level;
    //указатель стороны  у корневого равно 0
    public $position;
    //указатель id слева значение наследника меньше 1
    public $left;
    //указатель id справа значение наследника больше 2
    public $right;


    /**
     * BTreeNode constructor.
     * @param $id
     * @param $parent_id
     * @param int $path
     * @param int $level
     * @param $position
     */
    public function __construct($id, $parent_id, $path = 0, $level = 0, $position)
    {
        $this->id = $id;
        $this->parent_id = $parent_id;
        $this->path = $path;
        $this->level = $level;
        $this->position = $position;
    }

    /**
     * @param $idNode
     * Устанавливаем указатели наследников
     */
    public function setChildNode($idNode)
    {
        if ($idNode < $this->id) {
            $this->left = $idNode;
        } elseif ($idNode >= $this->id) {
            $this->right = $idNode;
        }
    }

    public function getLeftNode($bTree)
    {
        if ($this->left) {
            $result = $bTree
                ->where('parent_id', $this->id)
                ->where('id', $this->left)
                ->first();
            if ($result) {
                return $result;
            }
        }
        return null;
    }

    public function getRightNode($bTree)
    {
        if ($this->right) {
            $result = $bTree
                ->where('parent_id', $this->id)
                ->where('id', $this->right)
                ->first();
            if ($result) {
                return $result;
            }
        }
        return null;
    }

    /**
     * @param $value
     */
    public function setLevel($value)
    {
        $this->level = $value;
    }

    /**
     * @param $value
     */
    public function setPath($value)
    {
        $this->path = $value;
    }

}