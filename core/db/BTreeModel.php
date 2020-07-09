<?php


class BTreeModel extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'btree_data';
    protected $guarded = [];
    public $timestamps = false;

    public static function saveNodes($nodes)
    {
        self::dropAllNodes();
        //запись в базу
        foreach ($nodes as $node) {
            self::create([
                'id' => $node->id,
                'parent_id' => $node->parent_id,
                'position' => $node->position,
                'path' => $node->path,
                'level' => $node->level,
                'left' => $node->left,
                'right' => $node->right,
                'uid' => $node->uid
            ]);
        }
    }

    public static function dropAllNodes()
    {
        //чтобы не убивать базу удаление всех старых елементов
        $nodesOld = self::all()->pluck('id');
        self::destroy($nodesOld);
    }

    //мутатор для того чтобы превратить виртуальное свойство в чтото стоящее -_-
    public function getPathNodeAttribute()
    {
        //если в строке есть точки то преобразуем через функцию в массив если нет то приведением типов
        $x = explode('.', $this->attributes['path']);
        if (strripos($this->attributes['path'], '.')) {
            return explode('.', $this->attributes['path']);
        }
        return (array)$this->attributes['path'];
    }
    //-1 потому что нумеряция начинаетсья с нуля а левлы с 1
    public function getValidLevelAttribute()
    {
        return $this->attributes['level'] - 1;
    }
}