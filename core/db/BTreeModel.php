<?php


class BTreeModel extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'btree_data';
    protected $guarded = [];
    public $timestamps = false;
    public static function saveNodes($nodes)
    {
        //чтобы не убивать базу удаление всех старых елементов
        $nodesOld = self::all()->pluck('id');
        self::destroy($nodesOld);
        //запись в базу
        foreach ($nodes as $node){
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
}