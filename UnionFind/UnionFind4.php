<?php
namespace Datastruct\UnionFind;

require_once("./../autoload.php");

use Datastruct\UnionFind\UFInterface;

/**
 * 并查集第三版 —— UnionFind4 带集合元素个数,基于 size 的优化
 * Class UnionFind
 * @package Datastruct\UnionFind
 */
class UnionFind4 implements UFInterface
{
    // Array
    protected $parent;
    protected $rank;//各个集合深度

    public function __construct(int $size)
    {
        //parent 长度为 $size
        $this->parent = [];
        $this->rank = [];
        for ($i = 0; $i < $size; $i++) {
            $this->parent[$i] = $i;
            $this->rank[$i] = 1;
        }
    }

    /**
     * 获取元素总个数
     * @return int
     */
    public function getSize():int
    {
        return count($this->parent);
    }

    /**
     * 获取指定集合中的元素个数
     * @param int $p
     * @return mixed
     */
    public function rank(int $p)
    {
        $this->valid($p);
        return $this->rank[$p];
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
     * 时间复杂度: O(h)  h => 集合高度
     */
    public function unionElements($p, $q)
    {
        //首先查找两个元素的集合索引
        $pRoot = $this->find($p);
        $qRoot = $this->find($q);
        if ($pRoot == $qRoot) {
            return;
        }

        //将 深度较低 的集合指向 深度较高 的集合
        if ($this->rank[$pRoot] < $this->rank[$qRoot]) {
            $this->parent[$pRoot] = $qRoot;
        } elseif ($this->rank[$pRoot] > $this->rank[$qRoot]) {
            $this->parent[$qRoot] = $pRoot;
        } else {
            //要合并的两个集合深度相等时,无所谓谁指向谁
            $this->parent[$qRoot] = $pRoot;
            //指向之后,将新的集合根节点深度 +1
            $this->rank[$pRoot] += 1;
        }
    }

    /**
     * 根据元素 $p 查找所属集合索引
     * @param int $p 要查找的元素
     */
    private function find(int $p)
    {
        //判断当前元素是否指向了自身,指向自身表示已是根节点,否则继续向上查找
        while ($p != $this->parent[$p]) {
            $p = $this->parent[$p];
        }
        return $p;
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