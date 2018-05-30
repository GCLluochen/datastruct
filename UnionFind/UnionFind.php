<?php
namespace Datastruct\UnionFind;

require_once("./../autoload.php");

use Datastruct\UnionFind\UFInterface;

/**
 * 并查集第一版 —— UnionFind
 * Class UnionFind
 * @package Datastruct\UnionFind
 */
class UnionFind implements UFInterface
{
    // Array
    protected $id;

    public function __construct(int $size)
    {
        // ids 长度为 $size
        $this->ids = [];
        //初始化时, 每个元素属于不同的集合
        for ($i = 0; $i < $size; $i++) {
            $this->id[$i] = $i;
        }
    }

    /**
     * 获取元素总个数
     * @return int
     */
    public function getSize():int
    {
        return count($this->id);
    }

    /**
     * 判断两个元素是否属于同一个集合
     * @param $p
     * @param $q
     * @return bool
     */
    public function isConnected($p, $q): bool
    {
        return $this->find($p) == $this->find($q);
    }

    /**
     * 合并元素 $p 和 $p 所属集合
     * @param $p
     * @param $q
     */
    public function unionElements($p, $q)
    {
        //首先查找两个元素的集合索引
        $pId = $this->find($p);
        $qId = $this->find($q);
        if ($pId == $qId) {
            return;
        }

        //然后将整个集合中元素 p 所属集合的元素修改为 归属到元素 q 所属集合
        for ($j = 0; $j < $this->getSize(); $j++) {
            if ($this->id[$j] == $pId) {
                $this->id[$j] = $qId;
            }
        }
    }

    /**
     * 根据元素 $p 查找所属集合索引
     * @param int $p
     */
    private function find(int $p)
    {
        $this->valid($p);
        return $this->id[$p];
    }

    /**
     * 判断元素是否有效
     * @param int $p
     * @return bool
     */
    private function valid(int $p)
    {
        if ($p < 0 || $p > count($this->id)) {
            throw new \RuntimeException('Undefined Offset!');
        }
        return true;
    }

}