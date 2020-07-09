<?php


class PlaceNode
{
    private $node;
    private $resultCollection;
    private $uidSearch;

    /**
     * PlaceNode constructor.
     * @param $uid
     */
    public function __construct($uid)
    {
        $this->setNode(BTreeModel::where('uid', $uid)->first());
        $this->setUidSearch($uid);
    }

    /**
     * @return mixed
     */
    public function getNode()
    {
        return $this->node;
    }

    /**
     * @param mixed $node
     */
    public function setNode($node)
    {
        $this->node = $node;
    }

    public function startSortCollect()
    {
        $collectNodes = BTreeModel::all();
        if ($collectNodes->isEmpty()) {
            throw new Exception('Не возможно выполнить сортировку. Сначала нужно заполнить таблицу!!');
        }
        $node = $this->getNode();
        if (is_null($node)) {
            throw new Exception('Не найден указанный id повторите попытку!!');
        }
        $sortedNodes = $collectNodes->filter(function ($item) use ($node) {
             if (isset($item->path_node[$node->valid_level])) {
                 return $item->path_node[$node->valid_level] == $node->id;
             }
        });
        $this->setResultCollection($sortedNodes);
    }

    /**
     * @return mixed
     */
    public function getResultCollection()
    {
        return $this->resultCollection;
    }

    /**
     * @param mixed $resultCollection
     */
    public function setResultCollection($resultCollection)
    {
        $this->resultCollection = $resultCollection;
    }

    /**
     * @return mixed
     */
    public function getUidSearch()
    {
        return $this->uidSearch;
    }

    /**
     * @param mixed $uidSearch
     */
    public function setUidSearch($uidSearch)
    {
        $this->uidSearch = $uidSearch;
    }
}